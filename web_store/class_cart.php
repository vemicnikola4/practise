<?php
if (!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

class Cart{

    public $cart_items;

    function __construct(){
        $this -> cart_items = $_SESSION['cart'];
    }

    function add_item($barcode,$name,$price,$quantity){
        $found  = false;
        for ( $i = 0; $i < count ($this->cart_items); $i++){
            if ($this->cart_items[$i]['barcode'] == $barcode){
                $this->change_quantity($barcode);
                $found =true;
                break;
            }
        }
        if ( $found == false ){
            $new_item = ['barcode'=>$barcode , 'name'=>$name ,  'price'=>$price , 'quantity'=>$quantity ];
            array_push($this -> cart_items, $new_item );
        }
        $_SESSION['cart'] = $this -> cart_items;
    }
    function show_cart(){
        echo "<div class='form_div'>";
        echo "<table border=solid >";
        echo "<th>BARCODE</th><th>NAME</th><th>PRICE</th><th>QUANTITY</th><th>TOTAL PRICE</th>";
        $cart_total=0;
        for ( $i = 0; $i < count ($this->cart_items); $i++){    
            $barcode = $this->cart_items[$i]['barcode'];
            $item_total = $this->cart_items[$i]['price'] * $this->cart_items[$i]['quantity'];
        echo "<tr>";
        echo "<td>".$this->cart_items[$i]['barcode']."</td>";
        echo "<td>".$this->cart_items[$i]['name']."</td>";
        echo "<td>".$this->cart_items[$i]['price']." e</td>";
        echo "<td>".$this->cart_items[$i]['quantity']."</td>";
        echo "<td>".$item_total." e</td>";
        echo "<td><a  href='add_to_cart.php?action=add_quantity&barcode=$barcode'><button style='width:100px'>+</button></a></td>";
        echo "<td><a  href='add_to_cart.php?action=reduce_quantity&barcode=$barcode'><button style='width:100px'>-</button></a></td>";
        echo "<td><a href='add_to_cart.php?action=delite_item&barcode=$barcode'>DELETE</a></td>";
        echo "</tr>";
        $cart_total += $item_total;
        }
        echo "<br>";
        echo "<tr style='border:none'><td style='border:none'>TOTAL</td><td style='border:none'></td><td style='border:none'></td><td style='border:none'></td><td style='border:none'>".$cart_total." e</td></tr>";
        echo "</table>";
        echo "<div>";
        echo "<a href='add_to_cart.php?action=delete_cart'>DELETE CART</a>";
        echo "</div>";
        echo "<div>";
        echo "<a href='cart.php?action=submit'>SUBMIT</a>";
        echo "</div>";
        echo "</div >";
        $_SESSION['cart']=$this -> cart_items;

    }
    function change_quantity($barcode){
        for ( $i = 0; $i < count ($this->cart_items); $i++){
            if ($barcode ==   $this->cart_items[$i]['barcode']){
               $this->cart_items[$i]['quantity']+=1;
            }

        }
        $_SESSION['cart'] = $this->cart_items;
    }
    function reduce_quantity($barcode){
        for ( $i = 0; $i < count ($this->cart_items); $i++){
            if ($barcode ==   $this->cart_items[$i]['barcode']){
               $this->cart_items[$i]['quantity']-=1;
               if ( $this-> cart_items[$i]['quantity'] <= 0 ){
                $this->delite_item($barcode);
                break;
               }
            }

        }
        $_SESSION['cart'] = $this->cart_items;
    }
    function delite_item($barcode){
        for($i=0; $i<count($this->cart_items); $i++){
            if($this->cart_items[$i]['barcode'] == $barcode){
                array_splice($this->cart_items, $i, 1);
                return;
            }
        }
        $_SESSION['cart'] = $this->cart_items;
    }
    function total_item(){
        for($i=0; $i<count($this->cart_items); $i++){
            $this->cart_items[$i]['item_total']= $this->cart_items[$i]['price'] * $this->cart_items[$i]['quantity']; 
        }
        $_SESSION['cart'] = $this->cart_items;
    }
    function delete_cart(){
        for($i=0; $i<count($this->cart_items); $i++){
            array_splice($this->cart_items, $i, );     
        }
        $_SESSION['cart'] = $this->cart_items;
    }
    function cart_items(){
        $cart_items = $this -> cart_items;
    }

}
$cart = new Cart();
?>