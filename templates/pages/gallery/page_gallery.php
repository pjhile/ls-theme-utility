<div class="gallery_block"></div>
<?
$data_list = array();
$old_path = 'resources/images/gallery';
$new_path = 'uploaded/thumbnails';
$site_path = PATH_APP;
$images = array();

if($h1 = opendir($site_path . '/' . $old_path)) {
	while(($f1 = readdir($h1)) !== false) {
		if($f1 == '.' || $f1 == '..')
			continue;
		
		if(!is_file($site_path . '/' . $old_path . '/' . $f1) && !preg_match ("#\.(jpeg|jpg|gif|png|bmp)$#i", $f1)) 
			continue;
		
		$images[] = $f1;
	}	
}

sort($images);

foreach($images as $old_file) {
	$new_file = "thumb_" . $old_file;

	if(!file_exists($site_path . '/' . $new_path . '/' . $new_file))
		Phpr_Image::makeThumbnail($site_path . '/' . $old_path . '/' . $old_file, $site_path . '/' . $new_path . '/' . $new_file, 140, 105);

	$root_url = root_url('/');

	$data_list[] = array('image' => $root_url . $old_path . $root_url . $old_file, 'thumb' => $root_url . $new_path . $root_url . $new_file);
}
?>

<script>
$(window).load(function() {
	var data = <?= json_encode($data_list) ?>;

	var galleria = $('.gallery_block').galleria({
		data_source: data
	});	
	
	galleria = Galleria.get(0);

	$('#cycle-previous').click(function() { galleria.prev(); });
	$('#cycle-next').click(function() { galleria.next(); });
});
</script>