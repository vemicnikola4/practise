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
        function insert_user($name_lastname, $email, $password){
            $name_lastname = $this -> conn-> real_escape_string($name_lastname);
            $email = $this -> conn-> real_escape_string($email);
            $password = $this -> conn-> real_escape_string($password);
            $insert = $this->comand("INSERT INTO `users`(`name_lastname`, `email`, `password`) VALUES ('$name_lastname', '$email', '$password')");
        }
    }

$base = new Database('zadatak_email_verification_login');
?>