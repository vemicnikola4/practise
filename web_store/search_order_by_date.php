<?php
ob_start();
session_start();
include 'functions.php';
include 'class_database.php';
include_once 'style.css';
echo "<div main_container>";
echo "<div class='content' id='search_order_by_date_content'>";

create_header( ['home','products','cart','login','logout'] );
echo "<div class='content' id='index_content'>";
if ( isset($_GET['date']) ){
    $date= $_GET['date'];
    $all_orders = $base->all_cart();
    // echo $datee;
    $cart_ids=[];
    for ( $i= 0; $i < count($all_orders);$i++){
        if ($date == substr( $all_orders[$i]['date'],0,10)){
            $order_id = $all_orders[$i]['order_id'];
            array_push($cart_ids, $order_id);
        } 
    }
    for ( $i= 1; $i < count($cart_ids);$i++){
        if ($cart_ids[$i] == $cart_ids[$i-1]){
            array_splice($cart_ids,$i);
        }
    }
    if ( $cart_ids !==[]){
        for( $i= 0; $i < count($cart_ids);$i++){
            $base->show_cart_for_employees($cart_ids[$i]);
        }
        echo "<div class='message'>";
        echo "<a href='product_forms.php'>Back</a><br>";
        echo "</div>";

    }else { 
        echo "<div class='message'>";
        echo "<p>No order for date ".$date."</p>";
        echo "<a href='product_forms.php'>Back</a><br>";
        echo "</div>";
    }
    
}

//*******Today orders */
if ( isset($_GET['date_select']) && $_GET['date_select']=='today'){
    $date = date('Y-m-d');
    $all_orders = $base->all_cart();
    // echo $datee;
    $cart_ids=[];
    for ( $i= 0; $i < count($all_orders);$i++){
        if ($date == substr( $all_orders[$i]['date'],0,10)){
            $order_id = $all_orders[$i]['order_id'];
            array_push($cart_ids, $order_id);
        } 
    }
    for ( $i= 1; $i < count($cart_ids);$i++){
        if ($cart_ids[$i] == $cart_ids[$i-1]){
            array_splice($cart_ids,$i);
        }
    }
    if ($cart_ids!== [] ){
        for( $i= 0; $i < count($cart_ids);$i++){
            $base->show_cart_for_employees($cart_ids[$i]);
        }
        echo "<div class='message'>";
        echo "<a href='product_forms.php'>Back</a><br>";
        echo "</div>";
    }else{
        echo "<div class='message'>";
        echo "<p>No order for date ".$date."</p>";
        echo "<a href='product_forms.php'>Back</a><br>";

        echo "</div>";
    }
    
}

//*******Yesterday orders */
if ( isset($_GET['date_select']) && $_GET['date_select']=='yesterday'){
    $date = date('Y-m-d',strtotime("-1 days"));
    $all_orders = $base->all_cart();
    // echo $datee;
    $cart_ids=[];
    for ( $i= 0; $i < count($all_orders);$i++){
        if ($date == substr( $all_orders[$i]['date'],0,10)){
            $order_id = $all_orders[$i]['order_id'];
            array_push($cart_ids, $order_id);
        } 
    }
    for ( $i= 1; $i < count($cart_ids);$i++){
        if ($cart_ids[$i] == $cart_ids[$i-1]){
            array_splice($cart_ids,$i);
        }
    }
    if ($cart_ids!== [] ){
        for( $i= 0; $i < count($cart_ids);$i++){
            $base->show_cart_for_employees($cart_ids[$i]);
        }
        echo "<div class='message'>";
        echo "<a href='product_forms.php'>Back</a><br>";
        echo "</div>";

    }else{
        echo "<div class='message'>";
        echo "<p>No order for date ".$date."</p>";
        echo "<a href='product_forms.php'>Back</a><br>";

        echo "</div>";
    }
}

//*******LAst week orders */

if ( isset($_GET['date_select']) && $_GET['date_select']=='last_week'){
    $to_date = date('Y-m-d');
    $from_date = date('Y-m-d',strtotime("-7 days"));
    $all_cart_for_date = $base->data_filter($from_date,$to_date);
    if ($all_cart_for_date !== [] ){
        for( $i= 0; $i < count($all_cart_for_date);$i++){
            $base->show_cart_for_employees($all_cart_for_date[$i]['order_id']);
        }
        echo "<div class='message'>";
        echo "<a href='product_forms.php'>Back</a><br>";
        echo "</div>";

    }else{
        echo "<div class='message'>";
        echo "<p>No order for this dates</p>";
        echo "<a href='product_forms.php'>Back</a><br>";

        echo "</div>";        
    }    
}
if ( isset($_GET['date_select']) && $_GET['date_select']=='last_month'){
    $to_date = date('Y-m-d');
    $from_date = date('Y-m-d',strtotime("-30 days"));
    $all_cart_for_date = $base->data_filter($from_date,$to_date);
    if ($all_cart_for_date !== [] ){
        for( $i= 0; $i < count($all_cart_for_date);$i++){
            $base->show_cart_for_employees($all_cart_for_date[$i]['order_id']);
        }
        echo "<div class='message'>";
        echo "<a href='product_forms.php'>Back</a><br>";
        echo "</div>";        

    }else{
        echo "<div class='message'>";
        echo "<p>No order for this dates</p>";
        echo "<a href='product_forms.php'>Back</a><br>";
        echo "</div>";        
    }    
}

/******From date to date orders */
if ( isset($_GET['action']) && $_GET['action']=='from_date_to_date'){
    $to_date = $_GET['to_date'];
    $from_date = $_GET['from_date'];
    $all_cart_for_date = $base->data_filter($from_date,$to_date);
    if ($all_cart_for_date !== [] ){
        for( $i= 0; $i < count($all_cart_for_date);$i++){
            $base->show_cart_for_employees($all_cart_for_date[$i]['order_id']);
        }
        echo "<div class='message'>";
        echo "<a href='product_forms.php'>Back</a><br>";
        echo "</div>";

    }else{
        echo "<div class='message'>";
        echo "<p>No order for this dates</p>";
        echo "<a href='product_forms.php'>Back</a><br>";
        echo "</div>";        
    }    
}
echo "</div>";
create_footer( ['home','products','cart','login','logout','product_forms'] );
echo "</div>";


?>