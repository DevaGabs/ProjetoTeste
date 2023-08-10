<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert(
            [
                ['name' => 'Tecnologia da Informação (TI)'],
                ['name' => 'Saúde e Bem-Estar'],
                ['name' => 'Educação'],
                ['name' => 'Alimentação e Bebidas'],
                ['name' => 'Varejo'],
                ['name' => 'Finanças e Serviços Financeiros'],
                ['name' => 'Energia e Sustentabilidade'],
                ['name' => 'Indústria Automobilística'],
                ['name' => 'Turismo e Hotelaria'],
                ['name' => 'Entretenimento e Mídia'],
                ['name' => 'Outros']
            ]
        );
    }
}
