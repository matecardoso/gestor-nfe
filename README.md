## Configuração

Após clonar o projeto, rodar os comandos:

```composer install --no-scripts```

```npm install```

```php artisan passport:install```

Renomeie então o arquivo:

```.env.example```

para

```.env``` e configure as informações do banco de dados.

Crie então uma nova chave para a aplicação com o comando:

```php artisan key:generate```

Com o banco criado e configurado no .env rode então o comando:

```php artisan migrate --seed```

Para utilizar a api fora do sistema é necessário criar um cliente do passport com o comando:

```php artisan passport:client --personal```

## Usuário padrão criado no sistema

Usuário: admin@admin.com

Senha: admin123

## Gerar helper de rotas para utilizar route name no JS

php artisan laroute:generate

## Gerar cliente no passport

php artisan passport:client --personal

## Dados acesso Webmaniabr

https://webmaniabr.com/docs/rest-api-nfe/#emitir-nfe

https://webmaniabr.com/painel/

## Documentação

.../docs

## Logs

Logs da API:

.../apilogs

Todos os logs do laravel

.../logs
