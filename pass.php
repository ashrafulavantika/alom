<?php
$inputPass = 'User@bc1';
$uppercase = preg_match('@[A-Z]@', $inputPass);
$lowercase = preg_match('@[a-z]@', $inputPass);
$number    = preg_match('@[0-9]@', $inputPass);
$specialChars = preg_match('@[^\w]@', $inputPass);
if(strlen($inputPass) < 8) {
    $passMsg = "Password should be at least 8 characters in length.";
} elseif(!$uppercase) {
    $passMsg = "Password must contain at least 1 Upper Case Letters.";
} elseif(!$lowercase) {
    $passMsg = "Password must contain at least 1 Lower Case Letters.";
} elseif(!$number) {
    $passMsg = "Password must contain at least 1 Digits.";
} elseif(!$specialChars) {
    $passMsg = "Password must contain at least 1 Special Characters.";
} else {
    $passMsg = "Okay";
}//End of if else
echo $passMsg;
