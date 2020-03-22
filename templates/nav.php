

<nav class="col navbar navbar-expand-md navbar-dark ">
                
                <button class="navbar-toggler ml-auto mr-5" 
                        type="button" 
                        data-toggle="collapse" 
                        data-target="#barra" 
                        aria-controls="barra" 
                        aria-expanded="false" 
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="barra">
                    <ul class="navbar-nav text-center ml-auto">
                        <li class="nav-item">
                            <a class="nav-link"  href="index.php?s=home"
                            >Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="index.php?s=productos"   >Productos</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link"  href="index.php?s=contacto"  >Contacto</a>
                        </li>

                        <?php
                        if(!isset($_SESSION['id_usuario'])):
                        ?>
                        <li class="nav-item">
                            <a class="nav-link"  href="index.php?s=login"  >Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="index.php?s=registro"  >Registro</a>
                        </li>
                            <?php
                        else:
                            ?>
                            <li class="nav-item">
                                <a class="nav-link"  href="index.php?s=perfil"  >Mi Perfil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="index.php?s=carrito"  >Carrito</a>
                            </li>

                        <?php
                        endif;
                        ?>
                    </ul>
                </div>
            </nav>

