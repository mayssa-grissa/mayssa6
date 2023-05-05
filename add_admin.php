<?php

function send_mail($email,$message,$subject)
{						
    require_once('mailer/class.phpmailer.php');
    $mail = new PHPMailer();
    $mail->IsSMTP(); 
    $mail->SMTPAuth   = true;                  
    $mail->SMTPSecure = "ssl";                 
    $mail->Host       = "smtp.gmail.com";      
    $mail->Port       = 465;             
    $mail->AddAddress($email);
    $mail->Username   = 'farmers.app.test@gmail.com';                     //SMTP username
    $mail->Password   = 'eqbkrxtytwadajbi';             
    $mail->SetFrom('farmers.app.test@gmail.com','Farmers');
    $mail->AddReplyTo("farmers.app.test@gmail.com","Farmers");
    $mail->Subject    = $subject;
    $mail->MsgHTML($message);
    $mail->Send();
    return $mail;
}

// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmers";

$conn = mysqli_connect($servername, $username, $password, $dbname);
session_start();

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$admin_id = $_SESSION['admin_id'];
    
if(!$admin_id){
    header("Location: login.php");
}

// Create a new admin
if(isset($_POST['submit'])) {
  $name = $_POST['name'];
  $password = sha1($_POST['password']);
  $user_type = $_POST['user_type'];

  $sql = "INSERT INTO admin_page (name, password, user_type) VALUES ('$name', '$password', '$user_type')";

  if (mysqli_query($conn, $sql)) {
    header("Location: super_admin.php");

  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

// Fetch all admins from the database
$sql = "SELECT * FROM admin_page WHERE user_type in ('admin', 'super_admin') ";
$result = mysqli_query($conn, $sql);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard </title>
<link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet"></head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>   
             <div class="app-header__content">
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <button type="button" tabindex="0" class="dropdown-item">Logout</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        Mayssa Grissa
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>       
                 </div>
            </div>
        </div>  
        <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Tableaux de bord</li>
                                <li>
                                <p><a href="dashboard.php">comptes des fermiers</a></p>
                                 <p><a href="super_admin.php">Gérer les administrateurs</a></p>
                                 <p><a href="add_admin.php">Ajouter un administrateur</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>    
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                <div class="card-header">Créer un nouvel administrateur
                                </div>
                                    <div class="d-block text-center card-footer">
                                   
                                        <form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                <label for="inputName4">Nom</label>
                                                <input type="text" name="name" class="form-control" required id="inputEmail4" placeholder="Nom">
                                                </div>
                                                <div class="form-group col-md-6">
                                                <label for="inputPassword4">mot de passe</label>
                                                <input type="password" name="password" required class="form-control" id="inputPassword4" placeholder="mot de passe">
                                                </div>
                                            </div>
                                                <div class="form-group col-md-12">
                                                <label for="inputState">État</label>
                                                <select id="inputState" class="form-control" name="user_type">
                                                    <option selected>choisir...</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="super_admin">Super Admin</option>
                                                </select>
                                                </div>
                                                <input type="submit" name="submit" class="btn btn-primary" value="Créer">

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
<script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script></body>
</html>
