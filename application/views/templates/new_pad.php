<form class="form-horizontal" method="POST" id="newpadform">
	<div class="form-group">
		<input type="text" name="title" class="form-control" placeholder="Название" required>		
	</div>
	<div class="form-group">
		<textarea name="content" class="form-control" placeholder="Описание"></textarea>
	</div>
	<div class="form-group">
		<button class="btn btn-default" onclick="$('#popup').hide('400'); return false;">Отмена</button>
		<a href="/ajax/makenewpad" class="btn btn-success float-right" data-action="makenewpad" onclick="return false;">Создать</a>
	</div>
</form>