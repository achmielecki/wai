<?php
$db= get_db();
$user = $db->users->deleteOne(['login' => 'admin']);

//print_r($user)

?>