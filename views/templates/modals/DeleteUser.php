<!-- Modal -->
<div class="modal fade bg-danger-40" id="modal-delete-<?php echo $user->id_user; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-triangle-exclamation"></i> Alert</h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete the user <?php echo ($user->phone_user)? $user->phone_user : "Does not record names and surnames" ?>, c.c. <?php echo $user->identification_user ?>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancel</button>
        <a href="<?php echo constant('URL')."viewusers/delete/".$user->id_user ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Yes, delete</a>
      </div>
    </div>
  </div>
</div>