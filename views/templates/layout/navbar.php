<nav class="navbar navbar-dark navbar-expand-lg bg-dark sticky-top">
    <div class="container-lg">
        <a class="navbar-brand" href="<?php echo constant('URL') ?>">
            <i class="fa-solid fa-chart-simple"></i>
            Local count
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                    <i class="fa-solid fa-chart-simple"></i>
                    Local count
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo constant('URL') ?>index"><i class="fa-solid fa-house"></i>  Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="rounded-circle" height="17px" src="<?php echo constant('URL').$_SESSION['photo_user'] ?>" alt="img_user">
                            <?php echo $_SESSION['name_user']." ".$_SESSION['last_name_user'] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-center">
                            <li>
                                <samp  role="button" tabindex="0" class="dropdown-item"><?php switch($_SESSION['role_id']){ 
                                    case 1: echo "Super admin"; break;
                                    case 2: echo "Administrator"; break;
                                    case 3: echo "User"; break;
                                    default: echo "No registred"; break;
                                 } ?></samp>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?php echo constant('URL') ?>viewusers/profile"><i class="fa-solid fa-user"></i>  Profile</a></li>
                            <li><a class="dropdown-item" href="<?php echo constant('URL') ?>viewusers/logout"><i class="fa-solid fa-right-from-bracket"></i>  Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>