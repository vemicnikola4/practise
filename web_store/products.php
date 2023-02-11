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
    <title>Products</title>
</head>
<body>
    <div class='main_contaner' id='main_container_products'>
    <?php
    echo "<div class='content'>";
    create_header( ['home','products','cart','login','logout'] );
    if ( isset($_SESSION['user'])){
        echo "<h1>HELLO USER YOU ARE WELCOME</h1>";

        //******PRICE FILTER FROM TO */
        if (isset($_POST['action']) && $_POST['action']=='price_filter'){
            $price_range= $_POST['price_range'];
            if ($price_range == 'price_range'){
                header ( 'Location: products.php' );

            }
            $pos = strpos($price_range,'-');
            $p_1 = substr($price_range,0,$pos);
            $p_2 = substr($price_range,$pos+1);
            $all_products = $base->price_filter_all_products($p_1,$p_2);
            if ( $all_products == []){
                echo "<p>No products found for such a criteria</p>";
                echo "<a href='products.php'>BACK TO PRODUCTS</a>";
            }
            show_all_products($all_products);
            echo "</div>";
            create_footer( ['home','products','login','logout','product_forms'] );
            echo "</div>";
            exit;
        }

        //******CATEGORY FILTER SHOW ONLY PRODUCTS FROM SERTAIN CATEGORY */
        if (isset($_POST['action']) && $_POST['action']=='category_filter'){
            $category= $_POST['product_category'];
            if ( $category == 'product_category'){
                header ( 'Location: products.php' );
            }
            $all_products = $base->category_filter_all_products($category);
            if ( $all_products == []){
                echo "<p>No products found for category</p>";
            }
            show_all_products($all_products);
            echo "</div>";
            create_footer( ['home','products','login','logout','product_forms'] );
            echo "</div>";
    
            exit;
        }

        //*******Ascending or discending order */
        if ( isset($_GET['action']) && $_GET['action'] == 'ascending_or_descending'){
            $select_order = $_GET['select_order'];
            if ( $select_order == 'ascending_or_descending'){
                header ( 'Location: products.php' );
            }
            if ( $select_order == 'descending'){
                $all_products = $base -> all_products();
                $price_intiger_array=[];
                $prices=$base->select_price();
            
                for ( $i = 0; $i < count ( $prices ); $i++ ) {
                    $price_intiger_array[$prices[$i]['barcode']]=$prices[$i]['price'];
                }
                
                arsort($price_intiger_array);
            
                foreach ( $price_intiger_array as $x => $val ){
                        $product= $base->one_product($x);
                        show_one_product($product);
                    }
            }
            if ( $select_order == 'ascending'){
                $all_products = $base -> all_products();
                $price_intiger_array=[];
                $prices=$base->select_price();
            
                for ( $i = 0; $i < count ( $prices ); $i++ ) {
                    $price_intiger_array[$prices[$i]['barcode']]=$prices[$i]['price'];
                }
                
                asort($price_intiger_array);
            
                foreach ( $price_intiger_array as $x => $val ){
                        $product= $base->one_product($x);
                        show_one_product($product);
                    }                
            }
            echo "</div>";
            create_footer( ['home','products','login','logout','product_forms'] );
            echo "</div>";
            exit;
        }

        $all_products = $base -> all_products();

        show_all_products($all_products);

        echo "<div class='form_div' id='price_filter_form_div'>";
        echo "<form class='select_form' id='price_filter_form' action='products.php' method='POST'>";
            echo "<input type='hidden'  name='action' value='price_filter'>";
            echo '<select  name="price_range" >';
            echo '<option value="price_range">Price range</option>';
            echo '<option value="0-20">0-20 e</option>';
            echo '<option value="20-50">20-50 e</option>';
            echo '<option value="50-80">50-80 e</option>';
            echo '<option value="80-100">80-100 e</option>';
            echo '<option value="100-1000">100-1000 e</option>';
            echo '</select><br>';
            echo "<input type='submit'  value='Search'>";

        echo '</form>';
        echo '</div>';

        echo "<div class='form_div' id='pruduct_category_form_div'>";
        echo "<form class='select_form' id='pruduct_category_form' action='products.php' method='POST'>";
            echo "<input type='hidden'  name='action' value='category_filter'>";
            echo '<select  name="product_category" >';
            echo '<option value="product_category">Product category</option>';
            echo '<option value="obuca">obuca</option>';
            echo '<option value="odeca">odeca</option>';
            echo '<option value="nakit">nakit</option>';
            echo '<option value="kucni_aparati">kucni aparati</option>';
            echo '</select><br>';
            echo "<input type='submit'  value='Search'>";

        echo '</form>';
        echo '</div>';

        //*******Ascending or discending order */
        echo "<div class='form_div' id='ascending_or_discending_form_div'>";
        echo "<form class='select_form' id='ascending_or_discending_form' action='products.php' >";
            echo "<input type='hidden'  name='action' value='ascending_or_descending'>";
            echo '<select  name="select_order" >';
            echo '<option value="ascending_or_descending">ascending or descending</option>';
            echo '<option value="ascending">ascending</option>';
            echo '<option value="descending">descending</option>';
            echo '</select><br>';
            echo "<input type='submit'  value='Search'>";

        echo '</form>';
        echo '</div>';
    }else{
        echo "<div class='link'><a href='login.php?action=login'>LOG IN</a></div>";
        echo "<div class='link'><a href='index.php?action=login'>SING UP</a></div>";

        $all_products = $base -> all_products();

        show_all_products($all_products);

    }
    echo "</div> ";
    create_footer( ['home','products','login','logout','product_forms'] );
    ?>
    </div>
</body>
</html>