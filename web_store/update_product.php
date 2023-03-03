<?php
include "class_database.php";
include "functions.php";
include 'style.css';

echo "<div class='main_container'>";

create_header( ['home','products','login','logout'] );
echo "<div class='content' id='update_product_content'>";
if ( isset($_POST['action']) && $_POST['action'] =='update_product' ){
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
    $product = $base -> one_product($barcode);
?>
    <div class='list_div' >
        <ul>
            <span>Product information: </span>
            <li>Barcode: <?php echo $product[0]['barcode']?></li>
            <li>Name: <?php echo $product[0]['name']?></li>
            <li>Category: <?php echo $product[0]['category']?></li>
            <li>Description: <?php echo $product[0]['description']?></li>
            <li>Picture: <?php echo $product[0]['picture']?></li>
            <li>Price: <?php echo $product[0]['price']?> e</li>
            <li>Quantity: <?php echo $product[0]['quantity']?></li>  
        </ul>
    </div>
    <div class='form_div' id='new_preoduct_form_div'>
        <h3>Update product</h3>
        <form id="new_product_form" action="insert_products.php" method='POST'>
            <?php echo "<input type='hidden' name='old_barcode' value='$barcode'>" ?>
            <input type="hidden" name="action" value="updateing_product">
            <input type="text" name="barcode" placeholder="barcode" required><br>
            <input type="text" name="name" placeholder="name" required><br>
            <select class="select" name="category" >
                <option value="obuca">Obuca</option>
                <option value="odeca">Odeca</option>
                <option value="nakit">Nakit</option>
                <option value="kucni_aparati">Kucni aparati</option>
            </select><br>
            <textarea class="text_area" name="description" required>Enter description</textarea><br>
            <input type="text" name="picture" placeholder="enter picture link" required><br>
            <input type="text" name="price" placeholder="price" required><br>
            <input type="text" name="quantity" placeholder="quantity" required><br>
            <input type="submit" class="submit" name="submit" value="submit" required><br> 
        </form>
    </div>
    <?php
}


echo "</div>";
create_footer( ['home','products','login','logout','product_forms'] );

echo "</div>";
?>