<?php
     class Conn {
          public $host = "localhost";
          public $user = "root";
          public $pass = "";
          public $dbname = "livranea_db";
          public $port = 3306;
          public $connect = null;

          public function conectar(): bool|PDO{
               try {
                    //Conexão com porta
                    //$this->connect = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";bdname=" . $this->bdname, $this->user, $this->pass);
                    //Conexão sem porta
                    $this->connect = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->pass);
                    
                    //echo "Conexão realizada com sucesso!";
                    return $this->connect;
               } catch (Exception $err) {
                    echo "Erro: Conexão não realizada com Sucesso! Erro gerado: " . $err;
                    return false;
               }
          }
     }