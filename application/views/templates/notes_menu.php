<div class="list-group">
	<?php foreach ($notes as $ar_note): ?>
		<?php if ($ar_note['id'] == $cur_note_id){
			$active = 'active';
		}	else{
			$active = '';
		}
		?>
	  <a href="/ajax/note/<?=$ar_note['id']?>" data-id="<?=$ar_note['id']?>" data-action="show" class="<?=$active?> list-group-item list-group-item-action flex-column align-items-start">
	    <div class="d-flex w-100 justify-content-between">
	      <h6 class="mb-1"><?=$ar_note['title']?></h6>
	      <!-- <small><?=$ar_note['datetime']?></small> -->
	    </div>
	    <p class="mb-1" style="font-size: 13px;"><?=substr($ar_note['text'], 0,50)?>...</p>
	    <small style="font-size: 10px;"><?=$ar_note['datetime']?></small>
	  </a>
	<?php endforeach ?>
</div>