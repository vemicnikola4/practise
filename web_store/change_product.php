<?php
session_start();
include "class_database.php";
include "functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class='main_container'>
    <?php
     echo "<div class='content'>";
     create_header( ['home','products','cart','login','logout'] );
$barcode = $_GET['barcode'];
$product =  $base->one_product($barcode);
if ( isset($_GET['action']) && $_GET['action']=='delite'){
    $barcode = $_GET['barcode'];
    echo "<a href='change_product.php?action=delite_confirmation&barcode=$barcode'>Are you sure you would like to delite product ".$barcode."</a><br>";
    echo "<a href='products_stock.php?action=show_products_in_stock&barcode=all'>Cancel, back to products stocks</a>";

    echo "</div>";
    create_footer( ['home','products','cart','login','logout','product_forms'] );
    echo "</div>";
    exit;
}
if ( isset($_GET['action']) && $_GET['action']=='delite_confirmation'){
    $barcode = $_GET['barcode'];
    $base->delite_product($barcode);
    header ('Location:products_stock.php?action=product_delitet&barcode=$barcode');

}
show_one_product_in_stocks($product);
?>
<div class='form_div' id='new_preoduct_form_div'>
<h3>Update product</h3>
<form id="new_product_form" action="insert_products.php" method='POST'>
    <?php echo "<input type='hidden' name='old_barcode' value='$barcode'>" ?>
    <input type="hidden" name="action" value="updateing_product">
    <input type="text" name="barcode" value= "<?php echo $barcode ?>" placeholder="barcode" required><br>
    <input type="text" name="name" placeholder="name" required><br>
    <select name="category" >
        <option value="obuca">Obuca</option>
        <option value="odeca">Odeca</option>
        <option value="nakit">Nakit</option>
        <option value="kucni_aparati">Kucni aparati</option>
    </select><br>
    <textarea style='font-family:roboto; color:grey' name="description" required>Enter description</textarea><br>
    <input type="hidden" name="picture" value="<?php echo $product[0]['picture']  ?>" required><br>
    <input type="text" name="price" placeholder="price" required><br>
    <input type="text" name="quantity" placeholder="quantity" required><br>
    <input type="submit" name="submit" value="submit" required><br> 
</form>
</div>
<?php
echo "</div>";
create_footer( ['home','products','cart','login','logout','product_forms'] );
echo "</div>";
    ?>
</body>
</html>