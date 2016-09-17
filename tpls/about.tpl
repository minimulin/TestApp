<?php include 'header.tpl' ?>

<div class="page-header">
	<h1>Информация о реализации</h1>
</div>

<h3>Системные требования</h3>
<ul>
<li>PHP >=5.4</li>
<li>MySQL >=5.2</li>
<li>composer</li>
</ul>

<h3>Общая информация</h3>

<p>Здесь будет немного текста</p>

<h3>Структура проекта</h3>
<ul>
	<li>
		<code>/config</code> — директория с конфигурационными файлами
		<ul>
			<li><code>app.php</code> — общий конфигурационный файл</li>
			<li><code>routing.php</code> — в данном файле описываются роуты</li>
		</ul>
	</li>
	<li>
		<code>/public</code> — общедоступная директория, в которую смотрит web-сервер
	</li>
	<li>
		<code>/src</code> — директория с конфигурационными файлами
		<ul>
			<li><code>/Controller</code> — Директория с пользовательскими контроллерами</li>
			<li>
				<code>/Kernel</code> — ядро фреймворка
				<ul>
					<li><code>/Controller/BaseController.php</code> — отец всех контроллеров.</li>
					<li><code>/Controller/Request.php</code> — реализация работы с запросом, получение параметров и т.д.</li>
					<li><code>/Controller/Router.php</code> — реализация работы с роутами, поиск нужного контроллера, передача управления контроллеру.</li>
					<li><code>/App.php</code> — класс приложения, сюда сводятся все процессы. Выполняет управление всеми аспектами работы приложения</li>
					<li><code>/ConfigReader.php</code> — выполняет чтение из конфигурационных файлов</li>
				</ul>
			</li>
			<li><code>/helpers.php</code> — файл для глобальных функций</li>
		</ul>
	</li>
	<li>
		<code>/tpls</code> — здесь хранятся шаблоны
	</li>
	<li>
		<code>/vendor</code> — директория со сторонними пакетами. В данном проекте они не используются. Здесь находится только классы от автолоадера composer'а
	</li>
</ul>


<?php include 'footer.tpl' ?>