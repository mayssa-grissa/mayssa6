<?php
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
	header("Location: index.php");
}


if(isset($_GET['id'])){
    $id = $_GET['id'];
	$query = "SELECT * FROM admin_page WHERE id=$id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_array($result);
        $name = $row['name'];
        $status = $row['status'];
        $user_type = $row['user_type'];
    }
}

if(isset($_POST['update'])){
    $id = $_GET['id'];
    $name = $_POST['name'];
    $status = $_POST['status'];
    $user_type = $_POST['user_type'];

    $query = "UPDATE admin_page set name = '$name', status = '$status', user_type = '$user_type' WHERE id=$id";
    mysqli_query($conn, $query);

    header('Location: super_admin.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
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
                                <li class="app-sidebar__heading">Dashboards</li>
                                <li>
                                <p><a href="dashboard.php">Accounts farmers</a></p>
                                 <p><a href="super_admin.php">Manage Admins</a></p>
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
                                    <div class="d-block text-center card-footer">
                                    <h2>Update Admin</h2>

                                   
									<form  method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputName4">Name</label>
                                                    <input type="text" name="name" value="<?php echo $name;?>" class="form-control" required id="inputEmail4" placeholder="Name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputState">State</label>
                                                    <select id="inputState" class="form-control" name="user_type">
                                                        <option value="admin" <?php if($user_type == 'admin') echo 'selected="selected"'; ?>>Admin</option>
                                                        <option value="user" <?php if($user_type == 'user') echo 'selected="selected"'; ?>>User</option>
                                                        <option value="super_admin" <?php if($user_type == 'super_admin') echo 'selected="selected"'; ?>>Super Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                                <input type="submit" name="update" class="btn btn-primary" value="Update">

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
