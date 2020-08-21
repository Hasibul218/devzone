<?php 
$pass_hash="";
$pass='3652';

echo $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

echo var_dump(password_verify($pass, $pass_hash));

 ?>