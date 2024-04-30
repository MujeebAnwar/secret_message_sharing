### Start
- Clone the repo ```https://github.com/MujeebAnwar/secret_message_sharing.git```
- Copy `.env.example` file to `.env` and edit database credentials and `SANCTUM_STATEFUL_DOMAINS` `env` variable and set you domain without `http`  
- Run `composer install`
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Run `npm install`
- Run `npm run build`

### Run locally
- Run the application ```php artisan serve```
