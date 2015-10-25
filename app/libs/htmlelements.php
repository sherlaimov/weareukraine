<?php
//print_r($_REQUEST);die;
function html_input($name, $value, $param = array() ) {

    if ( empty ($param)) {
        $param = array(
            'class' => 'form-control'
        );
    }

    $attr = '';

    if ( ! isset($param['id'])) {
        $param['id'] = $name;
    }

    foreach($param as $k => $v) {
        $attr .= $k.'="'.$v.'" ';
    }

    if (isset($_REQUEST[$name])) {
        $value = $_REQUEST[$name];
    }


    $html = '<input name="' . $name . '" value="' . $value . '" '.$attr.'>';
    //echo $html;
    return $html;
}

function html_element($name, $value, $type, $param) {



}

function html_input_title($name, $value){
    return html_input($name, $value, $param = array('class' => 'form-control',
                                             'type' => 'text',
                                             'id' => 'title',
                                             'placeholder' => 'Title') );
}

function html_textarea($name, $data, $param = array() ){
//если кастомные задать в функции?

    if ( ! is_array($param)) {
       return false;
    }

    //$param['class'] = ('form-control');
    if ( is_array($param) && !$param ) {
        $param = array('class' => "form-control");
    }
    //print_r($param);
    $attr = '';
    foreach($param as $k => $v) {
        $attr .= $k .'="'. $v .'" ';
    }

    if (isset($_REQUEST[$name])) {
        $data = $_REQUEST[$name];
    }

    $html = '<textarea name ="' . $name .'" ' .  $attr . '>' . $data . '</textarea>';

    return $html;

}

function image_thumb($name) {
    return '<img src="' . WS_IMAGES . 'thumb/' . $name .'">';
}

function profileImageThumb($name) {
    return '<img src="' . WS_IMAGES . 'thumb/' . $name .'" class="img-circle img-responsive">';
}

function html_get_thumbnail($filename, $width, $height, $style = '') {
    $fileInfo = pathinfo($filename);

    return '<img src="'.WS_IMAGES .'thumb/'. $fileInfo['filename'] .'_'.$width.'_'.$height.'.jpg'.'" class="news-image">';
}