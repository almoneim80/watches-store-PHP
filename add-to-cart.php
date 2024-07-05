<?php
require 'con_db.php';
session_start();
if (isset($_SESSION['id'])) {
  $u_id = $_SESSION['id'];
}

if (isset($_POST['buy'])) {
  $ordername = $_POST['w_name'];
  $orderprice = $_POST['price'];

  if (empty($_POST['quantity']))
    echo "<script>alert('Please enter the required quantity');</script>";

  elseif (empty($_POST['or_Add']))
    echo "<script>alert('Please enter the order address');</script>";

  elseif (empty($_POST['order_email']))
    echo "<script>alert('Please enter your email address');</script>";

  elseif (!filter_var($_POST['order_email'], FILTER_VALIDATE_EMAIL))
    echo "<script>alert('Please enter a valid email address');</script>";

  elseif (empty($_POST['payment']))
    echo "<script>alert('Please enter your payment method');</script>";
  else {
    $sql = 'INSERT INTO orders(order_name,price,customer_id,quantity,order_address,payment_method,order_Email) 
                         VALUES(:w_name,:price,:u_id,:quantity,:or_Add,:payment,:order_email)';
    $statement = $connection->prepare($sql);
    $statement->execute(array(':w_name' => $_POST['w_name'], ':price' => $_POST['price'], ':u_id' => $u_id, ':quantity' => $_POST['quantity'], ':or_Add' => $_POST['or_Add'], ':payment' => $_POST['payment'], ':order_email' => $_POST['order_email']));

    if ($statement->rowcount()) {
      echo "<script>alert('The order was completed successfully ✅');</script>";
      echo "<script>alert('You will receive the order within 24 hours');</script>";
      echo "<script>alert('Thank you, dear customer 😘.');</script>";
    } else
      echo "<script>alert('هناك خطأ حاول مرة أخرى');</script>";
  }
}

if (isset($_GET['job'], $_GET['id'])) {

  if ($_GET['job'] == 'add-to-cart' or 'search') {
    $sql = "select * from watches where ID=:x1";
    $statement = $connection->prepare($sql);
    $statement->execute(array("x1" => $_GET['id']));
    if ($statement->rowcount() > 0) {
      $rowe = $statement->fetch();
    }
  }
}

function valid_input($data)            // validation function
{
  $data = trim($data);
  $data = stripcslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Dashboard</title>
  <link href="css/add-to-cart.css" rel="stylesheet" />
</head>

<body>
  <div class="img">
    <?php if (isset($rowe)) echo '<img src="uploade-img/' . $rowe['image'] . '">'; ?>
  </div>

  <div class="w-inf">
    <fieldset>
      <legend>Watch information</legend>
      <div class="info"><label>Watch name : <?php if (isset($rowe)) echo $rowe['watchname']; ?></label></div>
      <div class="info"><label>Watch Price : <?php if (isset($rowe)) echo $rowe['price'] . '$'; ?></label></div>
      <div class="info"><label>Watch Brand : <?php if (isset($rowe)) echo $rowe['category_type']; ?></label></div>
      <div class="info"><label>Watch Provenance : <?php if (isset($rowe)) echo $rowe['provenance']; ?></label></div>
      <div class="info"><label>Watch Category : <?php if (isset($rowe)) echo $rowe['category_name']; ?></label></div>
      <div class="info"><label>Watch Description : <?php if (isset($rowe)) echo $rowe['description']; ?></label></div>
    </fieldset>
  </div>

  <div class="b-inf">
    <fieldset>
      <legend>Buy information</legend>
      <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="c_id" value="<?php if (isset($rowe)) echo $rowe['ID'];  ?>" />

        <div class="input"><label>quantity<input type="text" name="quantity" placeholder="amount of watches" required></label></div>

        <div class="input"><label>Order Address<input type="text" name="or_Add" placeholder="Order Address" required></label></div>

        <div class="input"><label>Order Email<input type="text" name="order_email" placeholder="Order Email"></label></div>

        <div class="input"><label>payment_method<input type="text" name="payment" placeholder="payment_method" required></label></div>

        <input type="hidden" name="w_name" value="<?php if (isset($rowe)) echo $rowe['watchname']; ?>">

        <input type="hidden" name="price" value="<?php if (isset($rowe)) echo $rowe['price']; ?>">

        <button class="buy" type="submit" name="buy" class="button">BUY</button>
      </form>
      <div class="back">
        <a href="index.php">Back</a>
      </div>
    </fieldset>
  </div>
</body>

</html>