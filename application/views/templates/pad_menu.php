<?php foreach ($pads as $ar_pad) { ?>
 <a class="dropdown-item" href="/ajax/getnotes/<?=$ar_pad['id']?>" data-action='getnotelist' onclick='return false;'><?=$ar_pad['title']?></a>
<? } ?>
