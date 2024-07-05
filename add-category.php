<?php
require("con_db.php");

if (isset($_POST['submit'])) {
  $ca_name = valid_input($_POST['ca_name']);
  $description = valid_input($_POST['description']);

  if (empty($ca_name))
    echo "<script>alert('Please enter the category name');</script>";
  elseif (empty($description))
    echo "<script>alert('Please enter the description');</script>";
  elseif (empty($_POST['c_id'])) {
    $sql = 'INSERT INTO categories(name,description) 
               VALUES(:ca_name, :description)';
    $statement = $connection->prepare($sql);
    $statement->execute(array(':ca_name' => $ca_name, ':description' => $description));

    if ($statement->rowcount())
      echo "<script>alert('data inserted successfully');</script>";
    else
      echo "<script>alert('Error');</script>";
  } else {
    $sql = 'update categories set name=:ca_name, description=:description  where ID=:x3';
    $statement = $connection->prepare($sql);
    $statement->execute(array(':ca_name' => $_POST['ca_name'], ':description' => $_POST['description'], ':x3' => $_POST['c_id']));
    if ($statement->rowcount())
      echo "<script>alert('data updated successfully');</script>";
    else
      echo "<script>alert('Error');</script>";
  }
}

if (isset($_GET['action'], $_GET['id']) and intval($_GET['id']) > 0) {
  switch ($_GET['action']) {
    case 'delete':
      $sql = "delete from categories where id=:x1";
      $statement = $connection->prepare($sql);
      $statement->execute(array("x1" => $_GET['id']));
      if ($statement->rowcount() == 1)
        echo "<script>alert('one category deleted')</script>";
      break;
    case 'edit':
      $sql = "select * from categories where ID=:x1";
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
  <link href="css/addcategory.css" rel="stylesheet" />
  <link href="css/bootstrap.css" rel="stylesheet" />
</head>

<body>
  <div class="all">
    <div class="addcategory">
      <label class="tab">Add category</label>
      <form class="form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="c_id" value="<?php if (isset($rowe)) echo $rowe['id'];  ?>" />

        <input class="input" type="text" name="ca_name" placeholder="category Name" value="<?php if (isset($rowe)) echo $rowe['name'];  ?>">

        <input class="input" type="text" name="description" placeholder="description" value="<?php if (isset($rowe)) echo $rowe['description'];  ?>">

        <button type="submit" name="submit" class="button">Add</button>

      </form>
    </div>
    <!----------------------------------------------------table---------------------------------------------------------------->
    <div class="table-style">
        <table class="table">
          <thead>
            <tr class="head-row-style">
              <th class="hrs">ID</th>
              <th class="hrs">category name</th>
              <th class="hrs">description</th>
              <th class="hrs">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "select * from categories order by id desc";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $i = 1;
            foreach ($statement->fetchall() as $row) {
              $id = $row['id'];
              echo "<tr class='body-row-style'>";
              echo "<td >" . $i . "</td>";
              echo "<td >" . $row['name'] . "</td>";
              echo "<td >" . $row['description'] . "</td>";
              echo "<td >";
              echo "<a title='Click To Edit' class='btn btn-primary' href='?action=edit&id=$id'></a> ";
              echo "<a title='Click To Delete' onclick=\"return confirm('Are you sure ?')\" class='btn btn-danger' href='?action=delete&id=$id'></a>";
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
  </div>
</body>

</html>