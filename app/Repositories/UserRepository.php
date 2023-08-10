<?php

namespace App\Repositories;

use App\Models\PasswordResetToken;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;

/**
 *
 */
class UserRepository extends AbstractRepository
{
    /**
     * @return mixed
     */
    public function model(): mixed
    {
        return User::class;
    }

    /**
     * @return string
     */
    public function messageErrorNotFound(): string
    {
        return 'Usuário não encontrado';
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function show($id): mixed
    {
        $objectModel = $this->model()::find($id);

        if (!$objectModel) {
            throw new Exception($this->messageErrorNotFound(), Response::HTTP_NOT_FOUND);
        }

        return $objectModel;
    }

    /**
     * @param string $email
     * @param int $hours
     * @return void
     * @throws Exception
     */
    public function createAPasswordResetToken(string $email, int $hours = 24): void
    {
        $user = $this->model()::where('email', $email)->first();

        if ($user) {
            $token = Crypt::encryptString(Carbon::now()->addHours($hours)->format('Y-m-d H:i:s'));

            if (PasswordResetToken::where('email', $email)->first()) {

                throw new Exception("Já existe um pedido de redefinição de senha para o e-mail $email", Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $passwordResetToken = new PasswordResetToken();
            $passwordResetToken->email = $email;
            $passwordResetToken->token = $token;
            $passwordResetToken->save();
        }
    }

    /**
     * @param string $email
     * @param string $password
     * @param string $token
     * @return string
     * @throws Exception
     */
    public function passwordReset(string $email, string $password, string $token): string
    {
        $user = $this->model()::where('email', $email)->first();

        if (!$user) {
            throw new Exception($this->messageErrorNotFound(), Response::HTTP_NOT_FOUND);
        }

        $this->checkPasswordResetToken($email, $token);

        $user->password = $password;

        if ($user->first_access == 1) {

            $user->first_access =  0;
        }

        $user->save();

        $passwordResetToken = PasswordResetToken::where('email', $email)->where('token', $token)->first();
        $passwordResetToken->delete();

        return 'Password atualizado com sucesso';
    }

    /**
     * @param string $email
     * @param string $token
     * @return void
     * @throws Exception
     */
    public function checkPasswordResetToken(string $email, string $token): void
    {
        $passwordResetToken = PasswordResetToken::where('email', $email)->where('token', $token)->first();

        if (!$passwordResetToken) {
            throw new Exception("Não existe um pedido para redefinição de senha para o e-mail $email ou o token de redefinição de senha inválido!", Response::HTTP_NOT_FOUND);
        }

        if (Carbon::now()->greaterThan(Crypt::decryptString($token))) {
            $passwordResetToken->delete();
            throw new Exception("Token de redefinição de senha expirado!", Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
