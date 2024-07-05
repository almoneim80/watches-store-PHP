<?php
require 'con_db.php';

$sql = "delete from customers where id=:x1";
$statement = $connection->prepare($sql);
$statement->execute(array("x1" => $_GET['id']));
if ($statement->rowcount() == 1)
    echo "<script>alert('one user deleted')</script>";
