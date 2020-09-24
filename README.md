## Запуск

После клонирования репозитория последовательно выполните следующие команды:

Установка всех зависимостей
```
composer install
```

Создание файла окружения
```
cp .env.example .env
```

Генерация ключа приложения
```
php artisan key:generate
```

Доступы к БД
настроить можно в `.env`

Запуск миграций
```
php artisan migrate
````

## API

Создание черновика документа
```
POST /api/v1/document HTTP/1.1
accept: application/json
```

Получение документ по id
```
GET /api/v1/document/718ce61b-a669-45a6-8f31-32ba41f94784 HTTP/1.1
accept: application/json
```

Редактирование документа
```
PATCH /api/v1/document/718ce61b-a669-45a6-8f31-32ba41f94784 HTTP/1.1
accept: application/json
content-type: application/json
{
   "document":{
      "payload":{
         "actor":"The fox",
         "meta":{
            "type":"quick",
            "color":"brown"
         },
         "actions":[
            {
               "action":"jump over",
               "actor":"lazy dog"
            }
         ]
      }
   }
}
```

Публикация документа
```
POST /api/v1/document/718ce61b-a669-45a6-8f31-32ba41f94784/publish HTTP/1.1
accept: application/json
```

Получение списка документов
```
GET /api/v1/document/?page=1 HTTP/1.1
accept: application/json
```