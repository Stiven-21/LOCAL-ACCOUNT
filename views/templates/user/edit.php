<?php require_once("views/templates/layout/first.php"); ?>
    <link rel="stylesheet" href="<?php echo constant('URL') ?>views/css/profile.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>views/css/notAccess.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>views/css/edit.css">
    <title>Profile</title>
<?php require_once("views/templates/layout/body.php"); 
    require_once("views/templates/layout/navbar.php");?>

<?php foreach($this->dataUser as $user)?>
<?php foreach($this->dataAccount as $account)?>

<div class="mt-2 container-fluid col-12 col-lg-10 col-xxl-10">
<?php require_once("views/templates/layout/menu.php");?>
        <div class="col-12 col-md-9 col-lg-10 col-profile">
            <div class="mt-2 ml-2 mr-2 text-bg-secondary h-100 barra-profile">
                <?php if(($_SESSION['role_id'] == '2' && $_SESSION['id_user'] != $this->id_url && $_SESSION['id_user'] != $user->admin_of_user_id ) || ($_SESSION['role_id'] == '3' && $_SESSION['id_user'] != $this->id_url)){ require_once("views/templates/failed/UnauthorizedEditAccess.php"); }else{ ?>
                    <?php $_SESSION['id_url'] = $this->id_url;
                        $_SESSION['temp_user'] = $user -> id_user; 
                        $_SESSION['id_temp'] = $user -> identification_user;
                        $_SESSION['name_temp'] = $user -> name_user;
                        $_SESSION['lastname_temp'] = $user -> last_name_user;
                        $_SESSION['phone_temp'] = $user -> phone_user;
                        $_SESSION['photo_temp'] = $user -> photo_user;
                        $_SESSION['temp_account'] = $account -> id_account;
                        $_SESSION['email_temp'] = $account -> email_account;
                    ?>
                    <div class="row target-edit">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row">
                                <div class="col-12 target-title-edit">
                                    Edit user information  
                                </div>
                                <div class="col-12 target-body-edit">
                                    <form id="formDataUser" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="mb-2 mt-1">
                                                    <input type="file" accept="image/*" id="file" name="file">
                                                    <label for="file" class="label">
                                                        <i class="fa-solid fa-image"></i>
                                                        Choose a file
                                                    </label>
                                                </div>
                                                <div class="mb-2 mt-1 show-image-edit">
                                                    <img src="<?php echo constant('URL').$user -> photo_user ?>" alt="img_user" id="preview" >
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="row mb-2 mt-1">
                                                    <div class="col-12 mb-3 mt-2">
                                                        <div class="container-input">
                                                            <input type="text" id="name" value="<?php echo $user->name_user; ?>" name="name" autocomplete="off" required>
                                                            <span><i class="fa-solid fa-user"></i> Name</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3 mt-2">
                                                        <div class="container-input">
                                                            <input type="text" id="last_name" value="<?php echo $user->last_name_user; ?>" name="last_name" autocomplete="off" required>
                                                            <span><i class="fa-solid fa-user"></i> Last name</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3 mt-2">
                                                        <div class="container-input">
                                                            <input type="number" id="identification" value="<?php echo $user->identification_user; ?>" name="identification" autocomplete="off" required>
                                                            <span><i class="fa-solid fa-id-card"></i> Identification</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3 mt-2">
                                                        <div class="container-input">
                                                            <input type="number" id="phone_number" value="<?php echo $user->phone_user; ?>" name="phone_number" autocomplete="off" required>
                                                            <span><i class="fa-solid fa-phone"></i> Phone number</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 text-center mb-3">
                                                <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 target-footer-edit">
                                    Last update: <?php echo ($user->last_update_user)? date_view($user->last_update_user) : "The information has not been updated" ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row">
                                <div class="col-12 target-title-edit">
                                    Edit account information
                                </div>
                                <div class="col-12 target-body-edit">
                                    <form id="formDataAccount" method="POST">
                                        <div class="row text-center">
                                            <div class="col-12 mb-3 mt-2">
                                                <div class="container-input">
                                                    <input type="email" id="email" value="<?php echo $account->email_account; ?>" name="email" autocomplete="off" required>
                                                    <span><i class="fa-solid fa-id-card"></i> Email</span>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-3 mt-2">
                                                <div class="container-input">
                                                    <input type="password" id="password" value="" name="password" autocomplete="off">
                                                    <span><i class="fa-solid fa-key"></i> Password</span>
                                                    <b>
                                                        <input type="checkbox" id="showpassword">
                                                        <label for="showpassword" id="icon-show"><i class="fa-solid fa-eye"></i></label>
                                                    </b>
                                                </div>
                                            </div>

                                            <div class="col-12 text-center mb-3">
                                                <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 target-footer-edit">
                                    Last connection:<?php echo ($account->last_connection_account)? date_view($account->last_connection_account) : "The information has not been updated" ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="alertpreview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-bg-danger">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-triangle-exclamation"></i> Error loading image</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="info-modal-body"></div>
            </div>
        </div>
    </div>
</div>
<?php require_once("views/templates/modals/showAlertEdit.php") ?>
<?php if(($_SESSION['role_id'] == '2' && $_SESSION['id_user'] != $this->id_url && $_SESSION['id_user'] != $user->admin_of_user_id ) || ($_SESSION['role_id'] == '3' && $_SESSION['id_user'] != $this->id_url)){}else{ ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo constant('URL') ?>views/js/saveDataEdit.js"></script>
    <script src="<?php echo constant('URL') ?>views/js/showPassword.js"></script>
    <script src="<?php echo constant('URL') ?>views/js/onlyNumbers.js"></script>
    <script src="<?php echo constant('URL') ?>views/js/previewImage.js"></script>
<?php } ?>

<script>document.getElementById("edit").className = "active-profile"</script>
<script src="<?php echo constant('URL') ?>views/js/updateNotificationMessages.js"></script>
<?php require_once("views/templates/layout/end.php"); ?>