<?php require_once("views/templates/layout/first.php"); ?>
    <link rel="stylesheet" href="<?php echo constant('URL') ?>views/css/profile.css">
    <title>Profile</title>
<?php require_once("views/templates/layout/body.php"); 
    require_once("views/templates/layout/navbar.php");?>

<div class="mt-2 container-fluid col-12 col-lg-10 col-xxl-10">
<?php require_once("views/templates/layout/menu.php");?>
        <div class="col-12 col-md-9 col-lg-10 col-profile">
            <div class="mt-2 ml-2 mr-2 text-bg-secondary h-100 barra-profile">

                <div class="row target-profile-user mb-2 text-bg-dark">
                    <div class="col-12 text-center title-user-profile">User information</div>

                    <div class="col-12 col-lg-3 col-md-4 col-sm-5 mb-1 mt-1 text-center image-user-profile">
                        <img class="rounded" src="<?php echo constant('URL').$_SESSION['photo_user'] ?>" alt="img_user">
                    </div>

                    <div class="col-12 col-lg-9 col-md-8 col-sm-7 mb-1 mt-1 info-user-profile">
                        <div class="row col-12">Indentification: <?php echo ($_SESSION['identification_user'])? $_SESSION['identification_user'] : "Not registered" ?></div>
                        <div class="row col-12">User: <?php echo $_SESSION['name_user']." ".$_SESSION['last_name_user'] ?></div>
                        <div class="row col-12">Phone number: <?php echo ($_SESSION['phone_user'])? $_SESSION['phone_user'] : "Not registered" ?></div>
                        <div class="row col-12">Email: <?php echo $_SESSION['email'] ?></div>
                        <?php if($_SESSION['role_id'] == '3'){ ?><div class="row col-12">Administrador: debe ir el nombre del administrador</div><?php } ?>
                    </div>
                    
                    <div class="col-12 text-center footer-user-profile"><?php echo ($_SESSION['last_update_user'])? "Latest information update: ".date_view($_SESSION['last_update_user']) : "The information has not been updated" ?></div>
                </div>

                <!-- ARREGLAR LA VISTA DE LAS GRAFICAS-->
                <div class="row target-graphs-profile">
                    <div class="col-12 col-lg-6 mb-1 mt-1">
                        <div class="row text-bg-dark target-icome-profile">
                            <div class="col-12 text-center title-user-profile">Ingresos</div>
                            <div class="col-12">GRAFICA</div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-1 mt-1">
                        <div class="row text-bg-dark target-expense-profile">
                            <div class="col-12 text-center title-user-profile">Expense</div>
                            <div class="col-12">GRAFICA</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>document.getElementById("profile").className = "active-profile"</script>
<script src="<?php echo constant('URL') ?>views/js/updateNotificationMessages.js"></script>
<?php require_once("views/templates/layout/end.php"); ?>