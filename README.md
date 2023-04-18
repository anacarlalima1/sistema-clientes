## 


## instalar todos as depêndencias php (na ocorrência de erros, remover o arquivo composer.lock.json e rodar o install novamente)
```
composer install
```

## criar e configurar o banco de dados no arquivo .env (pode ser baseado no arquivo .env-example na raiz do projeto).
notepad .env (windows)
nano .env (linux)

## rodar migrations (depois de configurar o banco de dados)
php artisan migrate

## criar a chave laravel do projeto
php artisan key:generate

## criar o link de acesso as imagens no storage
php artisan storage:link

## instalar dependências javascript (na ocorrência de erros, remover o arquivo yarn.lock e/ou package.lock.json e rodar o install novamente)
yarn install

## buildar os arquivos js com função observadora para utilização no desenvolvimento. (verifica alteração de código e builda de forma automática)
yarn watch

## buildar os arquivos js minimificados (para o produção)
yarn prod


