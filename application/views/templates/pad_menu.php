<div class="list-group">
	<a href="/ajax/newpad" data-action="newpad" class="list-group-item list-group-item-action flex-column align-items-start" onclick='return false;' >
		 <div class="d-flex w-100 justify-content-between">
	      <h6 class="mb-1">Новый блокнот...</h6>
	    </div>
	</a>
	<?php foreach ($pads as $ar_pad): ?>
		<?php if ($ar_pad['id'] == $cur_pad_id){
			$active = 'active';
		}	else{
			$active = '';
		}
		?>
	  <a href="/ajax/getnotes/<?=$ar_pad['id']?>" data-action="getnotelist" class="<?=$active?> list-group-item list-group-item-action flex-column align-items-start" onclick='return false;'>
	    <div class="d-flex w-100 justify-content-between">
	      <h6 class="mb-1"><?=$ar_pad['title']?></h6>
	    </div>
	    <p class="mb-1" style="font-size: 13px;"><?=$ar_pad['content']?></p>
			<div class="pad_menu" onclick="return false;" data-id='<?=$ar_pad['id']?>' data-title='<?=$ar_pad['title']?>'>
				<div class="circle"></div>
				<div class="circle"></div>
				<div class="circle"></div>
			</div>
			<div class="pad_menu_full" id="pmf_<?=$ar_pad['id']?>">
				<div class="change">
					Изменить
				</div>
				<div class="del">
					Удалить
				</div>
			</div>
	  </a>
	<?php endforeach ?>
</div>