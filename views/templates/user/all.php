<?php require_once("views/templates/layout/first.php"); ?>
    <link rel="stylesheet" href="<?php echo constant('URL') ?>views/css/profile.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>views/css/all.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>views/css/images.css">
    <title>Views Users</title>
<?php require_once("views/templates/layout/body.php"); 
    require_once("views/templates/layout/navbar.php");?>

<div class="mt-2 container-fluid col-12 col-lg-10 col-xxl-10">
    <?php require_once("views/templates/layout/menu.php");?>
        <div class="col-12 col-md-9 col-lg-10 col-profile">
            <div class="mt-2 ml-2 mr-2 text-bg-secondary h-100 barra-profile">
                <div class="row">
                    <div class="col-12 text-center text-title-page">
                        <b class="text-bg-dark">Registered users</b>
                    </div>

                    <div class="col-12">
                        <div class="text-bg-dark rounded body-table-all">
                            <div class="row justify-content-center">
                                <div class="col-12 col-xl-8 col-md-10 mb-2">
                                    <form class="d-flex" role="search" method="POST">

                                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        
                                        
                                        
                                    </form>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 text-end">
                                            <button class="btn btn-outline-light" id="list"><i class="fa-solid fa-list"></i></button>
                                            <button class="btn btn-light" id="grid"><i class="fa-solid fa-grip"></i></button>
                                        </div>
                                        <div class="col-12">
                                            <div class="row bar-users">
                                                <?php if(count($this->allUsers) > 0) {?>
                                                    <?php include_once 'models/user.php';
                                                        foreach($this->allUsers as $row){
                                                        $user = new User();
                                                        $user = $row;
                                                    ?>
                                                        <div class="mode col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                                                            <div class="target-users mode-grid">
                                                                <div class="title-target-users"><i class="fa-solid fa-id-card"></i> <?php echo $user->identification_user ?></div>
                                                                <div class="body-target-users">
                                                                    <div class="img-body-target-users">
                                                                        <img src="<?php echo constant('URL').$user->photo_user ?>" alt="">
                                                                    </div>
                                                                    <div class="info-body-target-users">
                                                                        <span class="show-user-id"><i class="fa-solid fa-id-card"></i> <?php echo $user->identification_user ?></span>
                                                                        <span> <?php echo ($user->name_user)? $user->name_user." ".$user->last_name_user : "Not registered" ?></span>
                                                                        <span> <?php echo ($user->role_id == "2")? "Administrator" : "User" ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="footer-target-users">
                                                                    <button class="btn-target btn-target-info" data-bs-toggle="modal" data-bs-target="#modal-info-<?php echo $user->id_user ?>"><i class="fa-solid fa-eye"></i></button>
                                                                    <button class="btn-target btn-target-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-<?php echo $user->id_user ?>"><i class="fa-solid fa-user-xmark"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php include("views/templates/modals/DeleteUser.php");?>
                                                        <?php include("views/templates/modals/viewOneUser.php");?>
                                                    <?php } ?>
                                                <?php }else{ ?>
                                                    <div class="col-12">No user has registered</div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                        <nav aria-label="Page text-bg-dark navigation example">
                                            <ul class="pagination justify-content-center">
                                                <li class="page-item disabled">
                                                    <a class="page-link">Previous</a>
                                                </li>
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#">Next</a>
                                                </li>
                                            </ul>
                                            </nav>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>document.getElementById("all").className = "active-profile";</script>
<script src="<?php echo constant('URL') ?>views/js/ListOrTargetUsers.js"></script>
<script src="<?php echo constant('URL') ?>views/js/updateNotificationMessages.js"></script>
<?php require_once("views/templates/layout/end.php"); ?>