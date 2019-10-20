<?php
	$DirName = 'gallery';
	include_once("./$DirName/search_albums.php");

	$album = new SearchAlbum(__DIR__);
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title>Hello, World!</title>
	<link rel="stylesheet" href="./static/css/style.css" />
</head>
<body>
	<?php include_once('./header.html') ?>
	<div class="container">


			<?php

			if (!$_GET['folder']){
			if ($album->isFolders() == true){
				foreach ($album->getFolders() as $key => $value) {

					echo $value;
				}
			} else {
				echo '<h1> Файлов нет, но вы держитесь!</h1>';
			}



		} else {
			foreach ($album->getPicturesInFolders($_GET['folder']) as $key => $picture) {
				$img = '<img src="'.$picture.'"/>';
	            $div = '<div class ="image">'. $img .'<h2>Увеличить</h2></div>';
				echo $div;
			}

		}



			?>

	</div>
<?php include_once('./footer.html') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="./static/js/index.js"></script>

</body>
</html>
