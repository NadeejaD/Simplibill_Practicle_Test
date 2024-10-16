
# Simplibill Practical Test

A brief description of what this project does and who it's for


## Deployment

To deploy this project run

```bash
  1.composer install
  2.npm install
  3.cp .env.example .env
  4.php artisan key:generate
```
after that update the env file. then,

```bash
  5.php artisan migrate
  6.php artisan db:seed
```

clear cache
```bash
  7.php artisan cache:clear
```

run
```bash
 8. npm run dev
 9. php artisan serve
```

unit test
```bash
 10. php artisan test --filter PostTest (When you run the unit-test database data will clear)
```

admin details
```bash
url : http://127.0.0.1:8000/login
email : admin@mail.com
pasword : 123456789
```


