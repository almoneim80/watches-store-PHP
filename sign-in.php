<?php
require("con_db.php");
session_start();
if (isset($_POST['login'])) {
    $u_name = valid_input($_POST['username']);
    $pass1 = valid_input($_POST['password']);
    $pass2 = valid_input($_POST['password2']);
    $pass_enc = md5($pass2);
    $remember = $_POST['remember'];
    if ($remember == 1) {
        setcookie('cookie_user', $_POST['username'], time() + 86400, "/"); // 86400(60*60*24) = 1 day
    }
    if (empty($u_name))
        echo "<script>alert('يرجى ادخال اسم المستخدم');</script>";
    elseif (empty($pass1))
        echo "<script>alert('يرجى ادخال كلمة المرور');</script>";
    elseif (empty($pass2))
        echo "<script>alert('يرجى تكرار كلمة المرور');</script>";
    elseif ($pass1 !== $pass2)
        echo "<script>alert('كلمة المرور غير متطابقة');</script>";
    else {
        $sql = "select * from customers where user_name='$u_name' and password='$pass_enc'";
        $statement = $connection->prepare($sql);
        $statement->execute();
        if ($statement->rowcount() > 0) {
            $user_info = $statement->fetch(PDO::FETCH_OBJ);
            $_SESSION['id'] = $user_info->id;
            $_SESSION['user_name'] = $user_info->user_name;
            $_SESSION['password'] = $rowe->password;
            $_SESSION['Email'] = $rowe->Email;
            $_SESSION['Gender'] = $rowe->Gender;
            $_SESSION['billing_address'] = $rowe->billing_address;
            $_SESSION['default_shipping_address'] = $rowe->default_shipping_address;
            $_SESSION['default_shipping_address'] = $rowe->default_shipping_address;
            $_SESSION['country'] = $user_info->country;
            $_SESSION['phone'] = $user_info->phone;
            $_SESSION['image'] = $user_info->image;
            $_SESSION['upgrade'] = $user_info->upgrade;
            header("location:index.php");
        } else {
            echo "<script>alert('يرجى انشاء حساب أولاً');</script>";
            echo "<script>window.location.replace('sign-in.php')</script>";
        }
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
<!-------------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link href="css/sign-in-style.css" rel="stylesheet" />
</head>

<body>
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
            <div class="login-form">
                <div class="sign-in-htm">
                    <div class="login-form">
                        <div class="sign-in-htm">
                            <form class="login-form" method="POST" action="">
                                <div class="group">
                                    <label for="user" class="label">Username</label>
                                    <input class="input" type="text" name="username" placeholder="Username" value="<?php if (isset($_COOKIE['cookie_user'])) echo $_COOKIE['cookie_user']; ?> " required>
                                    <label for="pass" class="label">Password</label>
                                    <input class="input" type="password" data-type="password" name="password" placeholder="Password" required>
                                    <label for="pass" class="label">Repeat Password</label>
                                    <input id="pass" type="password" class="input" data-type="password" name="password2" placeholder="Repeat Password" required>
                                    <input id="check" class="check" type="checkbox" name="remember" value="1" checked>
                                    <label for="check"><span class="icon">Keep me Signed in</span> </label>
                                    <button name="login" class="button" type="submit">Login</button>
                                </div>
                                <div class="hr"></div>
                                <div class="foot-lnk">
                                    <a href="forgot_pass1.php">Forgot Password?</a><br>
                                </div>
                                <div class="foot-lnk-New">
                                    <a href="sign-up.php">New Customer</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>