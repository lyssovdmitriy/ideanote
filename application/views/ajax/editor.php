<form class="form" id="edit-form">
	<h6>Название:</h6>
	<div class="input-group note-title-group">
		<input type="text" name="title" id='note-title' class='form-control' value="<?=@$note['title']?>" aria-describedby="title-addon">
	</div>
	<h6>Текст:</h6>	
	<textarea name="text" id="note-content" cols="30" rows="10" class="form-control"><?=@$note['text']?></textarea>
</form>