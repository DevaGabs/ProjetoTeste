# Companies API

Para que o projeto funcione em sua maquina, é necessário que tenha o Docker instalado e também o Docker Compose.

A configuração padrão permitirá que o projeto execute na porta 8080 em localhost.

## Instalação

Clone o repositório com o comando a seguir:

```bash
  git clone https://bitbucket.org/convicti/companies-api.git
```

Abra a pasta do projeto com o comando:

```bash
  cd companies-api
```

Copie o arquivo todos os arquivos que tenham extensão .example para o seu nome sem o .example com o seguinte comando:

```bash
  cp .env.example .env
  cp .editorconfig.example .editorconfig
  cp docker-compose.yml.example docker-compose.yml
  cp Dockerfile.example Dockerfile
```

Supondo que você tem o docker e o docker compose instalados em sua maquina, inicie os containers com o comando a seguir:

```bash
docker compose up -d
```

ou

```bash
docker-compose up -d
```

Após iniciar o containers, execute o seguinte comando para conectar ao container via ssh:

```bash
docker exec -it companiesapi-app sh
```

Já dentro do container do app, execute o seguinte comando para instalar todas as dependencias:

```bash
composer install
```

Ainda dentro do container, execute os seguintes comandos para executar as migrations com os seeders e realizar alguns testes unitarios:

```bash
php artisan migrate --seed
```

ou caso já tenha uma base populada, execute o seguinte comando:

```bash
php artisan migrate:fresh --seed
```

Este comando ira popular a base de dados com os dados necessários!
