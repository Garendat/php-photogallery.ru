<?php
	$DirName = 'gallery';
	include_once("./$DirName/search_albums.php");

	$album = new SearchAlbum(__DIR__);

	if(!$_GET['folder']){
		$title = 'Photogallery';
	} else {
		$title = $_GET['folder'];
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title><?php echo $title?></title>

	<link rel="stylesheet" href="./static/fancybox/jquery.fancybox.min.css"/>


	<link rel="stylesheet" href="./static/css/style.css" />

</head>
<body>
	<?php include_once('./header.html') ?>
	<div class="container">


			<?php

			if (!$_GET['folder']){
			if ($album->isFolders()){
				foreach ($album->getFolders() as $key => $value) {

					echo $value;
				}
			} else {
				echo '<h1 class="error" > Файлов нет, но вы держитесь!</h1>';
			}



		} else if ($album -> folderInFolders($_GET['folder'])) {
			foreach ($album->getPicturesInFolders($_GET['folder']) as $key => $picture) {
				$img = '<img src="./'.$picture.'"/>';
	            $div = '<a data-fancybox="gallery" href="./'.$picture.'" class="item-image"><div class="image">'. $img .'<h2>Увеличить</h2></div></a>';
				echo $div;
			}

		} else {
			echo '<h1 class="error" > Такой папки нет, но вы держитесь!</h1>';
		}{

		}



			?>
	</div>



<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="./static/fancybox/jquery.fancybox.min.js"></script>

<script src="./static/js/index.js"></script>

</body>
</html>
