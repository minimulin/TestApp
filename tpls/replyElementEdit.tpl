<form method="post" action="/replies/add" id="replyForm" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?=$reply['id']?>">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="name">Имя</label>
				<input type="text" class="form-control" name="name" id="name" placeholder="Введите имя" value="<?=$reply['name']?>"/>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<div class="input-group">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-envelope"></span>
					</span>
					<input type="text" name="email" class="form-control" id="email" placeholder="Введите электронный адрес" value="<?=$reply['email']?>" />
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="name">Сообщение</label>
				<textarea name="message" id="message" class="form-control" rows="9" cols="25" 								placeholder="Сообщение"><?=$reply['message']?></textarea>
			</div>
		</div>
	</div>
</form>