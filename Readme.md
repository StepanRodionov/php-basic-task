# Демо-проект сервиса администрирования клиентов

Проект дает возможность развернуть небольшое приложение на стеке LAMP. Приложение представляет собой небольшой сервис,
задачей которого является администрирование списка клиентов компании N. Мы можем добавлять клиентов по одному, импортировать их из csv файла
и просматривать их данные.

Приложение имеет базу данных с одной таблицей и большой беклог от заказчиков. Этот беклог мы будем закрывать на занятии в режиме live-кодинга, 
параллельно узнавая о разных аспектах работы с php приложением

## Как запустить проект?

1. С помощью docker
    - установить на локальной машине docker
    - выполнить в корне проекта команду `docker-compose up -d`
    - выполнить команду `docker-compose logs`
    - найти в логах запись вида `mysql -uadmin -p9LMc2eoadfUQ -h<host> -P<port>`
    - скопировать пароль (из записи выше -p9LMc2eoadfUQ , только без "-p": 9LMc2eoadfUQ)
    - записать пароль в массив $conf в файле db.php (в ключ password)

После запуска:
 - установить nano apt update + apt install nano
 - задать в /etc/php/8.0/apache2 в файле php.ini display_errors = on

### 📚 Домашнее задание/проектная работа разработано(-на) для курса [PHP базовый](https://otus.ru/lessons/php-basic/?utm_source=github&utm_medium=free&utm_campaign=otus)