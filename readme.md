# Test

Настройка nginx для роутинга

    location /api/ {
        try_files $uri /index.php?$args;
    }

    location / {
	    try_files $uri $uri/ /index.html;
    } 

Для простоты используются:
- css - Bootstrap 5 
- ajax - htmx

API:
- GET /api/getFormTypes
- GET /api/getForm
- POST /api/saveRecord
- GET /api/getRecord
- DELETE /api/delRecord

Обработка ошибок - минимум, данные сохраняются в data.json
Формы описываются в $itemTypes, словари в $dict

Что можно сделать:
- Валидацию/фильтрацию полей форм
- Маски ввода
- Разнообразие типов полей ввода - даты, диапазоны, блок текста, ...
- Отделить html от кода, шаблонизатор
- Кэширование форм
- Пагинация, поиск
- БД
- Авторизация
- Защита передаваемых данных из форм CSRF
- Права доступа/роли
- Конструктор форм ввода

Видео работы:
<video src='https://github.com/user-attachments/assets/7c22c44b-9c51-4aab-9b99-04e6a4a9d286' width=480/> |




