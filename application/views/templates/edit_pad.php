<form class="form-horizontal" method="POST" id="editpadform">
	<input type="hidden" name="id" value="<?=$pad['id']?>">
	<div class="form-group">
		<input type="text" name="title" class="form-control" placeholder="Название" required value="<?=$pad['title']?>">		
	</div>
	<div class="form-group">
		<textarea name="content" class="form-control" placeholder="Описание"><?=$pad['content']?></textarea>
	</div>
	<div class="form-group">
		<button class="btn btn-default" onclick="$('#popup').hide('400'); return false;">Отмена</button>
		<a href="/ajax/savepad" class="btn btn-success float-right" data-action="savepad" onclick="return false;">Сохранить</a>
	</div>
</form>