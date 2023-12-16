<?php require_once("views/templates/layout/first.php"); ?>
    <link rel="stylesheet" href="<?php echo constant('URL') ?>views/css/profile.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>views/css/register.css">
    <title>Profile</title>
<?php require_once("views/templates/layout/body.php"); 
    require_once("views/templates/layout/navbar.php");?>

<div class="mt-2 container-fluid col-12 col-lg-10 col-xxl-10">
<?php require_once("views/templates/layout/menu.php");?>
        <div class="col-12 col-md-9 col-lg-10 col-profile">
            <div class="mt-2 ml-2 mr-2 text-bg-secondary h-100 barra-profile">

                <div class="row">
                    <div class="col-12 mb-2 text-bg-dark title-register">Create new account</div>
                    <div class="col-12 mb-2 text-bg-dark body-register">
                        <div class="row">
                            <div class="col-12 col-md-6 body-register-left">
                                <div class="texto-body-register-left">
                                    You are creating a user, remember that when you save the information the status of the created account will be inactive until the new user logs in and fills in their data
                                </div>
                            </div>
                            <div class="col-12 col-md-6 body-register-rigth">
                                <div class="form-body-register-rigth">
                                    <form action="<?php echo constant('URL') ?>viewusers/register" method="POST">
                                        <div class="row text-center">
                                        <div class="col-12 mt-2">
                                                <span class="title-form">Data account</span>
                                            </div>

                                            <div class="col-12 mb-3 mt-2">
                                                <div class="container-input">
                                                    <input type="email" id="email" value="<?php echo $this -> email ?>" name="email" autocomplete="off" required>
                                                    <span><i class="fa-solid fa-id-card"></i> Email*</span>
                                                    <div id="emailHelp" class="form-text"></div>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-3 mt-2">
                                                <div class="container-input">
                                                    <input type="password" id="password" value="" name="password" autocomplete="off" required>
                                                    <span><i class="fa-solid fa-key"></i> Password*</span>
                                                    <b>
                                                        <input type="checkbox" id="showpassword">
                                                        <label for="showpassword" id="icon-show"><i class="fa-solid fa-eye"></i></label>
                                                    </b>
                                                </div>
                                            </div>

                                            <?php if($_SESSION['role_id'] == '1'){ ?>
                                                <div class="col-12 mb-3 mt-2">
                                                    <select class="form-select text-bg-dark" id="role" name="role" aria-label="Select user role">
                                                        <option <?php if($this->role == 'Select user role'){ ?>selected<?php }?> >Select user role</option>
                                                        <option value="2" <?php if($this->role == '2'){ ?>selected<?php }?> >Administrator</option>
                                                        <option value="3" <?php if($this->role == '3'){ ?>selected<?php }?> >User</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 mb-3 mt-2">
                                                    <select class="form-select bg-dark <?php if($this->role != '3'){ ?>disabled<?php }else{?>enable<?php } ?>" id="add" name="add" aria-label="Select the administrator" <?php if($this->role != '3'){ ?>disabled<?php }?>>
                                                        <option selected>Select the administrator</option>
                                                        <?php include_once 'models/user.php';
                                                            foreach($this->admins as $row){
                                                            $admin = new User();
                                                            $admin = $row;
                                                        ?>
                                                            <option value="<?php echo $admin->id_user; ?>" <?php if($this->add == $admin->id_user) {?>selected<?php } ?>><?php echo $admin->name_user; ?> <?php echo $admin->last_name_user; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <?php } ?>

                                            <div class="mb-4 text-center">
                                                <button type="submit" class="btn btn-primary">Save account details</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php if($this->message != ''){ ?>
                                <div class="col-12 mb-3">
                                    <div class="alert <?php if($this->failed != false){ ?>alert-danger<?php }else{ ?>alert-success<?php } ?> alert-dismissible fade show" role="alert">
                                        <?php echo $this->message ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>document.getElementById("createUser").className = "active-profile"</script>

<script src="<?php echo constant('URL') ?>views/js/validateEmail.js"></script>
<script src="<?php echo constant('URL') ?>views/js/showPassword.js"></script>
<script src="<?php echo constant('URL') ?>views/js/showAdmins.js"></script>
<script src="<?php echo constant('URL') ?>views/js/updateNotificationMessages.js"></script>
<?php require_once("views/templates/layout/end.php"); ?>