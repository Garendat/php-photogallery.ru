<?php


class SearchAlbum{
    private $folders = array();
    private $fileFormats = ['jpg', 'png', 'jpeg', 'gif'];
    private $faces_folders = array();


    function __construct($path){
        foreach(scandir($path) as $nameDir){
            if($nameDir == '.' or $nameDir == '..' or $nameDir == basename(__DIR__)) continue;
            if(!is_dir($nameDir)) continue;

            $arr = $this-> searchPictures($path, $nameDir);
            if ($arr) $this -> folders["$nameDir"] = $arr;
        }


    }

    private function doubleName($nameDir, $fileName){  // проверка совпадения имени с картинкой
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
                $this-> faces_folders[$nameDir] = "$nameDir\\$fileName";
            }

            $pictures[] = "$nameDir\\$fileName";


        }
        closedir($album);
        if(!array_key_exists($nameDir, $this-> faces_folders) and $pictures){
            $this-> faces_folders[$nameDir] = "./". basename(__DIR__)."/alternative.jpg";
        }

        return $pictures;

    }

    public function isFolders(){   //вывод true или false в зависимости от того есть у нас что-то или нет
        if ($this->folders) return true;
        return false;
    }


    public function folderInFolders($folderName){
        if($this->folders[$folderName]) return true;
        return false;
    }

    public function getFolders(){
        $result = [];
        foreach ($this->folders as $key => $value) {

            $img = '<img src="'.$this-> faces_folders[$key].'"/>';
            $figure = '<a href="./index.php?folder='.$key. '"><figure class ="folder" id="'.$key.'">'. $img .
            '<figcaption><h2>Folder</h2></figcaption></figure> </a>';
            $result[] = $figure;
        }
        return $result;
    }

    public function getPicturesInFolders($folder) {return $this->folders[$folder];}

}

 ?>
