<div class="container-warning">
    <div class="warning">
        <div class="warning-title">
            <i class="fa-solid fa-triangle-exclamation"></i>
             Unauthorized access
        </div>
        <div class="warning-body">
            <ul>
                <li>You are trying to edit the information of a user who is not authorized</li>
                <li>Press understood to go to edit your profile</li>
            </ul>
        </div>
        <div class="warning-footer">
            <a class="btn btn-success" href="<?php echo constant('URL')?>viewusers/edit/<?php echo $_SESSION['id_user']?>">
                <i class="fa-solid fa-check"></i>
                 Understood
            </a>
        </div>
    </div>
</div>