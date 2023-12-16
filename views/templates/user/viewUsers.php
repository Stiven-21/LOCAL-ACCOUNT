<?php require_once("views/templates/layout/first.php"); ?>
    <link rel="stylesheet" href="<?php echo constant('URL') ?>views/css/font.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>views/css/images.css">
    <title>Views Users</title>
<?php require_once("views/templates/layout/body.php"); 
    require_once("views/templates/layout/navbar.php");?>


    <!--img src="<php echo constant('URL') ?>views/images/images/photo_user_default.png" alt=""-->
    <div class="mt-2 container-fluid col-12 col-lg-11 col-xxl-10">
        <figure class="text-center">
            <blockquote class="blockquote">
                <p class="text-title-page">Registered users</p>
            </blockquote>
        </figure>
        <table class="table text-center align-middle">
            <thead>
                <tr class="table-dark">
                    <th scope="col">Identification</th>
                    <th scope="col">Photo</th>
                    <th scope="col">User</th>
                    <th scope="col">role</th>
                    <th scope="col">Status</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($this->allUsers) > 0) {?>
                    <?php include_once 'models/user.php';
                        foreach($this->allUsers as $row){
                        $user = new User();
                        $user = $row;
                    ?>
                        <tr <?php if($user->status_id == "1"){ ?>class="table-success"<?php }else{ ?>class="table-danger"<?php } ?> >
                            <th scope="row"><?php echo $user->identification_user ?></th>
                            <td><img class="mini_photo_user" src="<?php echo constant('URL').$user->photo_user ?>" alt="user_photo"></td>
                            <td><?php echo $user->name_user; ?> <?php echo $user->last_name_user; ?></td>
                            <td><?php if($user->role_id == "2"){ ?>Administrator<?php }else{ ?>User<?php } ?></td>
                            <td><?php if($user->status_id == "1"){ ?>Active<?php }else{ ?>Inactive<?php } ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="<?php echo constant('URL')."viewusers/edit/".$user->id_user ?>" class="btn btn-success"><i class="fa-solid fa-user-pen"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fa-solid fa-user-xmark"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                <?php }else{ ?>
                    <tr class="table-info">
                        <td colspan="6">No user has registered</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
        
<?php require_once("views/templates/layout/end.php"); ?>