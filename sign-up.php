<?php
require 'con_db.php';

if (isset($_POST['submit'])) {
  $img_name = $_FILES['p_image']['name'];
  $img_size = $_FILES['p_image']['size'];
  $tmp_name = $_FILES['p_image']['tmp_name'];
  $img_ex_lc = pathinfo($img_name, PATHINFO_EXTENSION);
  $allowed_exs = array("jpg", "jpeg", "png", "gif");

  $c_name = valid_input($_POST['c_name']);
  $pass1 = valid_input($_POST['pass1']);
  $pass2 = valid_input($_POST['pass2']);
  $email = valid_input($_POST['mail']);
  $Gender = valid_input($_POST['Gender']);
  $billing_add = valid_input($_POST['billing_add']);
  $default_sh_add = valid_input($_POST['default_sh_add']);
  $country = valid_input($_POST['country']);
  $phone = valid_input($_POST['phone']);

  if (empty($c_name))
    echo "<script>alert('Please enter the Customer name');</script>";
  elseif (empty($pass1))
    echo "<script>alert('Please enter the password');</script>";
  elseif (empty($pass2))
    echo "<script>alert('Please enter the repeat password');</script>";
  elseif (empty($img_name))
    echo "<script>alert('Please enter image');</script>";
  elseif ($pass1 !== $pass2)
    echo "<script>alert('password not identical');</script>";
  elseif (empty($email))
    echo "<script>alert('Please enter the email');</script>";
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
    echo "<script>alert('Please enter a valid email address');</script>";
  elseif (empty($Gender))
    echo "<script>alert('Please enter the Gender');</script>";
  elseif (empty($billing_add))
    echo "<script>alert('Please enter the billing_address');</script>";
  elseif (empty($default_sh_add))
    echo "<script>alert('Please enter the default_shipping_address');</script>";
  elseif (empty($country))
    echo "<script>alert('Please enter the country');</script>";
  elseif (empty($phone))
    echo "<script>alert('Please enter your phone number');</script>";
  elseif ($img_size > 200000)
    echo "<script>alert('Sorry, your file is too large.');</script>";
  elseif (!in_array($img_ex_lc, $allowed_exs))
    echo "<script>alert('Sorry, your file extension is falid.');</script>";
  else {
    move_uploaded_file($tmp_name, "uploade-img/$img_name");
    $sql = 'INSERT INTO customers(user_name, password,  Email, Gender ,billing_address, default_shipping_address, country, phone,image) 
               VALUES(:c_name, :pass2, :mail, :Gender, :billing_add, :default_sh_add, :country, :phone,:p_image)';
    $statement = $connection->prepare($sql);
    $statement->execute(array(':c_name' => $_POST['c_name'], ':pass2' =>
    md5($_POST['pass2']), ':mail' => $_POST['mail'], ':Gender' => $_POST['Gender'], ':billing_add'
    => $_POST['billing_add'], ':default_sh_add' => $_POST['default_sh_add'], ':country'
    => $_POST['country'], ':phone' => $_POST['phone'], ':p_image' => $img_name));
    if ($statement->rowcount()) {
      echo "<script>alert('your account created successfully');</script>";
      echo "<script>window.location.replace('index.php')</script>";
    } else
      echo "<script>alert('Error');</script>";
  }
}

function valid_input($data)
{                     // validation function
  $data = trim($data);
  $data = stripcslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!--========================================================================================================= -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link href="css/sign-up-style.css" rel="stylesheet" />
</head>

<body>
  <div class="login-wrap">
    <div class="login-html">
      <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
      <div class="login-form">
        <div class="sign-up-htm">
          <div class="group">
            <form class="login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
              <label for="user" class="label">Username</label>
              <input class="input" type="text" name="c_name" placeholder="Username" value="" required>
              <label for="pass" class="label">Password</label>
              <input id="pass" type="password" class="input" name="pass1" placeholder="Password" required>
              <label for="pass" class="label">Repeat Password</label>
              <input id="pass" type="password" class="input" name="pass2" placeholder="Repeat Password" required>
              <label for="Email" class="label">Email Address</label>
              <input type="text" class="input" name="mail" placeholder="email" required>
              <label for="Gender" class="label">Gender</label>
              <input type="text" class="input" name="Gender" placeholder="Gender" required>
              <label for="billing_address" class="label">billing_address</label>
              <input type="text" class="input" name="billing_add" placeholder="billing_address" required>
              <label for="default_shipping_address" class="label">default_shipping_address</label>
              <input type="text" class="input" name="default_sh_add" placeholder="default_shipping_address" required>
              <label for="country" class="label">country</label>
              <input type="text" class="input" name="country" placeholder="country" required>
              <label for="phone" class="label">phone</label>
              <input type="text" class="input" name="phone" placeholder="your phone" required>
              <label for="image" class="label">personal image</label>
              <input class="image" type="file" name="p_image">
              <button type="submit" name="submit" class="button">Create a user</button>
            </form>
          </div>
          <div class="hr"></div>
          <div class="foot-lnk">
            <a href="sign-in.php"><label for="tab-1">Already Customer?</label></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>