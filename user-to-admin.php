<?php
require 'con_db.php';

$sql = "update customers set upgrade=1 where id=:x1";
$statement = $connection->prepare($sql);
$statement->execute(array("x1" => $_GET['id']));
if ($statement->rowcount() == 1)
  echo "<script>alert('user upgrade to Admin')</script>";
