<div class="row">
	<div class="col-md-1">
		<div class="thumbnail">
			<img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
		</div><!-- /thumbnail -->
	</div><!-- /col-md-1 -->

	<div class="col-md-11">
		<div class="panel panel-default">
			<div class="panel-heading">
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
			</div><!-- /panel-body -->
		</div><!-- /panel panel-default -->
	</div><!-- /col-md-5 -->
</div><!-- /row -->