<?php
if(isset($_POST['ddelete'])){
    $id = $_POST["id"];
    require("includes/db.php");
    $stmt = $conn->prepare("DELETE from `tasks` where id = ?");
    $stmt->execute([$id]);
    header("location:index.php");

}

?> 