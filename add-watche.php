<?php require("con_db.php");

if (isset($_POST['submit'])) {
  $img_name = $_FILES['w_image']['name'];
  $img_size = $_FILES['w_image']['size'];
  $tmp_name = $_FILES['w_image']['tmp_name'];
  $img_ex_lc = pathinfo($img_name, PATHINFO_EXTENSION);
  $allowed_exs = array("jpg", "jpeg", "png", "gif");

  $w_name = valid_input($_POST['w_name']);
  $cat_type = valid_input($_POST['category_type']);
  $price = valid_input($_POST['price']);
  $cat_name = valid_input($_POST['category_name']);
  $provenance = valid_input($_POST['provenance']);
  $description = valid_input($_POST['description']);


  if (empty($w_name))
    echo "<script>alert('Please enter the watch name');</script>";
  elseif (empty($cat_type))
    echo "<script>alert('Please enter the category_type name');</script>";
  elseif (empty($price))
    echo "<script>alert('Please enter the price');</script>";
  elseif (empty($cat_name))
    echo "<script>alert('Please enter the category');</script>";
  elseif (empty($provenance))
    echo "<script>alert('Please enter the provenance');</script>";
  elseif (empty($description))
    echo "<script>alert('Please enter the description');</script>";
  elseif (empty($img_name))
    echo "<script>alert('Please enter image');</script>";
  elseif ($img_size > 1000000)
    echo "<script>alert('Sorry, your file is too large.');</script>";
  elseif (!in_array($img_ex_lc, $allowed_exs))
    echo "<script>alert('Sorry, your file extension is falid.');</script>";
  elseif (empty($_POST['c_id'])) {
    $sql = "select name from categories where name='$cat_name'";
    $statement = $connection->prepare($sql);
    $statement->execute();
    if ($statement->rowcount() > 0) {
      move_uploaded_file($tmp_name, "uploade-img/$img_name");
      $sql = 'INSERT INTO watches(watchname, category_type,   category_name,price ,provenance, description,image) 
               VALUES(:w_name, :category_type, :price, :category_name, :provenance, :description, :w_image)';
      $statement = $connection->prepare($sql);

      $statement->execute(array(':w_name' => $_POST['w_name'], ':category_type' => $_POST['category_type'], ':category_name' => $_POST['category_name'], ':price' => $_POST['price'], ':provenance' => $_POST['provenance'], ':description' => $_POST['description'], ':w_image' => $img_name));

      if ($statement->rowcount())
        echo "<script>alert('data inserted successfully');</script>";
      else
        echo "<script>alert('Error');</script>";
    } else
      echo  "<script>alert('This category does not exist Please enter the category name correctly or add a new category');</script>";
  } else {
    $sql = "select name from categories where name='$cat_name'";
    $statement = $connection->prepare($sql);
    $statement->execute();
    if ($statement->rowcount() > 0) {
      move_uploaded_file($tmp_name, "uploade-img/$img_name");
      $sql = 'update watches set watchname=:w_name, category_type=:category_type,  price=:price, category_name=:category_name, provenance=:provenance, description=:description,image=:w_image where ID=:x3';

      $statement = $connection->prepare($sql);

      $statement->execute(array(':w_name' => $_POST['w_name'], ':category_type' => $_POST['category_type'], ':price' => $_POST['price'], ':category_name' => $_POST['category_name'], ':provenance' => $_POST['provenance'], ':description' => $_POST['description'], ':w_image' => $img_name, ':x3' => $_POST['c_id']));

      if ($statement->rowcount())
        echo "<script>alert('data updated successfully');</script>";
      else
        echo "<script>alert('Error');</script>";
    } else
      echo "<script>alert('This category does not exist Please enter the category name correctly or add a new category');</script>";
  }
}

if (isset($_GET['action'], $_GET['id']) and intval($_GET['id']) > 0) {
  switch ($_GET['action']) {
    case 'delete':
      $sql = "delete from watches where id=:x1";
      $statement = $connection->prepare($sql);
      $statement->execute(array("x1" => $_GET['id']));
      if ($statement->rowcount() == 1)
        echo "<script>alert('One watch deleted')</script>";
      break;
    case 'edit':
      $sql = "select * from watches where ID=:x1";
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
  <link href="css/add-watch.css" rel="stylesheet" />
  <link href="css/bootstrap.css" rel="stylesheet" />
</head>

<body>
  <section>
    <div class="addwatch">
      <label class="tab">Add New Watch</label>
      <form class="form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="c_id" value="<?php if (isset($rowe)) echo $rowe['ID'];  ?>" />

        <input class="input" type="text" name="w_name" placeholder="watchname" value="<?php if (isset($rowe)) echo $rowe['watchname']; ?>" required>

        <input class="input" type="text" name="category_name" placeholder="category name" value="<?php if (isset($rowe)) echo $rowe['category_name']; ?>" required>

        <input class="input" type="text" name="category_type" placeholder="category type" value="<?php if (isset($rowe)) echo $rowe['category_type']; ?>" required>

        <input class="input" type="text" name="price" placeholder="price" value="<?php if (isset($rowe)) echo $rowe['price']; ?>" required>

        <input class="input" type="text" name="provenance" placeholder="provenance" value="<?php if (isset($rowe)) echo $rowe['provenance']; ?>" required>

        <input class="input" type="text" name="description" placeholder="description" value="<?php if (isset($rowe)) echo $rowe['description']; ?>" required>

        <input class="image" type="file" name="w_image" value="" required>

        <button type="submit" name="submit" class="button">Add</button>

      </form>
    </div>
    <!----------------------------------------------------table---------------------------------------------------------------->
    <div class="table-style">
        <table class="table">
          <thead>
            <tr class="head-row-style">
              <th class="hrs">ID</th>
              <th class="hrs">watchname</th>
              <th class="hrs">category name</th>
              <th class="hrs">category type</th>
              <th class="hrs">price</th>
              <th class="hrs">provenance</th>
              <th class="hrs">image</th>
              <th class="hrs">description</th>
              <th class="hrs">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "select * from watches order by id desc";
            $statement = $connection->prepare($sql);
            $statement->execute();

            $i = 1;
            foreach ($statement->fetchall() as $row) {
              $id = $row['ID'];
              echo "<tr class='body-row-style'>";
              echo "<td >" . $i . "</td>";
              echo "<td >" . $row['watchname'] . "</td>";
              echo "<td >" . $row['category_name'] . "</td>";
              echo "<td >" . $row['category_type'] . "</td>";
              echo "<td >" . $row['price'] . '$' . "</td>";
              echo "<td >" . $row['provenance'] . "</td>";
              echo "<td >" . $row['image'] . "</td>";
              echo "<td >" . $row['description'] . "</td>";
              echo "<td >";
              echo "<a title='CLick to Edit' class='btn btn-primary' href='?action=edit&id=$id'></a> ";
              echo "<a title='Click to delete' onclick=\"return confirm('Are you sure ?')\" class='btn btn-danger' href='?action=delete&id=$id'></a>";
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