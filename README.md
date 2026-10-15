# Лабораторна робота 3 — Робота з базою даних у Laravel

- **Студент:** Могилін Владислав Олександрович, група 6.1224
- **Варіант:** 7 — «Продаж одягу»
- **Тема оформлення:** `market-grid` (компактна сітка карток)
- **Стек:** Laravel 13, PHP 8.3, MySQL 8.4, Docker Compose (`webdevops/php-nginx:8.3-alpine`)

Застосунок лабораторної №2 перенесено до `lab3`. Дані зберігаються в MySQL (категорії й продукти),
Blade-сторінки та JSON API використовують один `CatalogService`.

## Запуск

```bash
cp .env.example .env              # у PowerShell: Copy-Item .env.example .env
docker compose up -d
docker compose exec --user application app sh
# у контейнері:
composer install
php artisan key:generate
php artisan migrate --seed
```

Сайт: http://localhost:8080. Повторне `php artisan db:seed` не додає дублікатів і не переписує продукти.

## Корисні команди (у контейнері)

```bash
php artisan migrate:status
php artisan model:show Product
php artisan db:show --counts
php artisan route:list
```

## Контракт

| GET-запит | Відповідь |
|---|---|
| `/` | HTML, три рекомендовані продукти, 200 |
| `/catalog` | HTML, фільтри й пагінація, 200 |
| `/catalog/{slug}` | HTML продукту, 200 |
| `/api/catalog` | JSON: `data`, `links`, `meta`, 200 |
| `/api/catalog/{slug}` | JSON продукту в `data`, 200 |
| невідомий HTML-шлях або slug | оформлена сторінка, 404 |
| невідомий API-шлях або slug | JSON із `message`, 404 |
| некоректні API-параметри | JSON із `message` та `errors`, 422 |

Параметри: `q` (до 100 символів), `category`, `operation`, `sort` (`newest`, `price_asc`, `price_desc`),
`page` (від 1), `per_page` (9, 12 або 24).

## Postman

1. Імпортуйте `postman/lab3.postman_collection.json` (Import → Files).
2. Переконайтеся, що змінна колекції `base_url` дорівнює `http://localhost:8080` (без кінцевого слеша).
   У веб-версії Postman для `localhost` потрібен Desktop Agent.
3. Спочатку виконайте запит `01 Список продуктів`: він зберігає `known_slug`, `category`, `operation`, `search`.
4. Запустіть колекцію через Collection Runner: 15 запитів, 46 перевірок.

## Зупинка

```bash
docker compose stop      # дані MySQL зберігаються в томі mysql-data
```

`docker compose down -v` видаляє том разом із даними.