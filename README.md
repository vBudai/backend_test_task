# Результат выполнения:

## Эндпоинты:
Реализовано 2 эндпоинта:
    
1. POST: для расчёта цены\
`http://127.0.0.1:8337/calculate-price`

Пример JSON тела запроса:
```json
{
    "product": 1,
    "taxNumber": "DE123456789",
    "couponCode": "D15"
}
```


2. POST: для осуществления покупки\
`http://127.0.0.1:8337/purchase`

Пример JSON тела запроса:
```json
{
    "product": 1,
    "taxNumber": "IT12345678900",
    "couponCode": "D15",
    "paymentProcessor": "paypal"
}
```

При успешном выполнении запроса возвращается HTTP ответ с кодом 200.

При неверных входных данных или ошибках оплаты следует возвращается HTTP ответ с кодом 422, содержащий JSON объект с описанием ошибок.

## Запуск приложения:
Необходимо выполнить команду `make init-dev` или `make init-prod` (если есть заполненный файл .env).\
Команда запустит Symfony-приложение на порту 8337, а также выполнит миграцию БД и заполнит её тестовыми данными

## Тестовые данные
1. Таблица product:
    - Iphone (100 евро)
    - Наушники (20 евро)
    - Чехол (10 евро)


2. Таблица coupon:
    - D10 (скидка 10%)
    - D15 (скидка 15%)
    - D50 (скидка 50%)
    - D100 (скидка 100%)
