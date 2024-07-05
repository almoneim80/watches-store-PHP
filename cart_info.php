<?php
require("con_db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin Dashboard</title>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/cart_info.css" rel="stylesheet" />
</head>

<body>
    <section>
        <!----------------------------------------------------table---------------------------------------------------------------->
        <h3>All your orders 🛒:</h3>
        <div class="table-style">
            <table class="table">
                <thead>
                    <tr class="head-row-style">
                        <th class="hrs">number of order</th>
                        <th class="hrs">order name</th>
                        <th class="hrs">unit price</th>
                        <th class="hrs">quantity</th>
                        <th class="hrs">amount_paid</th>
                        <th class="hrs">order address</th>
                        <th class="hrs">order Email</th>
                        <th class="hrs">payment method</th>
                        <th class="hrs">order date</th>
                        <th class="hrs">order status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['action'], $_GET['id'])) {
                        $sql = "select * from orders where customer_id=:x1";
                        $statement = $connection->prepare($sql);
                        $statement->execute(array("x1" => $_GET['id']));
                        $i = 1;
                        foreach ($statement->fetchall() as $row) {
                            $id = $row['ID'];
                            echo "<tr class='body-row-style'>";
                            echo "<td >" . $i . "</td>";
                            echo "<td >" . $row['order_name'] . "</td>";
                            echo "<td >" . $row['price'] . '$' . "</td>";
                            echo "<td >" . $row['quantity'] . "</td>";
                            echo "<td >" . $row['price'] * $row['quantity'] . '$' . "</td>";
                            echo "<td >" . $row['order_address'] . "</td>";
                            echo "<td >" . $row['order_Email'] . "</td>";
                            echo "<td >" . $row['payment_method'] . "</td>";
                            echo "<td >" . $row['order_date'] . "</td>";
                            echo "<td >";
                            if ($row['order_state'] == 1)
                                echo " <i title='It was received' class='btn btn-success'></i>";
                            else
                                echo "<i title='Waiting for delivery' class='btn btn-warning'></i>";

                            "</td>";

                            $i++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="back">
            <a href="index.php">Back</a>
        </div>
    </section>
</body>

</html>