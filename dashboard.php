<?php
require("con_db.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
    <input type="checkbox" name="" value="" id="check">
    <label for="check">
        <i class="fas fa-bars" id="btn"></i>
        <i class="fas fa-times" id="cancel"></i>
    </label>

    <div class="sidebar">
        <div class="sidebar-header">
        <img src="images/logo.png" width="50" height="50"/>
        <header>Y-Store</header>
        </div>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-qrcode"></i>Dashboard</a></li>
            <li><a href="add-customers.php"><i class="fas fa-qrcode"></i>Customers</a></li>
            <li><a href="add-watche.php"><i class="fas fa-qrcode"></i>Watches</a></li>
            <li><a href="add-category.php"><i class="fas fa-qrcode"></i>categories</a></li>
            <li><a href="Order.php"><i class="fas fa-qrcode"></i>Orders</a></li>
            <li><a href="index.php"><i class="fas fa-qrcode"></i>Back to home</a></li>
        </ul>
    </div>
    <section>
        <div class="slids">
            <div class="watch-style">
                <div class="h3_">
                    <h3>Number of Customers :</h3>
                </div>
                <div class="watch-style-2">
                    <h2>
                        <?php
                        $sql = "select * from customers";
                        $customer = $connection->prepare($sql);
                        $customer->execute();
                        echo $customer->rowcount();
                        ?>
                    </h2>
                </div>
            </div>

            <div class="watch-style">
                <div class="h3_">
                    <h3>Number of Watches :</h3>
                </div>
                <div class="watch-style-2">
                    <h2>
                        <?php
                        $sql = "select * from watches";
                        $watche = $connection->prepare($sql);
                        $watche->execute();
                        echo $watche->rowcount();
                        ?>
                    </h2>
                </div>
            </div>

            <div class="watch-style">
                <div class="h3_">
                    <h3>Number of categories :</h3>
                </div>
                <div class="watch-style-2">
                    <h2>
                        <?php
                        $sql = "select * from categories";
                        $category = $connection->prepare($sql);
                        $category->execute();
                        echo $category->rowcount();
                        ?>
                    </h2>
                </div>
            </div>

            <div class="watch-style">
                <div class="h3_">
                    <h3>Number of Orders :</h3>
                </div>
                <div class="watch-style-2">
                    <h2>
                        <?php
                        $sql = "select * from orders";
                        $order = $connection->prepare($sql);
                        $order->execute();
                        echo $order->rowcount();
                        ?>
                    </h2>
                </div>
            </div>

            <div class="watch-style">
                <div class="h3_">
                    <h3>Net Profit :</h3>
                </div>
                <div class="watch-style-2">
                    <?php
                    $profits = 0;
                    $i = 1;
                    $sql = "select * from orders";
                    $watche = $connection->prepare($sql);
                    $watche->execute();
                    foreach ($watche->fetchall() as $row) {
                        if ($row['price'] < 1000)
                            $profits = $profits + 50;

                        elseif ($row['price'] < 2000)
                            $profits = $profits + 100;

                        elseif ($row['price'] < 3000)
                            $profits = $profits + 150;

                        elseif ($row['price'] < 4000)
                            $profits = $profits + 200;
                        else
                            $profits = $profits + 250;
                        $i++;
                    }
                    echo '<h2>' . $profits . '$' . '</h2>';
                    ?>
                </div>
            </div>
        </div>
    </section>
</body>

</html>