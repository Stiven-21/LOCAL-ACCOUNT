<?php require_once("views/templates/layout/first.php"); ?>
  <link rel="stylesheet" href="<?php echo constant('URL') ?>views/css/login.css">
  <title>Sign In</title>
<?php require_once("views/templates/layout/body.php"); ?>

<div class="login-box">
  <h2><img class="rounded" style='max-height: 150px' src="<?php echo constant('URL') ?>views/images/icons/graph.png" alt="graph.png"></h2>
  <form action="<?php echo constant('URL') ?>signin/signin" method="POST">
    <div class="user-box">
      <input type="email" name="email" id="email" pleaceholder="example@example.com" autocomplete="off" value="<?php echo $this -> email ?>" required>
      <label><i class="fa-solid fa-user"></i> Username</label>
      <div id="emailHelp" class="form-text"></div>
    </div>
    <div class="user-box">
      <input type="password" name="password" id="password" required>
      <label><i class="fa-solid fa-key"></i> Password</label>
    </div>

    <?php if($this->message != ''){ ?>
      <div id="hidden-alert">
        <div class="alert-login alert">
          <?php echo $this->message ?>
        </div>
      </div>
    <?php } ?>

    <button>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Submit
    </button>
  </form>
</div>

<?php if($this->message != ''){ ?><script src="<?php echo constant('URL') ?>views/js/hiddenAlert.js"></script><?php } ?>

<?php require_once("views/templates/layout/end.php"); ?>