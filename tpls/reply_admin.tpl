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
		<?php include 'replyElement_admin.tpl' ?>
	<?php endforeach;?>

	<!-- Modal -->
	<div class="modal fade" id="replyEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Редактирование отзыва</h4>
				</div>
				<div class="modal-body">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
					<button type="button" class="btn btn-primary saveReplyModal">Сохранить</button>
				</div>
			</div>
		</div>
	</div>
</div><!-- /container -->

<?php include 'footer.tpl' ?>