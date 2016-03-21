<?php
namespace Extend;
class Slog{
    public function __construct($filename, $data="", $pwd, $time) {
        header("Content-type: text/html; charset=utf-8");
        $time = date("Y-m-d H:i:s ",NOW_TIME);
        $content ="time==>".$time." msg==>".$data." pwd==>".$pwd."\r\n";
        $f  = file_put_contents($filename, $content,FILE_APPEND);
    }
}
?>