<?php

namespace Tg\DemoStreamBundle\Helper;

class FlushHelper {

    static $BUFFER_SIZE_APACHE = 65536;

    protected $bufferSize;

    function __construct($bufferSize = null) {
        $this->bufferSize = $bufferSize ? $bufferSize : max(static::$BUFFER_SIZE_APACHE, 0);
    }

    function out($output) {

        if(!is_scalar($output))
            throw new InvalidArgumentException();

        echo $output;
        echo str_repeat(' ', min($this->bufferSize,  $this->bufferSize - strlen($output)));
        ob_flush();
        flush();
    }

    function outPlaceholder($output, $id) {
        $out = '<script type="text/javascript">';
        $out .= 'document.getElementById("'.$id.'").innerHTML = "'.htmlentities($output, ENT_QUOTES, 'UTF-8').'" ';
        $out .= '</script>';
        return $this->out($out);
    }
}