<?php

  class conexion{

    private $host= 'localhost';
    private $nombreDB='notes';
    private $usuarioDB="root";
    private $passDB="";
    private $conexion;

    public function __construct()
    {
      try {
        $this->conexion= new PDO("mysql:host=$this->host;dbname=$this->nombreDB",$this->usuarioDB,$this->passDB);
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $err) {

        return "falla de coneccion".$err;
        
      }
    }

    public function ejecutar($sql){
      $this->conexion->exec($sql);
      return $this->conexion->lastInsertId();

    }

    public function consultar($sql){
      //prepara el select
      $miConsulta=$this->conexion->prepare($sql);
      //ejecuta la consulta 
      $miConsulta->execute();

      //retornamos toda la consulta
      return $miConsulta->fetchAll();
    }
  
 
  }

 ?>