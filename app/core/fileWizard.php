<?php

class fileWizard
{
    protected $destination;
    protected $messages = array();
    protected $maxSize = 512000;
    protected $permittedTypes = array(
        'image/jpeg',
        'image/pjpeg',
        'image/gif',
        'image/png',
        'image/webp'
    );
    protected $fileName;
    protected $newName;
    protected $thumbName;
    protected $typeCheckingOn = true;
    protected $notTrusted = array('bin', 'cgi', 'exe', 'js', 'pl', 'php', 'py', 'sh');
    protected $suffix = '.upload';
    protected $renameDuplicates;

    public function __construct($uploadFolder)
    {
        if (!is_dir($uploadFolder) || !is_writable($uploadFolder)) {
            throw new Exception("$uploadFolder must be a valid, writable folder.");
        }
        if ($uploadFolder[strlen($uploadFolder)-1] != '/') {
            $uploadFolder .= '/';
        }
        $this->destination = $uploadFolder;
    }


    public function upload($renameDuplicates = true)
    {
        $this->renameDuplicates = $renameDuplicates;
        $uploaded = current($_FILES);
        if (is_array($uploaded['name'])) {
            foreach ($uploaded['name'] as $key => $value) {
                $currentFile['name'] = $uploaded['name'][$key];
                $currentFile['type'] = $uploaded['type'][$key];
                $currentFile['tmp_name'] = $uploaded['tmp_name'][$key];
                $currentFile['error'] = $uploaded['error'][$key];
                $currentFile['size'] = $uploaded['size'][$key];
                if ($this->checkFile($currentFile)) {
//                    $this->setNewName($currentFile); not gonna work!
                    $this->moveFile($currentFile);
                }
            }
        } else {
            if ($this->checkFile($uploaded)) {
                $this->setNewName($uploaded);
                $this->moveFile($uploaded);
            }
        }
    }

    public function getMessages()
    {
        return $this->messages;
    }

    protected function checkFile($file)
    {
        if ($file['error'] != 0) {
            $this->getErrorMessage($file);
            return false;
        }
        if (!$this->checkSize($file)) {
            return false;
        }
        if ($this->typeCheckingOn) {
            if (!$this->checkType($file)) {
                return false;
            }
        }
        $this->checkName($file);
        return true;
    }
    protected function checkSize($file)
    {
        if ($file['size'] == 0) {
            $this->messages[] = $file['name'] . ' is empty.';
            return false;
        } elseif ($file['size'] > $this->maxSize) {
            $this->messages[] = $file['name'] . ' exceeds the maximum size for a file ('
                . self::convertFromBytes($this->maxSize) . ').';
            return false;
        } else {
            return true;
        }
    }

    protected function checkType($file)
    {
        if (in_array($file['type'], $this->permittedTypes)) {
            return true;
        } else {
            $this->messages[] = $file['name'] . ' is not permitted type of file.';
            return false;
        }
    }

    protected function checkName($file)
    {
        $this->fileName = $file['name'];
        $this->newName = null;
        $nospaces = str_replace(' ', '_', $file['name']);
        if ($nospaces != $file['name']) {
            $this->newName = $nospaces;
        }
        $nameparts = pathinfo($nospaces);
        $extension = isset($nameparts['extension']) ? $nameparts['extension'] : '';
        if ( ! $this->typeCheckingOn && ! empty($this->suffix)) {
            if (in_array($extension, $this->notTrusted) || empty($extension)) {
                $this->newName = $nospaces . $this->suffix;
            }
        }
        if ($this->renameDuplicates) {
            $name = isset($this->newName) ? $this->newName : $file['name'];
            $existing = scandir($this->destination);
            if (in_array($name, $existing)) {
                $i = 1;
                do {
                    $this->newName = $nameparts['filename'] . '_' . $i++;
                    if (!empty($extension)) {
                        $this->newName .= ".$extension";
                    }
                    if (in_array($extension, $this->notTrusted)) {
                        $this->newName .= $this->suffix;
                    }
                } while (in_array($this->newName, $existing));
            }
        }
    }


    protected function setNewName($file)
    {

        $this->newName = md5($file['name'] . rand(0, 10000)) . '.' . self::extension($file['name']);
    }

    public function getImageInfo()
    {

        $data = array(
            'image_name' => $this->newName,
            'thumb'     => $this->thumbName,
            'file_name'     => $this->fileName
        );
        return $data;

    }

    protected function getErrorMessage($file)
    {
        switch($file['error']) {
            case 1:
            case 2:
                $this->messages[] = $file['name'] . ' is too big: (max: ' .
                    self::convertFromBytes($this->maxSize) . ').';
                break;
            case 3:
                $this->messages[] = $file['name'] . ' was only partially uploaded.';
                break;
            case 4:
                $this->messages[] = 'No file submitted.';
                break;
            default:
                $this->messages[] = 'Sorry, there was a problem uploading ' . $file['name'];
                break;
        }
    }



    protected function moveFile($file)
    {
        $filename = isset($this->newName) ? $this->newName : $file['name'];
        $success = move_uploaded_file($file['tmp_name'], $this->destination . $filename);
        if ($success) {
            $this->createThumb();
            $result = $file['name'] . ' was uploaded successfully';
            if (!is_null($this->newName)) {
                $result .= ', and was renamed ' . $this->newName;
            }
            $result .= '.';
            $this->messages[] = $result;
        } else {
            $this->messages[] = 'Could not upload ' . $file['name'];
        }
    }

    protected function createThumb()
    {
        if (isset($_POST['width'])) {
            $height = $width = $_POST['width'];
        } else { $height = $width = 150; }

            $filePath = $this->destination . $this->newName;
            $noExtention = self::name($this->newName);
            $this->thumbName = $noExtention . '_' . $width . '_' . $height . '.jpg';
            $bitmap = $this->createThumbBitmap($filePath, false, $width, $height);
            return imagejpeg($bitmap, FS_IMAGES . 'thumb' . DS . $this->thumbName);

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

        if($info['mime'] == 'image/png'){
            $src = imagecreatefrompng($path);
        } elseif($info['mime'] == 'image/jpeg'){
            $src = imagecreatefromjpeg($path);
        } elseif($info['mime'] == 'image/gif'){
            $src = imagecreatefromgif($path);
        } else {
            return false;
        }

        $testGD = get_extension_funcs("gd"); // Grab function list
        if (!$testGD){ echo "<br>GD not even installed."; exit; }
        //echo"<pre>".print_r($testGD,true)."</pre>";
        //echo get_loaded_extensions("gd");
        $thumb = imagecreatetruecolor($width, $height);
        $src_aspect = $size[0] / $size[1];
        //echo $src_aspect;
        $thumb_aspect = $width / $height;

        //$src = imagecreate(50, 50);
        //print_r($src);

        if($src_aspect < $thumb_aspect)
        {
            //narrower

            //determine scale factor
            $scale = $width / $size[0]; //desired thumbnail width divided by actual width
            $new_size = array($width, $width / $src_aspect);
            $src_pos = array(0, ($size[1] * $scale - $height) / $scale / 2); //x and y axis

        } elseif ($src_aspect > $thumb_aspect)
        {
            //wider
            $scale = $height / $size[1];
            $new_size = array($height * $src_aspect, $height);
            $src_pos = array(($size[0] * $scale - $width) / $scale / 2, 0);

        } else
        {
            //same shape
            $new_size = array($width, $height);
            $src_pos = array(0, 0);
        }

        $new_size[0] = max($new_size[0], 1);
        $new_size[1] = max($new_size[1], 1);

        imagecopyresampled($thumb,$src, 0, 0, $src_pos[0], $src_pos[1], $new_size[0], $new_size[1], $size[0], $size[1]);

        return $thumb;

    }

    public function setMaxSize($bytes)
    {
        $serverMax = self::convertToBytes(ini_get('upload_max_filesize'));
        if ($bytes > $serverMax) {
            throw new Exception('Maximum size cannot exceed server limit for individual files: ' .
                self::convertFromBytes($serverMax));
        }
        if (is_numeric($bytes) && $bytes > 0) {
            $this->maxSize = $bytes;
        }
    }

    public static function convertToBytes($val)
    {
        $val = trim($val);
        $last = strtolower($val[strlen($val)-1]);
        if (in_array($last, array('g', 'm', 'k'))){
            switch ($last) {
                case 'g':
                    $val *= 1024;
                case 'm':
                    $val *= 1024;
                case 'k':
                    $val *= 1024;
            }
        }
        return $val;
    }

    public static function convertFromBytes($bytes)
    {
        $bytes /= 1024;
        if ($bytes > 1024) {
            return number_format($bytes/1024, 1) . ' MB';
        } else {
            return number_format($bytes, 1) . ' KB';
        }
    }

    public function allowAllTypes($suffix = null)
    {
        $this->typeCheckingOn = false;
        if (!is_null($suffix)) {
            if (strpos($suffix, '.') === 0 || $suffix == '') {
                $this->suffix = $suffix;
            } else {
                $this->suffix = ".$suffix";
            }
        }
    }


    public static function extension($file)
    {
        return pathinfo($file, PATHINFO_EXTENSION);
    }

    public static function name($file)
    {
        return pathinfo($file, PATHINFO_FILENAME);
    }

}