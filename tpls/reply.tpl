<?php include 'header.tpl' ?>

<div class="page-header">
	<h1>Обратная связь</h1>
</div>

<div class="container">
	<div class="btn-toolbar" id="sortButtons" role="toolbar">
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-default <?=$app::getSession('repliesSort')=='created_at'?'btn-primary':''?>" data-sort="created_at">
				По дате добавления
			</button>
			<button type="button" class="btn btn-default <?=$app::getSession('repliesSort')=='name'?'btn-primary':''?>" data-sort="name">
				По имени автора
			</button>
			<button type="button" class="btn btn-default <?=$app::getSession('repliesSort')=='email'?'btn-primary':''?>" data-sort="email">
				По email
			</button>
		</div>
	</div>

	<?php foreach($data as $reply):?>
		<?php include 'replyElement.tpl' ?>
	<?php endforeach;?>
</div><!-- /container -->

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="well well-sm">
				<form method="post" action="/replies/add" id="replyForm" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Имя</label>
								<input type="text" class="form-control" name="name" id="name" placeholder="Введите имя"/>
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<div class="input-group">
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-envelope"></span>
									</span>
									<input type="text" name="email" class="form-control" id="email" placeholder="Введите электронный адрес"/>
								</div>
							</div>
							<div class="form-group">
								<label for="email">Изображение (PNG, JPG, GIF)</label>
								<div class="fileinput fileinput-new input-group" data-provides="fileinput">
									<div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
									<span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Выбрать файл</span><span class="fileinput-exists">Изменить</span><input type="file" name="image"></span>
									<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Отмена</a>
								</div>
							</div>
							<div class="progress">
								<div class="progress-bar" role="progressbar" 
								aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Сообщение</label>
								<textarea name="message" id="message" class="form-control" rows="9" cols="25" 								placeholder="Сообщение"></textarea>
							</div>
						</div>
						<div class="col-md-12 text-right">
							<a href="#" class="btn btn-primary" id="messagePreview">Предварительный просмотр</a>
							<button type="submit" class="btn btn-success" id="btnContactUs">Отправить</button>
						</div>
					</div>
				</form>

				<div id="previewContainer" style="display: none;">
					<h3>Предварительный просмотр</h3>

					<div class="previewHtml">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.tpl' ?>