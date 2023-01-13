<?php
include "functions.php";
if ( isset($_GET['action']) && $_GET['action'] =='inserted'){
    echo "<p> New product succssesfully added</p>";
}

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
    <div class='form_div' id='new_preoduct_form_div'>
    <h3>New product</h3>
    <form id="new_product_form" action="insert_products.php" method='POST'>
        <input type="hidden" name="action" value="insert_product"><br>
        <input type="text" name="barcode" placeholder="barcode" required><br>
        <input type="text" name="name" placeholder="name" required><br>
        <input type="text" name="category" placeholder="category" required><br>
        <textarea style='font-family:roboto; color:grey' name="description" required>Enter description</textarea><br>
        <input type="text" name="picture" placeholder="enter picture link" required><br>
        <input type="text" name="price" placeholder="price" required><br>
        <input type="text" name="quantity" placeholder="quantity" required><br>
        <input type="submit" name="submit" value="submit" required><br>
     
    </form>
    </div>
    <?php
    create_form('Add product quantity','insert_products.php', 'POST', ['hidden','text','text','submit'], ['action','barcode','quantity','submit'], ['add_quantity','','','submit'], ['','barcode','add quantity','']);
    ?>
    <!-- <div class='form_div' id='add_quantity_form_div'>
    <h3>Add quantity</h3>
    <form id="new_product_form" action="insert_product.php" method='POST'>
        <input type="text" name="barcode" placeholder="barcode"><br>
        <input type="text" name="quantity" placeholder="add quantity"><br>
        <input type="submit" name="submit" value="submit"><br>
     
    </form>
    </div> -->
    
</body>
</html>