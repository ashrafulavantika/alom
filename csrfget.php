<?php
session_start(); echo $_SESSION['csrf_token'];
if(isset($_GET['csrf_token']) && $_SESSION['csrf_token'] == $_GET['csrf_token']) {
    if (time() <= $_SESSION['csrf_time']) {
        $name = $_GET['name'];
        echo "Matched : ".$name;
    } else {
        echo '<a href="javascript:window.history.back()">Token does not matched</a>';
    }//End of if else  
} else {
    echo '<a href="javascript:window.history.back()">Token does not matched</a>';
}//End of if else