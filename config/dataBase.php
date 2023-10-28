<?php
class DataBase {
    public static function connect($host='localhost',$user='root',$pwd='',$db='bd_restaurante') {
        $conexion = new mysqli($host,$user,$pwd,$db);
        if($conexion == false){
            die('DATABASE ERROR');
        } 
            return $conexion;
    }
}
?>