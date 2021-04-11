# Guest Book

## Deployment
- Configure .env
- Install dependencies and migrate
    ```bash
    composer install
    npm install && npm run build

    php artisan migrate
    php artisan db:seed
    ```
- Serve with your favorite web-server
- Login credentials:
    - bjadmund@mail.ru
    - password