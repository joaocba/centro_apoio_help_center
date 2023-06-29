<?php
class DB{
    protected $host='localhost';
    protected $user='blakw_capoio';
    protected $password='centroapoio';
    protected $database='blakw_centroapoio';

    public $conn;

    public function __construct()
    {
        $this->conn=new mysqli($this->host,$this->user,$this->password,$this->database);
        if($this->conn->errno){
            die('Database error');
        }
    }
}
?>