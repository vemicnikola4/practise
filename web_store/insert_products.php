<?php
include "class_database.php";
if ( isset($_POST['action']) && $_POST['action'] =='insert_product' ){
    $barcode = $_POST['barcode'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $picture = $_POST['picture'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $all_products = $base -> all_products();

    for ( $i = 0;  $i <count ( $all_products ); $i++){
        if ( $barcode == $all_products[$i]['barcode'] ){
            echo "<a href='product_forms.php'>Back to form</a><br>";
            die ('Barcode invalid');
        }

    }

?>
    <div class='table_div' style='border:solid black; width:250px'>
    <table>
    <ul>
        <sapn>Confirmation</sapn>
        <li>Barcode: <?php echo $barcode?></li>
        <li>Name: <?php echo $name?></li>
        <li>Category: <?php echo $category?></li>
        <li>Description: <?php echo $description?></li>
        <li>Picture: <?php echo $picture?></li>
        <li>Price: <?php echo $price?> e</li>
        <li>Quantity: <?php echo $quantity?></li>
        <?php echo  "<a href='insert_products.php?action=confirm_new_product&barcode=$barcode&name=$name&category=$category&description=$description&picture=$picture&price=$price&quantity=$quantity'>Confirm new product</a><br>";
        echo "<a href='product_forms.php'>Cancel back to form</a>";
        ?>
       
    </ul>
    </table>
    </div>
    <?php

}
if ( isset($_GET['action']) && $_GET['action'] =='confirm_new_product'){
    $barcode = $_GET['barcode'];
    $name = $_GET['name'];
    $category = $_GET['category'];
    $description = $_GET['description'];
    $picture = $_GET['picture'];
    $price = $_GET['price'];
    $quantity = $_GET['quantity'];

    if ($base -> insert_product( $barcode, $name, $category, $description, $picture, $price, $quantity )){
        echo "<P>Not Inserted</p>";
    }else{
        header ('Location:product_forms.php?action=inserted');

    }

}
?>