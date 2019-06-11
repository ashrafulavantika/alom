<?php
$id=123;
$encrypted_id = base64_encode($id.'0242319A1p145623');
$decrypted_id = preg_replace(sprintf('/%s/', '0242319A1p145623'), '', base64_decode($encrypted_id));


echo "encrypted_id : ".$encrypted_id;
echo "<br>decrypted_id : ".$decrypted_id;

