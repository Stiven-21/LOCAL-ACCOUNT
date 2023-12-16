<div class="row mt-4">
        <div class="col-12 col-md-3 col-lg-2 col-barra-profile">
            <div class="mt-2 ml-2 mr-2 text-bg-dark h-100 barra-profile">
                <div class="title-barra-profile">Menu</div>
                <div class="container-barra-profile">
                    <a href="<?php echo constant('URL')?>viewusers/profile" id="profile">
                        <i class="fa-solid fa-user"></i> 
                        <b class="text-hidden-profile">Profile</b>
                    </a>
                    <a href="<?php echo constant('URL')?>viewusers/edit/<?php echo $_SESSION['id_user']?>" id="edit">
                        <i class="fa-solid fa-pen"></i> 
                        <b class="text-hidden-profile">Edit</b>
                    </a>
                    <?php if($_SESSION['role_id'] == '1' || $_SESSION['role_id'] == '2'){ ?>
                    <a href="<?php echo constant('URL')?>viewusers/register" id="createUser">
                        <i class="fa-solid fa-user-plus"></i> 
                        <b class="text-hidden-profile">Create user</b>
                    </a>
                    <a href="<?php echo constant('URL')?>viewusers/all" id="all">
                        <i class="fa-solid fa-users"></i> 
                        <b class="text-hidden-profile">View users</b>
                    </a>
                    <?php } ?>
                    <a class="message-notification" href="<?php echo constant('URL')?>viewusers/menssages" id="menssages">
                        <i class="fa-solid fa-message"></i> 
                        <b class="text-hidden-profile">Messages</b>
                    </a>
                </div>
            </div>
        </div>