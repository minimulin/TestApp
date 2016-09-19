<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="author" content="Artur Minimulin">

	<title><?=$this->getTitle();?></title>

	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
	<link href="/css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	</head>

	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Навигация</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Тестовое задание</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li <?=$request->getUri() == '/'?'class="active"':''?>><a href="/">Главная</a></li>
						<li <?=$request->getUri() == '/replies'?'class="active"':''?>><a href="/replies">Отзывы</a></li>
						<li <?=$request->getUri() == '/about'?'class="active"':''?>><a href="/about">О проекте</a></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<?php if(!$app::isAdmin()): ?>
							<li <?=$request->getUri() == '/login'?'class="active"':''?>><a href="/login">Авторизация</a></li>
						<?php else: ?>
							<li><a href="/login?action=logout">Выход</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
