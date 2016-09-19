<?php include 'header.tpl' ?>

<div class="page-header">
	<h1>Авторизация</h1>
</div>

<div class="container">

	<form class="form-signin" action="/login" method="post">
		<label for="inputEmail" class="sr-only">Логин</label>
		<input type="text" name="login" id="inputEmail" class="form-control" placeholder="Логин" required autofocus>
		<label for="inputPassword" class="sr-only">Пароль</label>
		<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Пароль" required>

		<button class="btn btn-lg btn-primary btn-block" type="submit">Авторизоваться</button>
	</form>

</div> <!-- /container -->

<?php include 'footer.tpl' ?>