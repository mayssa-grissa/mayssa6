<?php

    include 'connect.php';
    session_start();

    $admin_id = $_SESSION['admin_id'];
    
    if(!$admin_id){
        header("Location: register.php");
    }
    $isSuperAdmin =false;


    $query = "SELECT * FROM admin_page WHERE id=$admin_id";
    $admin = $conn->prepare($query);
    $admin->execute();
    if($admin->rowCount() > 0){


        $fetch_account = $admin->fetch(PDO::FETCH_ASSOC);
        if($fetch_account['user_type'] == 'super_admin') {
            $isSuperAdmin =true;
        }
    }


   

    if(isset($_POST['uptate'])) {
        $access_user = $_POST['access-user'];
        $id = $_POST['id'];
        $update_access = $conn->prepare("UPDATE admin_page SET access = ? WHERE id = '$id'");
        $update_access->execute([$access_user]);
        $success_msg[] = "access updated!";
    }


    $notification = $conn->prepare("SELECT * FROM `admin_page` WHERE user_type = 'user' AND access not LIKE 'Allow'");
    $notification->execute();
    $countNotif = $notification->rowCount();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">

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
                                        <span class="icon-button__badge"><?= $countNotif?></span>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                        <?php
                                        if ($countNotif > 0) {
                                         ?>
                                            <button type="button" tabindex="0" class="dropdown-item">You have <?= $countNotif?> new user.</button>
                                            <?php
                                        }
                                         ?>
                                            <a href="logout.php" type="button" tabindex="0" class="dropdown-item">Logout</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                    <?php
                                        $select_name = $conn->prepare("SELECT * FROM admin_page WHERE id = ?");
                                        $select_name->execute([$admin_id]);
                                        $fetch_name = $select_name->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                        <?= $fetch_name['name']?>
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
                                <li class="app-sidebar__heading">tableaux de bord</li>
                                <li>
                                <p><a href="dashboard.php">comptes des fermiers</a></p>
                                <?php
                                        if ($isSuperAdmin) {
                                ?>
                                <p><a href="super_admin.php">Gérer les administrateurs</a></p>
                                <?php
                                        }
                                ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>    
                <div class="app-main__outer">
                    <div class="app-main__inner">
                    <div class="row">
                    <div class="col-md-6 col-xl-4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                <div class="card-header">utilisateurs actifs
                                        <div class="btn-actions-pane-right">
                                        
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Nom</th>
                                                <th class="text-center">téléphone</th>
                                                <th class="text-center">statut</th>
                                                <th class="text-center">date</th>
                                                <th class="text-center">Accès</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                            $select_accounts = $conn->prepare("SELECT * FROM admin_page WHERE user_type = 'user'");
                            $select_accounts->execute();
                            if($select_accounts->rowCount() > 0) {
                                while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td  class="text-center" style="<?php if($fetch_accounts['access'] == 'Allow'){echo "background: green; color:#fff"; }else{echo "background: red; color:#fff";}; ?>"><?= $fetch_accounts['id']?></td>
                                            <td  class="text-center"><?= $fetch_accounts['name']?></td>
                                            <td  class="text-center"><?= $fetch_accounts['phone']?></td>
                                            <td  class="text-center"><?= $fetch_accounts['status']?></td>
                                            <td  class="text-center"><?= $fetch_accounts['cr_date']?></td>
                                            <td  class="text-center">
                                                <form method="post" class="access">
                                                    <input type="hidden" value="<?= $fetch_accounts['id']?>" name="id">
                                                    <select name="access-user" required>
                                                        <option selected>chosen one from these</option>
                                                        <option value="Allow">Allow</option>
                                                        <option value="UnAllow">UnAllow</option>
                                                    </select>

                                                    <input type="submit" value="Uptate" name="uptate">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else {
                                echo '<p class="empty">not added users yet!</p>';
                            }
                        ?>
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
