test_callcenter
===============

<h4>Демо: http://call.denis.by</h4><br>
<br>
<b>Установка:</b><br>
1. enigne/data/config.php - правим доступ к бд. И устанавливаем интервал до автоматической разблокировки.<br>
2. install.php<br>
готово<br>
<br>
<b>Подробнее о некотором:</b> <br>
0. index.php - отправная точка ;)<br>
1.enigne/classes/class.CallCenterMySQL.php - Класс работы с нашей базой данной. Функции выборки/блокировки/освобождения...<br>
2.enigne/api - принимает запросы / исполняет и отдает JSON в ответ.  <br>
3. /template - файлы шаблона<br>
4. template/js/call.js  - отвечает за логику FRONT'a  формирует запросы / принимает ответ / следит за таймером и изменениями стаутсов.<br>

<b>Мои контакты:</b> <br>
e-mail: i@denis.by<br>
tel.: +375-44-7409237<br>
