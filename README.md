# Atividade de Service e Testes

Projeto Laravel na pasta `produtos`, com o `ProductService` e os testes.

- `app/Services/ProductService.php`: métodos `create` e `update` = o preço precisa ser maior que zero
- `tests/Feature/ProductServiceTest.php`: 3 testes 1 de create com preço inválido e 2 de update

## Os testes

```bash
cd produtos
composer install
copy .env.example .env
php artisan key:generate
php artisan test --filter=ProductServiceTest
```