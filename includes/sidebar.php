
<?php require_once 'includes/helpers.php'; ?>

<aside id="sidebar">
<?php if(isset($_SESSION['usuario'])): ?>
    <div id="usuario-logueado" class="bloque">
        <h3>Bienvenido, <?php echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?>  </h3>
        <?php //var_dump($_SESSION['usuario']); ?>
        <!--Botones-->
        <a href="cerrar.php" class="boton">Cerrar Session</a><br>
        <a href="cerrar.php" class="boton">Crear categoria</a><br>
        <a href="cerrar.php" class="boton">Crear entradas</a><br>
        <a href="cerrar.php" class="boton">Editar datos</a>
        
    </div>
<?php endif; ?>


            <!-- LOGIN -->
            <div id="login" class="bloque">

                <?php if(isset($_SESSION['erro_login'])): ?>
                    <div class="alerta alerta-error">
                        <h3><?php echo $_SESSION['erro_login'];  ?></h3>
                        <?php //var_dump($_SESSION['usuario']); ?>
                    </div>
                <?php endif; ?>

                <h3>Identificate</h3>


                

                <form action="login.php" method="POST">
                    <label for="email">Email</label>
                    <input type="email" name="email"/>

                    <label for="password">Password</label>
                    <input type="password" name="password"/>

                    <input type="submit" value="Entrar">

                </form>
            </div>
            <!-- REGISTRO -->
            <div id="register" class="bloque">
                
                <h3>Registrate</h3>

                <!--Mostrar errores-->
                <?php
                if(isset($_SESSION['completado'])) : ?>
                    <div class="alerta alerta-exitO">
                            <h3><?php echo $_SESSION['completado'] ?></h3>
                    </div>
                
                <?php elseif(isset($_SESSION['errores']['general'])): ?>
                    <div class="alerta alerta-error">
                            <?php $_SESSION['errores']['general'] ?>
                    </div>
                <?php endif; ?>
                <form action="registro.php" method="POST">

                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre"/>
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos"/>
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

                    <label for="email">Email</label>
                    <input type="email" name="email"/>
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

                    <label for="password">Password</label>
                    <input type="password" name="password"/>
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>
                    

                    <input type="submit" name="submit" value="Registrar">

                </form>
                
            </div>

        </aside>