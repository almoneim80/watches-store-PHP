<?php
require 'con_db.php';

if (isset($_POST['submit'])) {
  $img_name = $_FILES['p_image']['name'];
  $img_size = $_FILES['p_image']['size'];
  $tmp_name = $_FILES['p_image']['tmp_name'];
  $img_ex_lc = pathinfo($img_name, PATHINFO_EXTENSION);
  $allowed_exs = array("jpg", "jpeg", "png", "gif", "");

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

  elseif (empty($_POST['c_id'])) {
    move_uploaded_file($tmp_name, "uploade-img/$img_name");
    $sql = 'INSERT INTO customers(user_name, password,  Email, Gender ,billing_address, default_shipping_address, country, phone,image) 
               VALUES(:c_name, :pass2, :mail, :Gender, :billing_add, :default_sh_add, :country, :phone,:p_image)';
    $statement = $connection->prepare($sql);
    $statement->execute(array(':c_name' => $_POST['c_name'], ':pass2' => md5($_POST['pass2']), ':mail' => $_POST['mail'], ':Gender' => $_POST['Gender'], ':billing_add' => $_POST['billing_add'], ':default_sh_add' => $_POST['default_sh_add'], ':country' => $_POST['country'], ':phone' => $_POST['phone'], ':p_image' => $img_name));

    if ($statement->rowcount())
      echo "<script>alert('Data inserted successfully ✅');</script>";
    else
      echo "<script>alert('Error');</script>";
  } else {
    move_uploaded_file($tmp_name, "uploade-img/$img_name");
    $sql = 'update customers set user_name=:c_name, password=:pass2,  Email=:mail, Gender=:Gender, billing_address=:billing_add, default_shipping_address=:default_sh_add, country=:country, phone=:phone,image=:p_image where ID=:x3';
    $statement = $connection->prepare($sql);
    $statement->execute(array(':c_name' => $_POST['c_name'], ':pass2' => md5($_POST['pass2']), ':mail' => $_POST['mail'], ':Gender' => $_POST['Gender'], ':billing_add' => $_POST['billing_add'], ':default_sh_add' => $_POST['default_sh_add'], ':country' => $_POST['country'], ':phone' => $_POST['phone'], ':p_image' => $img_name, ':x3' => $_POST['c_id']));
    if ($statement->rowcount())
      echo "<script>alert('Data updated successfully ✅');</script>";
    else
      echo "<script>alert('Error');</script>";
  }
}

if (isset($_GET['action'], $_GET['id']) and intval($_GET['id']) > 0) {
  switch ($_GET['action']) {
    case 'delete':
      $sql = "delete from customers where id=:x1";
      $statement = $connection->prepare($sql);
      $statement->execute(array("x1" => $_GET['id']));
      if ($statement->rowcount() == 1)
        echo "<script>alert('one user deleted')</script>";
      break;
    case 'inactive':
      require("admin-to-user.php");
      break;
    case 'active':
      require("user-to-admin.php");
      break;
    case 'edit':
      $sql = "select * from customers where ID=:x1";
      $statement = $connection->prepare($sql);
      $statement->execute(array("x1" => $_GET['id']));
      if ($statement->rowcount() > 0) {
        $rowe = $statement->fetch();
      }
      break;
    default:
      echo "<script>alert('error')</script>";
      break;
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
<!--------------------------------------------------form----------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Dashboard</title>
  <link href="css/add-customer.css" rel="stylesheet" />
  <link href="css/bootstrap.css" rel="stylesheet" />
</head>

<body>
  <section>
    <div class="addcustomer">
      <label class="tab">Add New Customer</label>
      <form class="form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="c_id" value="<?php if (isset($rowe)) echo $rowe['id'];  ?>" />

        <input class="input" type="text" name="c_name" placeholder="Username" value="<?php if (isset($rowe)) echo $rowe['user_name']; ?>" required>

        <input id="pass" type="password" class="input" name="pass1" placeholder="Password" required value="">

        <input id="pass" type="password" class="input" name="pass2" placeholder="Repeat Password" required value="">

        <input type="text" class="input" name="mail" id="email" placeholder="email" required value="<?php if (isset($rowe)) echo $rowe['Email']; ?>">

        <input type="text" class="input" name="Gender" id="Gender" placeholder="Gender" required value="<?php if (isset($rowe)) echo $rowe['Gender']; ?>">

        <input type="text" class="input" name="billing_add" id="billing_address" placeholder="billing_address" value="<?php if (isset($rowe)) echo $rowe['billing_address']; ?>">

        <input type="text" class="input" name="default_sh_add" id="default_shipping_address" placeholder="default_shipping_address" required value="<?php if (isset($rowe)) echo $rowe['default_shipping_address'];  ?>">

        <input type="text" class="input" name="country" id="country" placeholder="country" required value="<?php if (isset($rowe)) echo $rowe['country']; ?>">

        <input type="text" class="input" name="phone" id="phone" placeholder="your phone" required value="<?php if (isset($rowe)) echo $rowe['phone']; ?>">

        <input class="image" type="file" name="p_image" value="<?php if (isset($rowe)) echo $rowe['image']; ?>">

        <button type="submit" name="submit" class="button">Add</button>

      </form>
    </div>
    <!----------------------------------------------------table---------------------------------------------------------------->
    <div class="table-style">
        <table class="table">
          <thead>
            <tr class="head-row-style">
              <th class="hrs">ID</th>
              <th class="hrs">Name</th>
              <th class="hrs">password</th>
              <th class="hrs">Email</th>
              <th class="hrs">Gender</th>
              <th class="hrs">billing_add</th>
              <th class="hrs">DSA</th>
              <th class="hrs">country</th>
              <th class="hrs">phone</th>
              <th class="hrs">image</th>
              <th class="hrs">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "select * from customers order by id desc";
            $statement = $connection->prepare($sql);
            $statement->execute();

            $i = 1;
            foreach ($statement->fetchall() as $row) {
              $id = $row['id'];
              echo "<tr class='body-row-style'>";
              echo "<td >" . $i . "</td>";
              echo "<td >" . $row['user_name'] . "</td>";
              echo "<td >" . $row['password'] . "</td>";
              echo "<td >" . $row['Email'] . "</td>";
              echo "<td >" . $row['Gender'] . "</td>";
              echo "<td >" . $row['billing_address'] . "</td>";
              echo "<td >" . $row['default_shipping_address'] . "</td>";
              echo "<td >" . $row['country'] . "</td>";
              echo "<td >" . $row['phone'] . "</td>";
              echo "<td >" . $row['image'] . "</td>";
              echo "<td >";
              echo "<a title='Click To Edit' class='btn btn-primary' href='?action=edit&id=$id'></a> ";
              echo "<a title='Click To Delete' onclick=\"return confirm('Are you sure ?')\" class='btn btn-danger' href='?action=delete&id=$id'></a> ";

              if ($row['upgrade'] == 1)
                echo "<a title='Click to delete permissions' onclick=\"return confirm('Are you sure ?')\" class='btn btn-success' href='?action=inactive&id=$id'></a>";
              else
                echo "<a title='Click to add permissions' onclick=\"return confirm('Are you sure ?')\" class='btn btn-warning' href='?action=active&id=$id'></a>";
              echo "</td>";
              echo "</tr>";
              $i++;
            }
            ?>
          </tbody>
        </table>
    </div>
    <div class="back">
      <a href="dashboard.php">Back</a>
    </div>
  </section>
</body>

</html>