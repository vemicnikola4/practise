<?php
class Database{
    public $conn;

    function __construct($database){
        $this-> conn = new mysqli('localhost','root','',$database);
            if ($this->conn->connect_error){
                echo "JDK connection error " . $this->conn->connect_error;
            }else{
                echo "<p style='display:none'>Connected</p>";
            }
    }
    function select($select){
        $data = $this-> conn -> query($select);
        if ( $data == false){
            return ['sucssesful'=>false,'message'=> $this->conn->error];
        }else{
            $array= $data->fetch_all(MYSQLI_ASSOC);
            return['sucssesful'=>true,'array'=>$array];
        }
    }
    function comand($comand){
        $execute = $this->conn->query($comand);
        if  ($execute == false){
            die("JDK " .$this->conn->error);
        }else{
           return "Sucssesfuly executed !";
        }
    }
    function all_users(){
        $all_users = $this -> select(" SELECT * FROM users ");
        if( $all_users["sucssesful"] == true ){
            return $all_users['array'];
        }else{
            die('Neuspesan upit' . $all_users['message']);
        }
    }
    function insert_user( $email, $name, $last_name, $phone_number, $password ){
        $email = $this -> conn -> real_escape_string ($email );
        $name = $this -> conn -> real_escape_string ($name );
        $last_name = $this -> conn -> real_escape_string ($last_name );
        $phone_number = $this -> conn -> real_escape_string ($phone_number );
        $password = $this -> conn -> real_escape_string ($password );
        $insert = $this -> comand ( "INSERT INTO `users`(`email`, `name`, `last_name`, `phone_number`, `password`) VALUES ('$email', '$name',' $last_name', '$phone_number', '$password' )");  
    }
}
$base= new Database('zadatak_web_store');
?>