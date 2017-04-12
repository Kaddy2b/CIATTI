<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?php echo $page_title; ?></title>
	<link rel="icon" type="image/png" href="lib/images/logo.jpeg"/>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="js/script.js" defer></script>
</head>
<body>
	<?php include File::build_path(array("View", "header.php"));
	
	if (isset($controller)) {
        $filepath = File::build_path(array("View", $controller, "$view.php"));
        require $filepath;
    }
    else {
        $filepath = File::build_path(array("View", "$view.php"));
        require $filepath;
    }

    ?>
</body>
</html>