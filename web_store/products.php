<?php
session_start();
include "class_database.php";
include "functions.php";
include 'style.css';

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
    <div class='main_container' id='main_container_products'>
    <?php
    create_header( ['home','products','cart','login','logout'] );
    echo "<div class='content' id='products_content'>";
    if ( isset($_SESSION['user'])){

        //******PRODUCT FILTER FROM TO */
        if (isset($_GET['action']) && $_GET['action']=='filter_products'){
            $category = $_GET['product_category'];
            $price_range= $_GET['price_range'];
            $select_order = $_GET['select_order'];
            // echo $category;
            // echo $price_range;
            // echo $select_order;
            if ( $category !== 'all_category'){
                $all_products = $base->category_filter_all_products($category);
                if ( $all_products == []){
                    echo "<div class='message'><p>No products found for category</p>";
                    echo '<p><span class="back_arrow"><img src="simbols/back_arrow_simbol.webp" "></span><a href="products.php">back to products</a></p></div><br>';
                    echo '</div>';
                    create_footer( ['home','products','login','logout','product_forms'] );
                    echo '</div>';
                    exit;
                }
                if ( $price_range == 'price_range' && $select_order == 'ascending_or_descending'){
                    show_all_products($all_products);
                    echo '</div>';
                    create_footer( ['home','products','login','logout','product_forms'] );
                    echo '</div>';
                    exit;
                }
            }else{
                $all_products = $base->all_products();
            }
            if ( $price_range !== 'price_range' ){
                $product_list = [];
                $pos = strpos($price_range,'-');
                $p_1 = substr($price_range,0,$pos);
                $p_2 = substr($price_range,$pos+1);

                for ( $i = 0; $i < count ( $all_products ); $i++){
                    if ( $all_products[$i]['price'] >= $p_1 && $all_products[$i]['price'] <= $p_2)
                    array_push( $product_list ,$all_products[$i] );
                }
                if ( $select_order == 'ascending_or_descending'){
                    $all_products = $product_list;
                    if ( $all_products == []){
                        echo "<div class='message'><p>No products found for category</p>";
                        echo '<p><span class="back_arrow"><img src="simbols/back_arrow_simbol.webp" style="width: 30px; hight:25px; color:blue;"></span><a href="products.php">back to products</a></p></div><br>';
                        echo '</div>';
                        create_footer( ['home','products','login','logout','product_forms'] );
                        echo '</div>';
                        exit;                        
                    }
                    show_all_products($all_products);
                    echo '</div>';
                    create_footer( ['home','products','login','logout','product_forms'] );
                    echo '</div>';
                    exit;
                } 
            }else{
                if ( $select_order == 'ascending_or_descending'){
                    show_all_products($all_products);
                    
                }
                if ( $select_order == 'descending'){
                    $price_intiger_array=[];
    
                    for ( $i = 0; $i < count ( $all_products ); $i++ ) {
                        $price_intiger_array[$all_products[$i]['barcode']]=$all_products[$i]['price'];
                    }
    
                    arsort($price_intiger_array);
                    echo "<div class='all_products_container'>";
                    foreach ( $price_intiger_array as $x => $val ){
                            $product= $base->one_product($x);
                            show_one_product($product);
                        }
                    echo "</div>";
                }
                if ( $select_order == 'ascending'){
                    $price_intiger_array=[];
                    $prices=$base->select_price();
    
                    for ( $i = 0; $i < count ( $all_products ); $i++ ) {
                        $price_intiger_array[$all_products[$i]['barcode']]=$all_products[$i]['price'];
                    }
    
                    asort($price_intiger_array);
                    echo "<div class='all_products_container'>";
    
                    foreach ( $price_intiger_array as $x => $val ){
                            $product= $base->one_product($x);
                            show_one_product($product);
                        }
                    echo "</div>";
    
                }  
                echo '</div>';
                create_footer( ['home','products','login','logout','product_forms'] );
                echo '</div>';
                exit;              
            }
            if ( $select_order == 'ascending_or_descending'){
                $all_products = $product_list;
                show_all_products($all_products);
            }
            if ( $select_order == 'descending'){
                $all_products = $product_list;
                $price_intiger_array=[];

                for ( $i = 0; $i < count ( $all_products ); $i++ ) {
                    $price_intiger_array[$all_products[$i]['barcode']]=$all_products[$i]['price'];
                }

                arsort($price_intiger_array);
                echo "<div class='all_products_container'>";
                foreach ( $price_intiger_array as $x => $val ){
                        $product= $base->one_product($x);
                        show_one_product($product);
                    }
                echo "</div>";
            }
            if ( $select_order == 'ascending'){
                $all_products = $product_list;
                $price_intiger_array=[];
                $prices=$base->select_price();

                for ( $i = 0; $i < count ( $all_products ); $i++ ) {
                    $price_intiger_array[$all_products[$i]['barcode']]=$all_products[$i]['price'];
                }

                asort($price_intiger_array);
                echo "<div class='all_products_container'>";

                foreach ( $price_intiger_array as $x => $val ){
                        $product= $base->one_product($x);
                        show_one_product($product);
                    }
                echo "</div>";

            }
            if ( $all_products == []){
                echo "<p>No results for search criteria.</p>";
                echo "<a href='products.php'>Back to products</a>";
            }
            echo "</div>";
            create_footer( ['home','products','login','logout','product_forms'] );
            echo "</div>";
            exit;
        }



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
        echo "<div class='all_filters_div'id='all_filters_div'>";
    //    echo "<div class='form_div' id='price_filter_form_div'>";
    //     echo "<h3>Price filter</h3>";
    //    echo "<form class='select_form' id='price_filter_form' action='products.php' method='POST'>";
    //        echo "<input type='hidden'  name='action' value='price_filter'>";
    //        echo '<select  name="price_range" >';
    //        echo '<option value="price_range">Price range</option>';
    //        echo '<option value="0-20">0-20 e</option>';
    //        echo '<option value="20-50">20-50 e</option>';
    //        echo '<option value="50-80">50-80 e</option>';
    //        echo '<option value="80-100">80-100 e</option>';
    //        echo '<option value="100-1000">100-1000 e</option>';
    //        echo '</select><br>';
    //        echo "<input type='submit'  value='Search'>";

    //    echo '</form>';
    //    echo '</div>';

    //    echo "<div class='form_div' id='pruduct_category_form_div'>";
    //     echo "<h3>Category filter</h3>";
    //    echo "<form class='select_form' id='pruduct_category_filter_form' action='products.php' method='POST'>";
    //        echo "<input type='hidden'  name='action' value='category_filter'>";
    //        echo '<select  name="product_category" >';
    //        echo '<option value="product_category">Product category</option>';
    //        echo '<option value="obuca">obuca</option>';
    //        echo '<option value="odeca">odeca</option>';
    //        echo '<option value="nakit">nakit</option>';
    //        echo '<option value="kucni_aparati">kucni aparati</option>';
    //        echo '</select><br>';
    //        echo "<input type='submit'  value='Search'>";

    //    echo '</form>';
    //    echo '</div>';

    //     //*******Ascending or discending order */
    //    echo "<div class='form_div' id='ascending_or_discending_filter_form_div'>";
    //    echo "<h3>Ascending or discending order</h3>";
    //    echo "<form class='select_form' id='ascending_or_discending_form' action='products.php' >";
    //        echo "<div class='select_div' id='ascending_or_discending_form_div'>";
    //        echo "<input type='hidden'  name='action' value='ascending_or_descending'>";
    //        echo '<select  name="select_order" >';
    //        echo '<option value="ascending_or_descending">ascending or descending</option>';
    //        echo '<option value="ascending">ascending</option>';
    //        echo '<option value="descending">descending</option>';
    //        echo '</select><br>';
    //        echo "</div>";
    //        echo "<input type='submit'  value='Search'>";

    //    echo '</form>';
    //    echo '</div>';

        ///**********Filter form */
        echo "<div class='form_div' id='filter_form_div'>";
        echo "<h3>SEARCH PRODUCTS</h3>";
        echo "<div class='form_wraper' id='filter_form_div_wraper'>";
        echo "<form class='select_form' id='filter_form' action='products.php' >";
            echo "<input type='hidden'  name='action' value='filter_products'>";
            echo "<div class='select_div' id='product_category_select_div'>";
            echo "<p class='select_title'><label >CHOOSE CATEGORY</label></p>";
            echo '<select class="select"  name="product_category" >';
            echo '<option value="all_category">all category</option>';
            echo '<option value="obuca">obuca</option>';
            echo '<option value="odeca">odeca</option>';
            echo '<option value="nakit">nakit</option>';
            echo '<option value="kucni_aparati">kucni aparati</option>';
            echo '</select><br>';
            echo "</div>";
            echo "<div class='select_div' id='price_filter_select_div'>";
            echo "<p class='select_title'><label>CHOOSE PRICE RANGE</label></p>";
            echo '<select class="select"  name="price_range" >';
            echo '<option value="price_range">all prices</option>';
            echo '<option value="0-20">0-20 e</option>';
            echo '<option value="20-50">20-50 e</option>';
            echo '<option value="50-80">50-80 e</option>';
            echo '<option value="80-100">80-100 e</option>';
            echo '<option value="100-1000">100-1000 e</option>';
            echo '</select><br>';
            echo "</div>";
            echo "<div class='select_div' id='ascending_or_discending_select_div'>";
            echo "<p class='select_title'><label>PRICE RAISING OR DROPING</label></p>";
            echo '<select class="select" name="select_order" >';
            echo '<option value="ascending_or_descending">ascending or descending</option>';
            echo '<option value="ascending">ascending</option>';
            echo '<option value="descending">descending</option>';
            echo '</select><br>';
            echo "</div>";
            echo "<input type='submit' class='submit' value='SEARCH'>";
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

    }else{
        echo "<div id='log_in_sing_in_products_php'>";
        echo "<p class='link'><a href='login.php?action=login'>LOG IN</a></p>";
        echo "<p class='link'><a href='index.php?action=login'>SING UP</a></p>";
        echo "</div>";


        $all_products = $base -> all_products();

        show_all_products($all_products);

    }
    echo "</div> ";
    create_footer( ['home','products','login','logout','product_forms'] );
    echo "</div> ";

    ?>
</body>
</html>