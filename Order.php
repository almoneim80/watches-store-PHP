<?php require("con_db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin Dashboard</title>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/order.css" rel="stylesheet" />
</head>

<body>
    <section>
        <div class="Orders">
            <div class="class1">
                <h5>Orders Overview </h5>
                <span>Total orders</span>
                <h2><?php
                    $sql = "select * from orders";
                    $watche = $connection->prepare($sql);
                    $watche->execute();
                    echo $watche->rowcount();
                    ?></h2>
                <span>Orders Delivered</span>
                <h2><?php
                    $sql = "select * from orders where order_state=1";
                    $watche = $connection->prepare($sql);
                    $watche->execute();
                    echo $watche->rowcount();
                    ?></h2>
                <span>Pending requests</span>
                <h2><?php
                    $sql = "select * from orders where order_state=0";
                    $watche = $connection->prepare($sql);
                    $watche->execute();
                    echo $watche->rowcount();
                    ?></h2>
                <span>profits</span>
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
        <?php
        if (isset($_GET['action'], $_GET['id']) and intval($_GET['id']) > 0) {

            switch ($_GET['action']) {

                case 'delivery':
                    $sql = "update orders set order_state=1 where id=:x1";
                    $statement = $connection->prepare($sql);
                    $statement->execute(array("x1" => $_GET['id']));
                    if ($statement->rowcount() == 1)
                        echo "<script>alert('تم تسليم الطلب بنجاح')</script>";
                    break;
                default:
                    echo "<script>alert('error')</script>";
                    break;
            }
        }
        ?>
        <!----------------------------------------------------table---------------------------------------------------------------->
        <div class="table-style">
                <table class="table">
                    <thead>
                        <tr class="head-row-style">
                            <th class="hrs">ID</th>
                            <th class="hrs">order_name</th>
                            <th class="hrs">price</th>
                            <th class="hrs">quantity</th>
                            <th class="hrs">customer_id</th>
                            <th class="hrs">order address</th>
                            <th class="hrs">order Email</th>
                            <th class="hrs">payment method</th>
                            <th class="hrs">order date</th>
                            <th class="hrs">order status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select * from orders order by id desc";
                        $statement = $connection->prepare($sql);
                        $statement->execute();
                        $i = 1;
                        foreach ($statement->fetchall() as $row) {
                            $id = $row['ID'];
                            echo "<tr class='body-row-style'>";
                            echo "<td >" . $i . "</td>";
                            echo "<td >" . $row['order_name'] . "</td>";
                            echo "<td >" . $row['price'] . "</td>";
                            echo "<td >" . $row['quantity'] . "</td>";
                            echo "<td >" . $row['customer_id'] . "</td>";
                            echo "<td >" . $row['order_address'] . "</td>";
                            echo "<td >" . $row['order_Email'] . "</td>";
                            echo "<td >" . $row['payment_method'] . "</td>";
                            echo "<td >" . $row['order_date'] . "</td>";
                            echo "<td >";
                            if ($row['order_state'] == 1)
                                echo "<a title='Delivered' class='btn btn-success'</a>";
                            else
                                echo "<a title='Click To Deliver' class='btn btn-warning' href='?action=delivery&id=$id'></a>";
                            "</td>";
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