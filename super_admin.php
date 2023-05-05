<?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmers";
session_start();

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$admin_id = $_SESSION['admin_id'];
    
if(!$admin_id){
    header("Location: login.php");
}
$query = "SELECT * FROM admin_page WHERE id=$admin_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

if($row['user_type'] != 'super_admin') {
    header("Location: dashboard.php");
}
// Delete an admin
if(isset($_POST['delete'])) {
  $id = $_POST['id'];
  $sql = "DELETE FROM admin_page WHERE id=$id";

  if (mysqli_query($conn, $sql)) {
    echo '<script>swal("Admin updated successfully!", "", "success");</script>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

// enable/disable an admin
if(isset($_POST['enable'])) {
    $id = $_POST['id'];
    $statusToUpdate = 'Unactive';
    $query = "SELECT * FROM admin_page WHERE id=$id";
    $result = mysqli_query($conn, $query);
print_r($result);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_array($result);
        $status = $row['status'];

    }
    if ($status == 'Unactive') {
        $statusToUpdate = 'active';
    } else {
        $statusToUpdate = 'Unactive';
    }

    $sql2 = "UPDATE admin_page set status = '$statusToUpdate' WHERE id=$id";

    if (mysqli_query($conn, $sql2)) {
      echo '<script>swal("Admin updated successfully!", "", "success");</script>';
    } else {
      echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    }
  }

// Fetch all admins from the database
$sql = "SELECT * FROM admin_page WHERE user_type in ('admin', 'super_admin') ";
$result = mysqli_query($conn, $sql);

$sql1 = "SELECT * FROM admin_page WHERE user_type = 'user' ";
$result1 = mysqli_query($conn, $sql1);
$count = mysqli_num_rows($result);
print_r($count);

$sql2 = "SELECT * FROM admin_page WHERE user_type = 'admin' ";
$result2 = mysqli_query($conn, $sql2);
$count2 = mysqli_num_rows($result2);
print_r($count2);

$sql3 = "SELECT * FROM admin_page WHERE user_type = 'admin' and status = 'active'";
$result3 = mysqli_query($conn, $sql3);
$count3 = mysqli_num_rows($result3);


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
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
                                            <img width="42" class="rounded-circle" src="images\logo1.png" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <a href="logout.php" type="button" tabindex="0" class="dropdown-item">Logout</a>
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
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>    
                <div class="app-main__outer">
                    <div class="app-main__inner">
                    <div class="row">
                    <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-arielle-smile">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading"> utilisateurs</div>
                                            <div class="widget-subheading">nombre totale des utilisateurs</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $count ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">administrateurs actifs</div>
                                            <div class="widget-subheading">Nombre total d'administrateurs actifs</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $count3; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-grow-early">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Admins</div>
                                            <div class="widget-subheading">Nombre total d'administrateurs</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $count2; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                <div class="card-header">Utilisateurs actifs
                                        <div class="btn-actions-pane-right">
                                            <div role="group" class="btn-group-sm btn-group">
                                                <a href="add_admin.php" class="active btn btn-focus">Ajouter un nouvel administrateur</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Nom</th>
                                                <th class="text-center">Type d'utilisateur</th>
                                                <th class="text-center">Statut</th>
                                                <th class="text-center">Activer/désactiver</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                <td class="text-center text-muted"><?php echo $row['id']; ?></td>
                                                <td class="text-center"><?php echo $row['name']; ?></td>
                                                <td class="text-center"><?php echo $row['user_type']; ?></td>
                                                <td class="text-center">
                                                    <?php echo ($row['status']); ?>
                                                </td>
                                                <td class="text-center">
                                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <input type="submit" class="btn <?php echo ($row['status'] === 'active' ? 'btn-info' : 'btn-warning'); ?> btn-sm" name="enable" value="<?php echo ($row['status'] === 'active' ? 'Disable' : 'Enable'); ?>">
                                                </form>
                                                </td>
                                                <td class="text-center">
                                                <p style="display:inline-block"> <a  class="btn btn-primary btn-sm" href='edit.php?id="<?php echo $row['id']; ?>"'>Modifier</a>
                                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <input type="submit" class="btn btn-danger btn-sm" name="delete" value="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer cet administrateur ?')">
                                                    </form> </p>
                                               
                                                </td>
                                                </tr>
                                            <?php } ?>
                                          
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-block text-center card-footer">
                                   
                                    
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
