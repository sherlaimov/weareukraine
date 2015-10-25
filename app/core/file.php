<?php

class File
{

    public $filename;
    public $type;
    public $size;
    public $extension;
    private $temp_path; //nah nuzhen? Мы хватаем файл отсюда в итоге?
    private $filePath;
    private $tempName; //resulting file name, maybe a different naming convention would be better?
    public $thumbName;
    //protected $uploadDir = 'img';
    protected $allowedImages = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
    public $errors = array();
    protected $upload_errors = array(
        UPLOAD_ERR_OK => 'No errors',
        UPLOAD_ERR_INI_SIZE => 'Larger than upload_max_filesize',
        UPLOAD_ERR_FORM_SIZE => 'Larger than form MAX_FILE_SIZE',
        UPLOAD_ERR_PARTIAL => 'Partial upload',
        UPLOAD_ERR_NO_FILE => 'No file',
        UPLOAD_ERR_NO_TMP_DIR => 'No temporary directory',
        UPLOAD_ERR_CANT_WRITE => 'Cannot write to disk',
        UPLOAD_ERR_EXTENSION => 'File upload stopped by extension'
    );

    function __construct($file)
    {
        if (!$file || empty($file) || !is_array($file)) {
            Message::add('No file was uploaded', Message::STATUS_ERROR);
            return false;
        } elseif( ! in_array(static::extension($file['name']), $this->allowedImages)) {
            Message::add('The only allowed file extensions: ' . implode(', ', $this->allowedImages), Message::STATUS_ERROR);
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors[$file['error']];
            print_r($this->errors);
            die;
            return false;
        }
        //set object attributes to the form parameters
        $this->temp_path = $file['tmp_name'];
        $this->filename = basename($file['name']);
        $this->type = $file['type'];
        $this->size = $file['size'];
        $this->extension = static::extension($file['name']);
        $this->tempName = $this->tempName();
        $this->filePath = $this->filePath();
//        $this->uploadDir = FS_IMAGES . $file_name_new;

        return true; //why returning true here?
    }


    public function getImageInfo()
    {

        $data = array(
            'image_name' => $this->tempName . '.jpg',
            'tmp_name' => $this->temp_path,
            'type' => $this->type,
            'extension' => $this->extension,
            'file_path' => $this->filePath,
        );
        return $data;

    }

    public function tempName()
    {
        $file_name_tmp = md5($this->filename . rand(0, 10000));
        return $file_name_tmp;
    }

//    public function thumbName($width, $height)
//    {
//        return $this->tempName . '_' . $width . '_' . $height . 'jpg';
//    }
    public function filePath()
    {
        //string 'C:\OpenServer\domains\weareukraine\public/images\b384d31de70fa413bfb9a46562872bc9.jpg' (length=85)
        return $filePath = FS_IMAGES . $this->tempName . '.' . $this->extension;

    }

    public function createThumb($width, $height)
    {
        $ext = $this->extension;

        if (in_array($ext, $this->allowedImages)) {
            $filePath = $this->filePath;
            $this->thumbName = $this->tempName . '_' . $width . '_' . $height . '.jpg';
            $bitmap = $this->createThumbBitmap($filePath, false, $width, $height);
            return imagejpeg($bitmap, FS_IMAGES . 'thumb' . DS . $this->thumbName);
        } else {
            Message::add('File extension must be either of these extensions: ' . join(', ', $this->allowedImages), Message::STATUS_ERROR);
            return false;
        }


    }


    public function createThumbBitmap($path, $save, $width, $height)
    {
        //var_dump($path);
        $info = getimagesize($path);
//        echo $path . '<br/>';
//        print_r($info);
//        echo '<br/>';
        $fileInfo = pathinfo($path);
        //print_r($fileInfo);die;


        $size = array($info[0], $info[1]);

        if ($info['mime'] == 'image/png') {
            $src = imagecreatefrompng($path);
        } elseif ($info['mime'] == 'image/jpeg') {
            $src = imagecreatefromjpeg($path);
        } elseif ($info['mime'] == 'image/gif') {
            $src = imagecreatefromgif($path);
        } else {
            return false;
        }

        $testGD = get_extension_funcs("gd"); // Grab function list
        if (!$testGD) {
            echo "<br>GD not even installed.";
            exit;
        }
        //echo"<pre>".print_r($testGD,true)."</pre>";
        //echo get_loaded_extensions("gd");
        $thumb = imagecreatetruecolor($width, $height);
        $src_aspect = $size[0] / $size[1];
        //echo $src_aspect;
        $thumb_aspect = $width / $height;

        //$src = imagecreate(50, 50);
        //print_r($src);

        if ($src_aspect < $thumb_aspect) {
            //narrower

            //determine scale factor
            $scale = $width / $size[0]; //desired thumbnail width divided by actual width
            $new_size = array($width, $width / $src_aspect);
            $src_pos = array(0, ($size[1] * $scale - $height) / $scale / 2); //x and y axis

        } elseif ($src_aspect > $thumb_aspect) {
            //wider
            $scale = $height / $size[1];
            $new_size = array($height * $src_aspect, $height);
            $src_pos = array(($size[0] * $scale - $width) / $scale / 2, 0);

        } else {
            //same shape
            $new_size = array($width, $height);
            $src_pos = array(0, 0);
        }

        $new_size[0] = max($new_size[0], 1);
        $new_size[1] = max($new_size[1], 1);

        imagecopyresampled($thumb, $src, 0, 0, $src_pos[0], $src_pos[1], $new_size[0], $new_size[1], $size[0], $size[1]);

        return $thumb;

    }

    public static function exists($file)
    {
        return file_exists($file);
    }

    public static function size($file)
    {
        return filesize($file);
    }

    public static function name($file)
    {
        return pathinfo($file, PATHINFO_FILENAME);
    }

    public static function extension($file)
    {
        return strtolower(pathinfo($file, PATHINFO_EXTENSION));
    }

    public static function delete($file)
    {
        return unlink($file);
    }

    public static function lastUpdated($file)
    {
        return filemtime($file);
    }

    public static function get($file)
    {
        return static::exists($file)
            ? file_get_contents($file)
            : false;
    }

    public static function put($file, $data, $append = false)
    {
        if ($append) {
            return file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
        }
        return file_put_contents($file, $data, LOCK_EX);
    }

    public static function append($file, $data)
    {
        return static::put($file, $data, true);
    }

    public static function truncate($file)
    {
        if (static::exists($file)) {
            $fp = fopen($file, 'w');
            fclose($fp);
        }
    }

} 