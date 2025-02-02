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

Обработка ошибок - минимум, данные сохраняются в data.json
Формы описываются в $itemTypes, словари в $dict

Что можно сделать:
- Валидацию/фильтрацию полей форм
- Маски ввода
- Отделить html от кода, шаблонизатор
- БД
- Авторизация
- Защита передаваемых данных из форм CSRF
- Права доступа/роли
- Конструктор форм ввода



https://github.com/user-attachments/assets/7c22c44b-9c51-4aab-9b99-04e6a4a9d286



