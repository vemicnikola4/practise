<?php
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
    echo "</div>";
    echo "</div>";
}
function create_form($form_action, $input_action, $method, $array_type, $array_name){
    echo "<div class='form_div'>";
    echo "<form action='$form_action' method='$method'>";
    echo "<input type='hidden' name='action' value='$input_action'>";
    for ( $i = 0; $i < count( $array_type ); $i++){
        echo "<input type='$array_type[$i]' name='$array_name[$i]'>";
    }
    echo "</form>";
    echo "</div>";
}

?>