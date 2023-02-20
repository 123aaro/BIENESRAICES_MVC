
<main class="contenedor seccion contenido-centrado">
        <h1 data-cy="heading-login">Iniciar sesión</h1>

        <?php foreach($errores as $error): ?>
            <div data-cy="alerta-login" class="alerta error"><?php echo $error; ?></div>
        <?php endforeach; ?>

        <form data-cy="formulario-login" method="POST" class="formulario"  action="/login"> <!--con no validate desactivas la validación automatica al momento del submit-->
        <fieldset>
                <legend>Email y password</legend>
                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu email" id="email" >
                
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu password" id="telefono" >
            </fieldset>

            <input type="submit" value="Iniciar sesión" class="boton boton-verde">
        </form>
         
    </main>