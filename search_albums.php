<?php


class SearchAlbum{
    public $folders = array();
    private $fileFormats = ['jpg', 'png', 'jpeg', 'gif'];

    function __construct($path){
        foreach(scandir($path) as $nameDir){
            if($nameDir == '.' or $nameDir == '..') continue;
            if(!is_dir($nameDir)) continue;

            $arr = $this-> searchPictures($path, $nameDir);
            if ($arr) $this -> folders["$nameDir"] = $arr;

                                                                               // функция для поиска совпадения, если оно есть, а если его нет,
                                                                                  // то вставка дефолтного изображения
                                                                                  // добавление в folders массив, где ключ - путь до папки,
                                                                                  // значение пути до фотографий

        }


    }

    private function doubleName($nameDir, $fileName){
        $word1  = pathinfo($fileName, PATHINFO_FILENAME);

        if(substr($nameDir, strlen($nameDir) - strlen($word1)) == $word1 or $word1 == $fileName){
            return true;
        }

        return false;

    }

    private function searchPictures($path, $nameDir){
        $pictures = [];
        $album = opendir($nameDir);
        while($fileName = readdir($album)){

            if($fileName == '.' or $fileName == '..') continue;
            if(!in_array(pathinfo($fileName, PATHINFO_EXTENSION), $this-> fileFormats)) continue;


            if($this -> doubleName($nameDir, $fileName)){
                $pictures['src'] = "$nameDir\\$fileName";
            } else{

                $pictures[] = "$nameDir\\$fileName";
            }

        }
        closedir($album);

        return $pictures;

    }
    public function isFolders(){
        if ($this->folders) return true;
        return false;
    }
    public function getFolders(){
        $result = [];
        foreach ($this->folders as $key => $value) {
            if(array_key_exists('src', $value)){
                $src = $value['src'];
                $result[] = '<a class="folders" href="'.$key.'"><img src="'.$src.'" width="800" height="600" alt="Click"></a>';
        }    else {
                $result[] = '<a class="folders" href="'.$key.'">Click</a>';
        }
        }
        return $result;
    }

    public function getPicturesInFolders($folder){

        return $this->folders[$folder];
    }


}
$path = __DIR__;
$a = new SearchAlbum($path);



echo $a->isFolders();
 ?>
