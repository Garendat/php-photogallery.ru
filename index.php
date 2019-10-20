
<?php include_once('search_albums.php');
	$album = new SearchAlbum(__DIR__);
?>
<html>
<head>
	<title>Hello, World!</title>
	<link rel="stylesheet" href="./static/css/style.css" />
</head>
<body>
	<div class="container">


			<?php


			if ($album->isFolders() == true){
				foreach ($album->getFolders() as $key => $value) {

					echo $value;
				}
			}




			?>

	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="./static/js/index.js"></script>

</body>
</html>
