## Iniciando o projeto

ao clonar o projeto, voce precisa seguir os seguintes passos:

-   `composer install`
-   `php artisan migrate`
-   `php artisan db:seed`
-   `cp .env.example .env`
-   `php artisan key:generate`
-   `php artisan serve`

agora vamos inserir swagger ao projeto, voce precisara seguir os seguintes passos:

- `composer require darkaonline/l5-swagger`
- `php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"`
- `php artisan l5-swagger:generate`