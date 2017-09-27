<div class="container" style="padding-top:20px;">
<?php foreach ($pads as $ar_pad): ?>
	<a href="/admin/notes/<?=$ar_pad['id']?>"><?=$ar_pad['title']?> - <?=$ar_pad['content']?></a><br>
<?php endforeach ?>
</div>