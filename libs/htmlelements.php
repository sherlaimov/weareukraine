<?php
function html_input($name, $value, $param = array() ) {

    $html = ''; // implode(' ', $param);

    if ($name === 'title') {
        $param = array(
            'class' => 'form-control',
            'type' => 'text',
            'id' => 'title',
            'placeholder' => 'Title');
    } else {
        $param = array(
            'class' => 'form-control'
        );
    }

    $attr = '';
    foreach($param as $k => $v) {
        $attr .= $k.'="'.$v.'" ';
    }

    $html = '<input name="' . $name . '" value="' . $value . '" '.$attr.'>';
    //echo $html;
    return $html;
}

function html_textarea($name, $data, $param){
//если кастомные задать в функции?

    //$param['class'] = ('form-control');
    $param = array('class' => "form-control ". "$param");
    //print_r($param);
    $attr = '';
    foreach($param as $k => $v) {
        $attr .= $k .'="'. $v .'" ';
    }

    $html = '<textarea name ="' . $name .'" ' .  $attr . '>' . "$data" . '</textarea>';
    return $html;

}