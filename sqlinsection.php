<?php

$servername = "localhost";
$username = "dicc";
$password = "diccassam";
$database = "testdb";

if (!isset($mysqli) || $mysqli == false) {
    $mysqli = new mysqli($servername, $username, $password, $database);
    if ($mysqli->connect_error) {
        die("Error in database connection (" . $mysqli->connect_errno . ")" . $mysqli->connect_error);
    }
}

function clean($v) {
    global $mysqli;
    $v = trim($v);
    $v = stripslashes($v);
    $v = htmlentities($v, ENT_QUOTES);
    $v = mysqli_real_escape_string($mysqli, $v);
    return $v;
}//End of clean();


//str_replace(array("'", ""","'",'"'),array("'","&quot;"'","&quot;",$str));
function cleanme($v) {
    $v = trim($v);
    $v = stripslashes($v);
    $v = str_replace(array("'", "`"), array("&quot;","&quot;"), $v);
    $v = htmlentities($v, ENT_QUOTES);
    return $v;
}//End of cleanme();

//header('Content-Type: text/plain;');
$strTest = "<script>alert('Hello $')</script>SELECT * FROM `users` ORDER BY `users`.`entry_time` DESC";
echo "<br>After Clean : ".clean($strTest)."<br>";
echo "\n\n\n";
echo "<br>After Cleanme : ".cleanme($strTest)."<br>";
die();

//$uid = 1;
$uid = "' OR 'a'='a";
$id =clean($uid);
$qryStr = "SELECT * FROM users WHERE uid='".$id."'";
echo "Query : ".$qryStr."<br>";
echo "Query2 : ".$qryStr2."<br>";  die();
$qry = $mysqli->query($qryStr);
while($rows = $qry->fetch_object()) {
    echo $rows->user_name."<br>";
}



$uid = "1; DROP TABLE users";
$qryStr = "SELECT * FROM users WHERE uid=$uid"; //SELECT * FROM users WHERE uid='1'; DROP TABLE users;
echo "str : ".$qryStr."<br>";
$qry = $mysqli->query($qryStr);
while($rows = $qry->fetch_object()) {
    echo $rows->user_name."<br>";
}


//str_replace(array("'", ""","'",'"'),array("'","&quot;"'","&quot;",$str));
    
/*
function BlockSQLInjection($str) {
return str_replace(array("'", ""","'",'"'),array("'","&quot;"'","&quot;",$str));
}
 * 
 */