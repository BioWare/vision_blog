# Blog API

## Установка

1. Склонируйте репозиторий:
    ```sh
    git clone <repository-url>
    cd vision_blog 
    ```

2. Установите зависимости:
    ```sh
    composer install
    ```

3. Скопируйте файл `.env.example` в `.env` и настройте его:
    ```sh
    cp .env.example .env
    ```

4. Запустите Sail:
    ```sh
    ./vendor/bin/sail up -d
    ```

5. Выполните миграции:
    ```sh
    ./vendor/bin/sail artisan migrate
    ```

## Использование

- Регистрация пользователя:
    ```sh
    POST /api/register
    ```

- Логин пользователя:
    ```sh
    POST /api/login
    ```

- CRUD операции с постами (требуется аутентификация):
    ```sh
    GET /api/posts
    POST /api/posts
    PUT /api/posts/{post}
    DELETE /api/posts/{post}
