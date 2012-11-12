<ul>
<?php foreach ($content->feeditems as $item) {
	echo '<li><a href="'.$item->link.'">'.$item->title.'</a></li>';
}
?>
</ul>