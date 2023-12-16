<?php require_once("views/templates/layout/first.php"); ?>
    <link rel="stylesheet" href="<?php echo constant('URL') ?>views/css/profile.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>views/css/menssages.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>views/css/menssagesModal.css">
    <title>Menssages</title>
<?php require_once("views/templates/layout/body.php"); 
    require_once("views/templates/layout/navbar.php");?>

<div class="mt-2 container-fluid col-12 col-lg-10 col-xxl-10">
<?php require_once("views/templates/layout/menu.php");?>
        <div class="col-12 col-md-9 col-lg-10 col-profile">
            <div class="mt-2 ml-2 mr-2 text-bg-secondary h-100 barra-profile">

                <div class="row">
                    <div class="col-12 col-md-4 col-xl-3 target-list-user">
                        <div id="list-users" class="list-users text-bg-dark"> 
                            <div class="new-chat text-end mb-2 mt-1">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newChat">
                                    <i class="fa-solid fa-plus"></i>
                                    <span>New chat</span>
                                </button>
                            </div>
                            <?php include("views/templates/modals/newChat.php");?>

                            <!-- DIV PARA MOSTRAR LOS USUARIOS -->
                            <?php if(count($this->dataChats) > 0) {
                                include_once 'models/user.php';
                                foreach($this->dataChats as $row){
                                $user = new User();
                                $user = $row;
                            ?>
                                <div class="data-user" id="<?php echo $user->id_user ?>">
                                    <div class="img-user">
                                        <img src="<?php echo constant('URL').$user->photo_user ?>" alt="">
                                    </div>
                                    <div class="name-user">
                                        <?php echo $user->name_user ?>
                                    </div>
                                    <div class="notify-message">
                                        <span>99+</span>
                                    </div>
                                </div>
                            <?php }}else{ ?>
                                <div class="not-exist-chat">
                                    <i class="fa-solid fa-message"></i>
                                    You haven't started any conversations
                                </div>
                            <?php } ?>

                            <!-- FIN USUARIOS -->
                        </div>
                    </div>
                    <div class="col-12 col-md-8 col-xl-9 target-description-message">
                        <div class="menssages text-bg-dark">
                            <!-- CONTAINER DE LOS MENSAJES ENVIADOS Y RECIBIDOS-->
                            <div class="container-menssages shadow-lg" id="container-menssages">
                                <!--div class="chat-info-user">
                                    <div class="img-chat-info">
                                        <img src="<?php echo constant('URL').$_SESSION['photo_user'] ?>" alt="">
                                    </div>
                                    <div class="data-chat-info">
                                        <b>NOMBRE USUARIO</b>
                                        <span>ROL DE USUARIO</span>
                                    </div>
                                </div-->
                                

                                <div class="select-one-chat">
                                    <i class="fa-solid fa-comments"></i>
                                    <span>Welcome to the messaging tab, send and receive messages in real time easily and quickly</span>
                                </div>

                            </div>

                            <div class="container-form">
                                <form method="POST" class="d-flex" id="formMessageSend">
                                    <div class="container-input">
                                        <input type="text" id="messageSend" name="messageSend" minlength="0"  maxlength="500" autocomplete="off" required>
                                        <span>Enter your message here</span>
                                    </div>
                                    <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                                    <div id="field-length">0/500</div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>document.getElementById("menssages").className = "active-profile"</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo constant('URL') ?>views/js/countCharacters.js"></script>
<script src="<?php echo constant('URL') ?>views/js/openChat.js"></script>
<script src="<?php echo constant('URL') ?>views/js/menssageUserModal.js"></script>
<script src="<?php echo constant('URL') ?>views/js/sendMessage.js"></script>
<script src="<?php echo constant('URL') ?>views/js/endScroll.js"></script>
<?php require_once("views/templates/layout/end.php"); ?>