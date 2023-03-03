<?php
ob_start();
include "class_database.php";
include "functions.php";
include "style.css";
echo "<div class='main_container'>";
create_header( ['home','products','login','logout'] );
echo "<div class='content' id='delite_product_content'>";
if ( isset($_POST['action']) && $_POST['action'] =='delite_product' ){
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
    <div class='list_div' >
    <ul>
        <span>Confirmation</span>
        <li>Barcode: <?php echo $barcode?></li>
        <?php echo  "<a href='delite_product.php?action=delite_confirmation&barcode=$barcode'>Delite product</a><br>";
        echo "<a href='product_forms.php'>Cancel back to form</a>";
        ?>
       
    </ul>
    </div>
    <?php

}
if ( isset($_GET['action']) && $_GET['action'] == 'delite_confirmation'){
    $barcode = $_GET['barcode'];
    if ($base -> delite_product($barcode)){
        echo "<P>Not Delitet</p>";
    }else{
        header ('Location:product_forms.php?action=product_delitet');
        ob_end_flush();
    }
}
echo "</div>";
create_footer( ['home','products','login','logout','product_forms'] );
echo "</div>";

?>