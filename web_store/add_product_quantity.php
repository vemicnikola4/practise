<?php
include "class_database.php";
include "functions.php";
echo "<div class='main_container'>";
create_header( ['home','products','login','logout'] );
echo "<div class='content'>";
if ( isset($_POST['action']) && $_POST['action'] =='add_quantity' ){
    $quantity = $_POST['quantity'];
    $barcode = $_POST['barcode'];
    $all_products = $base -> all_products();

    $has = false;
    for ( $i = 0;  $i <count ( $all_products ); $i++){
        if ( $barcode == $all_products[$i]['barcode']){
            $has = true;
        } 
    }
    if ( $has == false ){
        echo "<a href='product_forms.php'>Back to form</a><br>";
        echo "<p>Barcode invalid. No sach product available.</p>";
        echo "</div>";
        echo "</div>";
        create_footer( ['home','products','login','logout','product_forms'] );
        exit;
    }
?>
    <div class='table_div' style='border:solid black; width:250px'>
    <table>
    <ul>
        <sapn>Confirmation</sapn>
        <li>Barcode: <?php echo $barcode?></li>
        <li>Quantity adding: <?php echo $quantity?></li>
        <?php echo  "<a href='add_product_quantity.php?action=quantity_adding_confirmation&barcode=$barcode&quantity=$quantity'>Add quantity</a><br>";
        echo "<a href='product_forms.php'>Cancel back to form</a>";
        ?>
       
    </ul>
    </table>
    </div>
    <?php

}
if ( isset($_GET['action']) && $_GET['action'] == 'quantity_adding_confirmation'){
    $barcode = $_GET['barcode'];
    $quantity = $_GET['quantity'];
    if ($base -> add_quantity($barcode,$quantity)){
        echo "<P>Failed</p>";
        echo "<a href='product_forms.php'>Back to form</a>";
    }else{
        header ('Location:product_forms.php?action=quantity_added');
    }
}
echo "</div>";
echo "</div>";
create_footer( ['home','products','login','logout','product_forms'] );
?>