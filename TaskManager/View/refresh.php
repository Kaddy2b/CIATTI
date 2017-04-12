<?php
if ($page_title == "Acheteurs") {
	$path = "?controller=fleche&action=readByType&categorie=acheteurs";
} else if ($page_title == "Fournisseurs") {
	$path = "?controller=fleche&action=readByType&categorie=fournisseurs";
}
?>

<body onload='setTimeout(function(){redirection(<?php echo '"' . $ancre . '", "' . $path .'"'; ?>);},1000);'>
	<?php echo "<p>loading. . .</p>";
	$rand1 = rand(1,6);
	$rand2 =rand(1,2);
	if ($rand2 == 1) {
		$format = ".jpg";
	} else {
		$format = ".png";
	}
	$img = $rand1 . $format;
	$path_img = "lib/images/memes/" . $img;
	?>

	<img src="<?php echo $path_img; ?>" alt="lol">
</body>