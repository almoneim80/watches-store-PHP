<?php
require("con_db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
  <title>Y-Store</title>

  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
  <?php require("header.php"); ?>
  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Watches
        </h2>
      </div>
      <div class="row">
        <!--####################################################################################################1-->
        <?php
        $sql = "select * from watches";
        $statement = $connection->prepare($sql);
        $statement->execute();
        foreach ($statement->fetchall() as $row) {
          $id = $row['ID'];
          echo '
        <div class="col-sm-6 col-xl-3">
          <div class="box">
              <div class="img-box">
                <img src="uploade-img/' . $row['image'] . '" alt="">
              </div>
              <div class="add_cart_btn">
                <a  href="add-to-cart.php?job=add-to-cart&id=' . $id . '">Add To Cart</a>
                  </div>
                                     <div class="detail-box">
                                  <h6>' . $row['watchname'] . '</h6>
                                  <h6>Price:' . $row['price'] . '$</h6>
                                  </div>
              <div class="star_container">
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <a href="">
                  i
                </a>
                </div>
               
          </div>
        </div>
        ';
        } ?>
        <!--####################################################################################################2-->
      </div>
      <div class="btn-box">
        <a href="index.php">
          Back
        </a>
      </div>
    </div>
  </section>

  <?php
  require("footer.php");
  ?>