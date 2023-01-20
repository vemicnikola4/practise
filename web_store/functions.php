<?php

function create_form($title,$form_action, $method, $array_type, $array_name, $array_value, $array_placeholder){
    echo "<div class='form_div'>";
    echo "<h3>$title</h3>";
    echo "<form action='$form_action' method='$method'>";
    for ( $i = 0; $i < count( $array_type ); $i++){
        echo "<input type='$array_type[$i]' name='$array_name[$i]' value= '$array_value[$i]' placeholder= '$array_placeholder[$i]' required>";
    }
    echo "</form>";
    echo "</div>";
}
function create_header( $array ){
    echo "<div class='header'>";
    echo "<div class='inner_header'>";
    echo "<ul class='navigation'>";
    for ( $i = 0 ; $i < count( $array ); $i++){
        echo "<li><a href='$array[$i].php'>$array[$i]</a></li>";
    }
    echo "</div>";
    echo "</div>";
}
function create_footer( $array ){
    echo "<div class='footer'>";
    echo "<div class='inner_footer'>";
    echo "<ul class='navigation' id ='navigation'>";
    for ( $i = 0 ; $i < count( $array ); $i++){
        echo "<li><a href='$array[$i].php'>$array[$i]</a></li>";
    }
    echo "<h3>Copyright of webstore</h3>";
    echo "</div>";
    echo "</div>";
}
function validate_password($password){
    $count = 0;
    $leter = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','X'];
    $has = false;
    for ( $i = 0; $i < count ( $leter ); $i++){
        if ( strpos ($password, $leter[$i]) !== false){
            $has = true;
        }
    }
    if ( $has == true ){
        $count+=1;
    }    
    $number = ['0','1','2','3','4','5','6','7','8','9'];
    $has = false;
    for ( $i = 0; $i < count ( $number ); $i++){
        if ( strpos ($password, $number[$i]) !== false){
            $has = true;
        }
    }    
    if ( $has == true){
        $count+=1;
    }    
    $special_caracter = ['@','$','%','&'];
    $has = false;
    for ( $i = 0; $i < count ( $special_caracter ); $i++){
        if ( strpos ($password, $special_caracter[$i]) !== false){
            $has = true;
        }
    }    
    if ( $has == true){
        $count+=1;
    }   
    if ($count == 3){
        return true;
    }else{
        return false;
    }
}
function show_all_products($all_products){
    echo "<div class='all_products_container'>";
    echo "<div class='product_container'>";
    echo "<table>";
    for ( $i= 0; $i < count( $all_products ); $i++){
        $barcode = $all_products[$i]['barcode'];
        $name = $all_products[$i]['name'];
        $picture = $all_products[$i]['picture'];
        $description = $all_products[$i]['description'];
        $price = $all_products[$i]['price'];
        echo "<th><h3>".$name."</h3></th>";
        echo "<tr><td><div class='image_div'><img style='border:solid black;width:200px; height:250px' src='pictures/".$picture."'></div></td></tr>";
        echo "<tr><td>Price: ". $description. "</td></tr>";
        echo "<tr><td>Price:". $price. " e</td></tr>";
        echo "<tr><td> <a href='add_to_cart.php?action=add_to_cart&barcode=$barcode'>ADD TO CART</a></td></tr>";
        echo "</div>";
    }
    echo "</table>";
    echo "</div>";
    echo "</div>";
}

?>