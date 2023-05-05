<?php

    include 'connect.php';

    if(isset($_POST['register'])){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $password = sha1($_POST['password']);
        $password_confirm = sha1($_POST['confirm-password']);
        $status = "active";

        $verify_phone = $conn->prepare("SELECT * FROM `admin_page` WHERE phone = ? AND name = ? ");
        $verify_phone->execute([$phone,$name]);

        if($verify_phone->rowCount() > 0){
            $warning_msg[] = "تم التحقق من رقم الهاتف بالفعل";
        }else {
            if($password !== $password_confirm) {
                $warning_msg[] = 'من فضلك كلمات السر غير متطابقة';
            }else {
                $insert_phone = $conn->prepare("INSERT INTO `admin_page`(name, phone, password,status) VALUES(?,?,?,?)");
                $insert_phone->execute([$name,$phone,$password,$status]);
                $success_msg[] = "تم إنشاء حسابك بنجاح";
                header("Location: login.php");
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- file cdnjs css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style\style.css">
    <title>مزارع</title>
</head>
    <section class="container">
        <h1>مرحبا بكم في المزارعين</h1>
        <div class="box">
            <div class="image">
                <img src="Farmer-bro.png" alt="">
            </div>
                <div class="login-box">
                    <h2>التسجيل</h2>
                    <form method="post">
                        <div class="user-box">
                            <input type="text" name="name" required="">
                            <label>الاسم</label>
                        </div>
                        <div class="user-box">
                            <input type="number" name="phone" required="">
                            <label>رقم الهاتف</label>
                        </div>
                        <div class="user-box">
                            <input type="password" name="password" required="">
                            <label>كلمة المرور</label>
                        </div>
                        <div class="user-box">
                            <input type="password" name="confirm-password" required="">
                            <label>تاكد كلمة المرور</label>
                        </div>
                        <button type="submit" name="register">
                            <span>التسجيل</span>
                            <span>التسجيل</span>
                            <span>التسجيل</span>
                            <span>التسجيل</span>
                            التسجيل
                        </button>
                        <p> لديك حساب ؟ <a href="login.php">سجل الان</a></p>
                    </form>
                </div>
        </div>
    </section>

            <!-- sweetalert -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php
    include "alerts.php";
    ?>
</body>
</html>



