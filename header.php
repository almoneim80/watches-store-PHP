<?php require("con_db.php");
?>

<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
      <a class="navbar-brand" href="index.php">
        <img src="images/logo.png" width="50" height="50">
        <span>
          Y-Store
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""> </span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="watches.php"> Watches </a>
            <ul>
              <li><a href="#">Brands</a>
              </li>
              <li><a href="#">Material</a>
              </li>
              <li><a href="#">Type</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php"> About </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact Us</a>
          </li>
        </ul>
        <?php
        if (isset($_POST['search'])) {
          $searchq = $_POST['w_name'];

          if (empty($searchq))
            echo "<script>alert('Please enter the watch name');</script>";
          else {
            $sql = "select * from watches where watchname ='$searchq'";
            $statement = $connection->prepare($sql);
            $statement->execute();
            if ($statement->rowcount() > 0) {
              $rowe = $statement->fetch();
              $w_id = $rowe['ID'];
              header("location:add-to-cart.php?job=search&id=$w_id");
              //ob_enf_fluch();            
            } else
              echo "<script>alert('There is no search results!');</script>";
          }
        }
        ?>
        <div class="sear_nav">
          <form class="search_form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST"> <!--search_form-->
            <input type="text" class="form-control" placeholder="Search by watch name..." name="w_name">
            <button class="buy" type="submit" name="search" class="button"><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
        </div>
      </div>
    </nav>
</header>