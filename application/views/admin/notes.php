<div class="container" style="padding-top:20px;">
<?php foreach ($ar_notes as $ar_note): ?>
	<a href="/admin/note/<?=$ar_note['id']?>"><?=$ar_note['title']?></a><br>
<?php endforeach ?>
</div>