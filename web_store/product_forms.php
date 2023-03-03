<?php
ob_start();
session_start();
include "functions.php";
include_once 'style.css';

if ( isset($_GET['action']) && $_GET['action'] =='inserted'){
    echo "<div class=''main_container>";
    create_header( ['home','products','login','logout'] );
    echo "<div class='content' id='product_forms_content'>";
    echo "<p> New product succssesfully added</p>";
    echo "<a href='products.php'>GO TO PRODUCTS</a><br>";
    echo "<a href='product_forms.php'>BACK TO PRODUCT FORMS</a>";
    echo "</div>";
    echo "</div>";
    exit;
}
if ( isset($_GET['action']) && $_GET['action'] =='product_delitet'){
    echo "<div class=''main_container>";
    create_header( ['home','products','login','logout'] );
    echo "<div class='content' id='product_forms_content'>";
    echo "<p>Product succssesfully delitet</p>";
    echo "<a href='products.php'>GO TO PRODUCTS</a><br>";
    echo "<a href='product_forms.php'>BACK TO PRODUCT FORMS</a>";
    echo "</div>";
    echo "</div>";
    exit;
}
if ( isset($_GET['action']) && $_GET['action'] =='quantity_added'){
    echo "<div class=''main_container>";
    create_header( ['home','products','login','logout'] );
    echo "<div class='content' id='product_forms_content'>";
    echo "<p>Quantity added succssesfully</p>";
    echo "<a href='products.php'>GO TO PRODUCTS</a><br>";
    echo "<a href='product_forms.php'>BACK TO PRODUCT FORMS</a>";
    echo "</div>";
    echo "</div>";
    exit;
}
if ( isset($_GET['action']) && $_GET['action'] =='product_updated'){
    echo "<div class=''main_container>";
    create_header( ['home','products','login','logout'] );
    echo "<div class='content' id='product_forms_content'>";
    echo "<p>Product updated succssesfully</p>";
    echo "<a href='products.php'>GO TO PRODUCTS</a><br>";
    echo "<a href='product_forms.php'>BACK TO PRODUCT FORMS</a>";
    echo "</div>";
    echo "</div>";
    exit;
}
if ( isset($_POST['action']) && $_POST['action'] =='login_employee'){
    $employee_username = 'nikola@4.com';
    $employee_pasword = 'nikola';
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (  $email == $employee_username && $password == $employee_pasword ){
        $_SESSION['employee'] = $email;
        header ('Location:product_forms.php');
        ob_end_flush();
    }else{
        echo "<p style='text-decoration:underline red'>Wrong log in information try again</p>";
    }
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
<div class='main_container'>
    <?php
    create_header( ['home','products','login','logout'] );
    echo "<div class='content' id='product_forms_content'>";
    if ( !isset($_SESSION['employee'])){
        create_form('Enter your employee username and password','product_forms.php', 'POST', ['hidden','email','password','submit'], ['action','email','password','submit'], ['login_employee','','','submit'],['','enter username','enter password','']); 
    }else{
        ?>
        <div class='form_div new_product_form_div' id='new_preoduct_form_div'>
        <h3>Add new product</h3>
        <form id="new_product_form" action="insert_products.php" method='POST'>
            <input type="hidden" name="action" value="insert_product">
            <input type="text" name="barcode" placeholder="barcode" required><br>
            <input type="text" name="name" placeholder="name" required><br>
            <select name="category" class='select' >
                <option value="product_category">Product category</option>
                <option value="obuca">Obuca</option>
                <option value="odeca">Odeca</option>
                <option value="nakit">Nakit</option>
                <option value="kucni_aparati">Kucni aparati</option>
            </select><br>
            <textarea class='text_area' name="description" required>Enter description</textarea><br>
            <input type="text" name="picture" placeholder="enter picture link" required><br>
            <input type="text" name="price" placeholder="price" required><br>
            <input type="text" name="quantity" placeholder="quantity" required><br>
            <input type="submit" class="submit" name="submit" value="submit" required><br>
         
        </form>
        </div>
        <?php
            create_form('Update product','update_product.php', 'POST', ['hidden','text','submit'], ['action','barcode','submit'], ['update_product','','submit'], ['','enter barcode','']);

            create_form('Add product quantity','add_product_quantity.php', 'POST', ['hidden','text','text','submit'], ['action','barcode','quantity','submit'], ['add_quantity','','','submit'], ['','barcode','add quantity','']);

            create_form('Delite product','delite_product.php', 'POST', ['hidden','text','submit'], ['action','barcode','submit'], ['delite_product','','delete'], ['','enter barcode','']);
            create_form('Show products in stocks','products_stock.php', 'POST',['hidden','text','submit'], ['action','barcode','submit'], ['show_products_in_stock','','show'], ['','all or barcode','']);
    }
        ?>
   
    
    </div>
</div>
<?php
create_footer( ['home','products','login','logout','product_forms'] );
?>

</body>
</html>