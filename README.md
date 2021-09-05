# E.V.Kashkin_MainWebProject
 It's "Web Programming Technology" semester final project which checks and confirms our knowledge of making web sites.
 
 ## Описание
 <p>Это главный каталог с файлами сайта для сдачи на зачёте преподавателю "Web-технологии программирования" — Евгению Владимировичу Кашкину. Такой проект по Web'у для меня является самым первым, поэтому не суди строго <b>:)</b>. Ты точно найдёшь здесь что-нибудь полезное для себя, раз уж ты сюда зашёл)</p>
 <h3>Структура</h3>
 <p><ol>
   <li><b>Стили CSS</b>: два файла с именами <b><i>"Styles.css"</i></b> и <b><i>"StylesAutorization2.css"</i></b>. Первый — это общие стили для страниц сайта, а второй содержит стили для страницы регистрации.</p></li>
   <li><p><b>Страницы регистрации и авторизации</b>: это ещё два PHP-файла — <b><i>"authorization.php"</i></b>, страница авторизации, и <b><i>"poetry.php"</i></b>, соответственно страница регистрации нового пользователя. В файле с авторизацией присутствует JavaScript-код с использованием <b>технологии AJAX</b> (обращения к серверу без перезагрузки страницы у пользователя) в функции <b><i>"checkUser()"</i></b>. Функция <b><i>"CreateRequest()"</i></b> необязательна и носит вспомогательный характер.</p></li>
   <li><b>Чистая обработка данных на PHP</b>: это несколько файлов в проекте, которые не отображают никаких страниц сайта, а чисто обрабатывают данные, соединяясь с <b>базой данных</b> сервера. Они содержат только PHP-код. Это файлы:
     <ul>
      <li><p><b><i>"check_user.php"</i></b> — вызывается при авторизации пользователя: проверяет, есть ли указанный в форме входа на сайт пользователь в базе данных, и, если сеть, предоставляет доступ к личному кабинету этого пользователя.</p></li>
      <li><p><b><i>"new_user.php"</i></b> — этот код вызывается при регистрации нового пользователя на сайте с помощью формы регистрации на соответствующей странице сайта. Тут тоже происходит обращение к БД и занесение в неё с помощью SQL информации о новом пользователе.</p></li>
      <li><p><b><i>"new_comment.php"</i></b> — добавляет новый комментарий, оставленный на главной странице сайта, в базу данных.</p></li>
     </ul></p>
 
   <p>Также есть файл с дополнительными упрощающими написание PHP-кода функциями — файл <b><i>"help.php"</i></b>.</p></li>
   <li><p><b>Остальные файлы</b>: это файлы <ul>
 <li><b><i>error.php</i></b>: со страницей для вывода пользователю каких-то ошибок (некрасиво отображает инфу);</li>
 <li><b><i>"composition.php"</i></b>: с произведением, которое пользователь добавляет на сайт (не реализовано — не успел <b>:)</b> );</li>
 <li><b><i>"account_info.php"</i></b>: со страницей личного кабинета (здесь тоже сделано, что я успел).</li>
 <li><b><i>"main.php"</i></b>: это главная страница сайта с вводной статьёй о поэзии — главной теме проекта — и возможностью прокомментировать её.</li>
 </ul>
 </p></li>
 </ol></p>
 
 <h3>Файл index.html</h3>
 <p>Это файл, который на сервере у провайдера web-услуг должен быть начальным, то есть запускающимся первым при заходе пользователя на сайт. Я сделал его без какого-либо полезного содержания — просто добавил его в проект как перенаправляющий на главную страницу <b><i>"main.php"</i></b>.</p>
