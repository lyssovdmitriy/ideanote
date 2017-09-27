<div class="container" style="padding-top:20px;">
	
<?php foreach ($users as $ar_user): ?>
	<a href="/admin/pads/<?=$ar_user['id']?>"><?=$ar_user['login']?></a><br>
<?php endforeach ?>
</div>