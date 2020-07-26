<?php
class Conexion{

    private static $dns="mysql:host=localhost; dbname=dbpruebas";
    private static $nombre="root";
    private static $contra="";
    public $conex;
    private static $instacia;
    public function __construct()
    {
       $this->conex=new PDO(self::$dns,self::$nombre,self::$contra);
    }
    static function getinstancia(){
        if(!isset(self::$instacia)){
        $clase=__CLASS__;
        self::$instacia= new $clase();
        }
        return self::$instacia; 
    }
}
