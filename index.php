<?php require("con_db.php");
session_start();
ob_start();
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
  <div class="hero_area">
    <div class="hero_social">
      <?php
      if (isset($_SESSION['upgrade'])) 
      {
        $cart_user = $_SESSION['user_name'];
        if ($_SESSION['upgrade'] == 1) 
        {
          echo '<a href="dashboard.php">
        <i title="Go To Admin Dashboard" class="fa fa-check-circle" aria-hidden="true"></i></a>';
          echo "<a title='Logged In' class='fa fa-user-circle' href='#' aria-hidden='true'></a> ";
        } 
        else
          echo "<a title='Logged In' class='fa fa-user-circle' href='#' aria-hidden='true'></a> ";
      }
      else 
      {
        echo '<a href="sign-in.php">
        <i title="Login"  class="fa fa-user" aria-hidden="true"></i>
        </a>';
      }
      echo '<a href="logout.php">
         <i title="Logout" class="fa fa-sign-out" aria-hidden="true"></i>
        </a>';
      if (isset($_SESSION['id'])) {
        $cart_user = $_SESSION['id'];
        echo '<a href="cart_info.php?action=cart_info&id=' . $cart_user . '">
        <i title="cart" class="fa fa-cart-plus" aria-hidden="true"></i></a>';
      }
      ?>
      <a href="facebook.com">
        <i title="facebook" class="fa fa-facebook" aria-hidden="true"></i>
      </a>
      <a href="twitter.com">
        <i title="twitter" class="fa fa-twitter" aria-hidden="true"></i>
      </a>
      <a href="whatsapp.com">
        <i title="whatsapp" class="fa fa-whatsapp" aria-hidden="true"></i>
      </a>
      <a href="instagram.com">
        <i title="instagram" class="fa fa-instagram" aria-hidden="true"></i>
      </a>
    </div>

    <?php require("header.php"); ?>

    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container-fluid ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                    Y-Store
                    </h1>
                    <p>
                      You can guarantee you will find more watch brands than anywhere else.
                    </p>
                    <div class="btn-box">
                      <a href="contact.php" class="btn1">
                        Contact Us
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container-fluid ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                      Watches
                    </h1>
                    <p>
                      Y-Store, you can guarantee you will find more watch brands than anywhere else. From the biggest designer brands, to the best of luxury and some hidden gems, along with outstanding service and next day delivery, Y-Store is the hottest place to buy your next watch.
                    </p>
                    <div class="btn-box">
                      <a href="contact.php" class="btn1">
                        Contact Us
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container-fluid ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                      Watches
                    </h1>
                    <p>
                      Discover how to find the best watch and enjoy exclusive products and offers
                    </p>
                    <div class="btn-box">
                      <a href="contact.php" class="btn1">
                        Contact Us
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <ol class="carousel-indicators">
          <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
          <li data-target="#customCarousel1" data-slide-to="1"></li>
          <li data-target="#customCarousel1" data-slide-to="2"></li>
        </ol>
      </div>
    </section>
  </div>

  <!-- shop section -->
  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Watches
        </h2>
      </div>
      <div class="row">
        <?php
        $i = 1;
        $sql = "select * from watches";
        $statement = $connection->prepare($sql);
        $statement->execute();
        foreach ($statement->fetchall() as $row) {
          $id = $row['ID'];
          if ($i <= 5) {
            echo '
                              <div class="col-sm-6 col-xl-3">
                              <div class="box">
                            <div class="img-box">
                                  <img src="uploade-img/' . $row['image'] . '" alt="">
                            </div>';
            if (isset($_SESSION['id'])) {
              echo '
                                 <div class="add_cart_btn">
                                 <a  href="add-to-cart.php?job=add-to-cart&id=' . $id . '">Add To Cart</a>
                                 </div>';
            } else {
              echo '
                                 <div class="add_cart_btn">
                                 <a  href="sign-in.php?job=add-to-cart&id=' . $id . '">Add To Cart</a>
                                 </div>';
            }
            echo '
                                   <div class="detail-box">
                                  <h6>' . $row['watchname'] . '</h6>
                                  <h6>Price:' . $row['price'] . '$</h6>
                                  </div>
                                 <div class="new">
                                 <span>NEW</span>
                                 </div>
                            <div class="star_container">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <a href="">i</a>
                            </div>
                                   </div>
                                    </div>';
          }

          $i++;
        }
        ?>
      </div>
    </div>
    <div class="back">
      <a href="watches.php">
        view all
      </a>
    </div>
  </section>
  <!-- end shop section -->
  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container  ">
      <div class="row">
        <div class="col-md-6 col-lg-5 ">
          <div class="img-box">
            <img src="images/about-img.png" alt="">
          </div>
        </div>
        <div class="col-md-6 col-lg-7">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                About Us
              </h2>
            </div>
            <p>
            Watches have long been more than mere timekeepers; they embody a fusion of precision, 
            craftsmanship, and style. Beyond their utilitarian function, watches are a reflection 
            of personal taste and a timeless accessory. Whether adorned with intricate complications 
            or boasting minimalist elegance, watches remain a symbol of sophistication. In a world 
            dominated by digital timekeeping, the enduring charm of watches endures as a testament 
            to the enduring allure of the analog.
            </p>
            <a href="about.php">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end about section -->
  <!-- feature section -->
  <section class="feature_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Features Of Our Watches
        </h2>
        <p>
        watches are a reflection of personal taste and a timeless accessory.
        </p>
      </div>
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="images/f1.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Fitness Tracking
              </h5>
              <p>
              watches are a reflection of personal taste and a timeless accessory.
              </p>
              <a href="">
                <span>
                  Read More
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="images/f2.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Alerts & Notifications
              </h5>
              <p>
              watches are a reflection of personal taste and a timeless accessory.
              </p>
              <a href="">
                <span>
                  Read More
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="images/f3.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Messages
              </h5>
              <p>
              watches are a reflection of personal taste and a timeless accessory.
              </p>
              <a href="">
                <span>
                  Read More
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="images/f4.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Bluetooth
              </h5>
              <p>
              watches are a reflection of personal taste and a timeless accessory.
              </p>
              <a href="">
                <span>
                  Read More
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="btn-box">
        <a href="">
          View More
        </a>
      </div>
    </div>
  </section>
  <!-- end feature section -->
  <!-- contact section -->
  <section class="contact_section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <div class="heading_container">
              <h2>
                Contact Us
              </h2>
            </div>
            <form action="">
              <div>
                <input type="text" placeholder="Full Name " />
              </div>
              <div>
                <input type="email" placeholder="Email" />
              </div>
              <div>
                <input type="text" placeholder="Phone number" />
              </div>
              <div>
                <input type="text" class="message-box" placeholder="Message" />
              </div>
              <div class="d-flex ">
                <button>
                  SEND
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="img-box">
            <img src="images/contact-img.jpg" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->
  <br>
  <?php
  require("footer.php");
  ?>