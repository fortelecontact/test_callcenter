test_callcenter
===============

Демо:
http://call.denis.by

Установка:
1. enigne/data/config.php - правим доступ к бд. И устанавливаем интервал до автоматической разблокировки.
2. install.php
готово

Подробнее о некотором: 
0. index.php - отправная точка ;)
1.enigne/classes/class.CallCenterMySQL.php - Класс работы с нашей базой данной. Функции выборки/блокировки/освобождения...
2.enigne/api - принимает запросы / исполняет и отдает JSON в ответ.  
3. /template - файлы шаблона
4. template/js/call.js  - отвечает за логику FRONT'a  формирует запросы / принимает ответ / следит за таймером и изменениями стаутсов.

Мои контакты: 
e-mail: i@denis.by
tel.: +375-44-7409237