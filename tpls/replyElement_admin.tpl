<div class="row">
	<div class="col-md-1">
		<div class="thumbnail">
			<img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
		</div><!-- /thumbnail -->
	</div><!-- /col-md-1 -->

	<div class="col-md-11">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="btn-group pull-right">
					<a href="#" class="btn btn-success btn-xs replyChangeStatus" data-id="<?=$reply['id']?>" data-status="apply"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
					<a href="#" class="btn btn-danger btn-xs replyChangeStatus" data-id="<?=$reply['id']?>" data-status="reject"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
				</div>
				<div class="btn-group pull-right spacer"></div>
				<div class="btn-group pull-right">
					<a href="#" class="btn btn-default btn-xs replyEdit" data-id="<?=$reply['id']?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
				</div>
				<strong><?=$reply['name']?></strong> (<?=$reply['email']?>) <span class="text-muted">оставил отзыв <span title="<?=$reply['created_at']?>"><?=timeAgo($reply['created_at'])?></span></span>
			</div>
			<div class="panel-body">
				<?=$reply['message']?>

				<?php if($reply['image']): ?>
					<hr>
					<div class="text-center">
						<img src="<?=$reply['image']?>">
					</div>
				<?php endif; ?>

				<hr>

				<div>
					Статус: 
					<?php if($reply['is_active'] === '1'): ?>
						<span class="text-left text-success">
							Принят
						</span>
					<?php else: ?>
						<span class="text-left text-warning">
							Отклонён
						</span>
					<?php endif; ?>
					<?php if($reply['edited'] === '1'): ?>
						<span class="pull-right text-right text-success">
							Изменён администратором 
						</span>
					<?php endif; ?>
				</div>
			</div><!-- /panel-body -->
		</div><!-- /panel panel-default -->
	</div><!-- /col-md-5 -->
</div><!-- /row -->