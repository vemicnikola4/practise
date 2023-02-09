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
    function all_products(){
        $all_products = $this -> select(" SELECT * FROM products ");
        if( $all_products["sucssesful"] == true ){
            return $all_products['array'];
        }else{
            die('Neuspesan upit' . $all_products['message']);
        }
    }
    function price_filter_all_products($p_1,$p_2){
        $all_products = $this -> select(" SELECT * FROM products WHERE price >=$p_1 AND price <= $p_2 ");
        if( $all_products["sucssesful"] == true ){
            return $all_products['array'];
        }else{
            die('Neuspesan upit' . $all_products['message']);
        }
    }
    function category_filter_all_products($category){
        $all_products = $this -> select(" SELECT * FROM products WHERE category='$category' ");
        if( $all_products["sucssesful"] == true ){
            return $all_products['array'];
        }else{
            die('Neuspesan upit' . $all_products['message']);
        }
    }
    function one_product($barcode){
        $all_products = $this -> select(" SELECT * FROM products WHERE barcode='$barcode' ");
        if( $all_products["sucssesful"] == true ){
            return $all_products['array'];
        }else{
            die('Neuspesan upit' . $all_products['message']);
        }
    }
    function insert_product( $barcode, $name, $category, $description, $picture, $price, $quantity ){
        $barcode = $this -> conn -> real_escape_string ($barcode );
        $name = $this -> conn -> real_escape_string ($name );
        $category = $this -> conn -> real_escape_string ($category );
        $description = $this -> conn -> real_escape_string ($description );
        $picture = $this -> conn -> real_escape_string ($picture );
        $price = $this -> conn -> real_escape_string ($price );
        $quantity = $this -> conn -> real_escape_string ($quantity );
        $insert = $this -> comand ( "INSERT INTO `products`(`barcode`, `name`, `category`, `description`, `picture`, `price`, `quantity`) VALUES ('$barcode', '$name', '$category', '$description', '$picture', $price, $quantity)" );
    }
    function delite_product($barcode){
        $delite = $this -> comand ( " DELETE FROM products WHERE barcode=$barcode ");
    }
    function update_product( $barcode, $new_barcode, $new_name, $new_category, $new_description, $new_picture, $new_price, $new_quantity ){
        $update_product = $this -> comand ( "UPDATE `products` SET `barcode`='$new_barcode',`name`='$new_name',`category`='$new_category',`description`='$new_description',`picture`='$new_picture',`price`=$new_price,`quantity`=$new_quantity WHERE barcode=$barcode" );
    }
    function add_quantity($barcode,$add_quantity){
        $product = $this -> select( "SELECT * FROM products WHERE barcode=$barcode ");
        $product_quantity = $product['array'][0]['quantity'];
        $new_quantity = $product_quantity + $add_quantity;
        $update_quantity = $this -> comand ( "UPDATE `products` SET `quantity`=$new_quantity WHERE barcode=$barcode");
    }
    function reduce_quantity($barcode,$reduce_quantiti){
        $product = $this -> select( "SELECT * FROM products WHERE barcode=$barcode ");
        $product_quantity = $product['array'][0]['quantity'];
        $new_quantity = $product_quantity - $reduce_quantiti;
        if ( $new_quantity < 0){
            $new_quantity = 0;
        }
        $update_quantity = $this -> comand ( "UPDATE `products` SET `quantity`=$new_quantity WHERE barcode=$barcode");
    }
    function insert_into_cart($order_id, $barcode, $quantity, $total, $date){
        $this -> comand ( "INSERT INTO `cart`(`order_id`, `barcode`, `quantity`, `total`, `date`) VALUES ('$order_id', '$barcode', $quantity, $total, '$date')" );
    }
    function cart($order_id){
        $all_users = $this -> select(" SELECT * FROM cart WHERE order_id = '$order_id' ");
        if( $all_users["sucssesful"] == true ){
            return $all_users['array'];
        }else{
            die('Neuspesan upit' . $all_users['message']);
        }
    }
    function show_cart($order_id){
        $cart = $this->cart($order_id);
        echo "<div class='form_div'>";
        echo "<table border=solid >";
        echo "<th>BARCODE</th><th>QUANTITY</th><th>TOTAL</th>";
        $cart_total=0;
        $total_items=0;
        for ( $i = 0; $i < count ($cart); $i++){
            $cart_total+=$cart[$i]['total'];
            $total_items+=$cart[$i]['quantity'];
            echo "<tr>";
            echo "<td><a href='show_one_product.php?action=show_product&barcode=".$cart[$i]['barcode']."'>".$cart[$i]['barcode']."</a></td>";
            echo "<td>".$cart[$i]['quantity']."</td>";
            echo "<td>".$cart[$i]['total']." e</td>";
            echo "</tr>";
        }
        echo "<th>TIME OF PURCHASE</th><TH>NUMBER OF ITEMS</TH><th>CART TOTAL</th>";
           echo "</tr>";
           echo "<td>".$cart[0]['date']."</td>";
           echo "<td>".$total_items."</td>";
           echo "<td>".$cart_total."</td>";
           echo "<tr>";
        echo "</table>";
        echo "</div>";
    }
    function select_price(){
        $all_products = $this -> select(" SELECT barcode,price FROM products ");
        if( $all_products["sucssesful"] == true ){
            return $all_products['array'];
        }else{
            die('Neuspesan upit' . $all_products['message']);
        }
    }
}
$base= new Database('zadatak_web_store');

?>