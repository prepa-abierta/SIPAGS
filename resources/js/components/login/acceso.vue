<template>
    <div class="container-fluid ">
        <div>
            <div class="d-flex row justify-content-center">
                <div class=" col-md-4">
                    <form id="formulario" action="" method="post">
                        <div class="head">
                            <img src="imagenes/prepalogo.png" alt="logo_index" class="img-responsive">
                        </div>
                        <div class="contenido_form">
                            <h2>INGRESO AL SIPAG</h2>
                            <label for="usuario">Usuario</label>
                            <div class="form-group has-feedback">
                                <i class="fa fa-user form-control-feedback"></i>
                                <input id="usuario" type="text" name="usuario" class="form-control" placeholder="Email@ejemplo.com">
                            </div>
                            <label for="password">Contraseña</label>
                            <div class="form-group has-feedback">
                                <i class="fas fa-lock form-control-feedback"></i>
                                <input id="password" type="password" name="password" class="form-control" placeholder="Contraseña">
                            </div>
                            <button type="button" class="btn btn-info" name="button">Acceder</button>
                            <hr>
                            <a href="#" class="text-center">Recuperar contraseña</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </div>
</template>




