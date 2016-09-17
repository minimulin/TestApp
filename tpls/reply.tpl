<?php include 'header.tpl' ?>

<div class="page-header">
	<h1>Обратная связь</h1>
</div>

<?php foreach($data as $reply):?>
	<?php include 'replyElement.tpl' ?>
<?php endforeach;?>

<?php include 'footer.tpl' ?>