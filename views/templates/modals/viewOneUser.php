<!-- Modal -->
<div class="modal fade" id="modal-info-<?php echo $user->id_user; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">User information</h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-6 justify-content-center img-modal-user">
                <img src="<?php echo constant('URL').$user->photo_user ?>" alt="">
            </div>
            <div class="col-6">
                <p>Indentification: <?php echo $user->identification_user ?></p>
                <p>User: <?php echo ($user->name_user)? $user->name_user." ".$user->last_name_user : "Not registered" ?></p>
                <p>Phone number: <?php echo ($user->phone_user)? $user->phone_user : "Not registered" ?></p>
                <p>Role: <?php echo ($user->role_id == "2")? "Administrator" : "User" ?></p>
                <p>Status: <?php switch($user->status_id){case "1": echo "Active"; break; case "2": echo "Inactive"; break; case "3": echo "Blockade"; break; default: "Not registered"; break;} ?></p>
                <p>Latest information update: <?php echo ($user->last_update_user)? date_view($user->last_update_user) : "The information has not been updated" ?></p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="<?php echo constant('URL')."viewusers/edit/".$user->id_user ?>" class="btn btn-success"><i class="fa-solid fa-user-pen"></i></a>
      </div>
    </div>
  </div>
</div>