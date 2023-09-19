<?php
try{
    $conn = new PDO ('mysql:host=localhost;dbname=noname','root','');
}catch(PDOException $e){
die("failed...!:".$e->getMessage());
}