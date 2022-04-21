<?php
class DB{
    private $host;
    private $db;
    private $user;
    private $password;
    private $chartset;
    public function __construct()
    {
        $this->host = "localhost";
        $this->db = "api";
        $this->user= "root";
        $this->password = "";
        $this->chartset = "utf8mb4";  
    }
    protected function connect(){
        try{
            $connection = "mysql:hots=".$this->host.";dbname=".$this->db.";chartset=".$this->chartset;
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false];
            $pdo = new PDO($connection,$this->user,$this->password,$options);
            return $pdo;
        }catch(PDOException $e){
            print_r("Error connection". $e->getMessage());
        }
    }
}
?>