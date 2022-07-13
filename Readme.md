# Демо-проект сервиса администрирования клиентов

Проект дает возможность развернуть небольшое приложение на стеке LAMP. Приложение представляет собой небольшой сервис,
задачей которого является администрирование списка клиентов компании N. Мы можем добавлять клиентов по одному, импортировать их из csv файла
и просматривать их данные.

Приложение имеет базу данных с одной таблицей и большой беклог от заказчиков. Этот беклог мы будем закрывать на занятии в режиме live-кодинга, 
параллельно узнавая о разных аспектах работы с php приложением

### 📚 Домашнее задание/проектная работа разработано(-на) для курса [PHP базовый](https://otus.ru/lessons/php-basic/?utm_source=github&utm_medium=free&utm_campaign=otus)

Как запустить проект?

Скачиваем Docker - https://www.docker.com/get-started/ и docker-compose - https://docs.docker.com/compose/install/

В корне проекта выполняем команду `docker-compose up -d`. Вы увидите какой-то такой вывод:

```bash
docker-compose up -d
Creating network "demoproject_default" with the default driver
Creating demoproject_lamp_1 ... done
```

Приложение запустилось! На этом этапе могут быть ошибки, если в вашей системе порты 80 или 3306 уже заняты каким-то сервисом. Если это так, можете остановить 
те приложения или выбрать другой порт в файле docker-compose.yml.

Далее нужно настроить соединение с БД. Это сделать легко. Набираем в консоли `docker-compose logs` и находим в логах запись вида

```bash
lamp_1  | => Done!
lamp_1  | ========================================================================
lamp_1  | You can now connect to this MySQL Server with mAaSuHka7u5D
lamp_1  | 
lamp_1  |     mysql -uadmin -pmAaSuHka7u5D -h<host> -P<port>
lamp_1  | 
lamp_1  | Please remember to change the above password as soon as possible!
lamp_1  | MySQL user 'root' has no password but only allows local connections
```

Копируем `-pmAaSuHka7u5D`, стираем оттуда -p - получится `mAaSuHka7u5D`, это наш пароль. Его надо будет поместить в файл www/lib/db.php:13

Далее подключаемся к БД по адресу localhost:3306 , используя логин admin и наш пароль и выполняем в консоли БД скрипт из start.sql

Приложение готово к использованию по адресу http://localhost !