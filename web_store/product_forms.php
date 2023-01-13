<?php
session_start();
include "functions.php";
if ( isset($_GET['action']) && $_GET['action'] =='inserted'){
    echo "<p> New product succssesfully added</p>";
}
if ( isset($_GET['action']) && $_GET['action'] =='product_delitet'){
    echo "<p>Product succssesfully deletet</p>";
}
if ( isset($_POST['action']) && $_POST['action'] =='login_employee'){
    $employee_username = 'nikola@4.com';
    $employee_pasword = 'nikola';
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (  $email == $employee_username && $password == $employee_pasword ){
        $_SESSION['employee'] = $email;
        header ('Location:product_forms.php');
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
    echo "<div class='content'>";
    if ( !isset($_SESSION['employee'])){
        create_form('Enter your employee username and password','product_forms.php', 'POST', ['hidden','email','password','submit'], ['action','email','password','submit'], ['login_employee','','','submit'],['','enter username','enter password','']); 
    }else{
        ?>
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

            create_form('Delite product','delite_product.php', 'POST', ['hidden','text','submit'], ['action','barcode','submit'], ['delite_product','','delete'], ['','enter barcode','']);
    }
        ?>
   
    
    </div>
</div>
<?php
create_footer( ['home','products','login','logout','product_forms'] );
?>

</body>
</html>