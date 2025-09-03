<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="<?= media() ?>/css/login.css">
  <link rel="stylesheet" type="text/css" href="<?= media() ?>/css/main.css">
</head>

<body>

  <div class="login-root">
    <!-- FONDO ANIMADO -->
    <div class="loginbackground box-background--white padding-top--64">
      <div class="loginbackground-gridContainer">
        <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
          <div class="box-root" style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;">
          </div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
          <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;"></div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
          <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
          <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
          <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;"></div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
          <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
          <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
          <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
        </div>
        <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
          <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;"></div>
        </div>
      </div>
    </div>

    <!-- FORMULARIOS ENCIMA DEL FONDO -->
    <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 10;">
      <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
        <h1>Bienvenido a Educka</h1>
      </div>

      <div class="formbg-outer">
        <div class="formbg">
          <div class="formbg-inner padding-horizontal--48">
            <span class="padding-bottom--15">Inicia sesión en tu cuenta</span>

            <!-- FORMULARIO LOGIN -->
            <form id="formlogin" name="formlogin">
              <div class="field padding-bottom--24">
                <label for="txtemail">Correo electrónico</label>
                <input type="email" id="txtemail" name="txtemail" placeholder="tucorreo@ejemplo.com" required>
              </div>

              <div class="field padding-bottom--24">
                <div class="grid--50-50">
                  <label for="txtpassword">Contraseña</label>
                  <div class="reset-pass">
                    <a href="#" data-toggle="flip">¿Olvidaste tu contraseña?</a>
                  </div>
                </div>
                <input type="password" id="txtpassword" name="txtpassword" placeholder="********" required>
              </div>

              <div class="field padding-bottom--24">
                <input type="submit" name="submit" value="Ingresar">
              </div>

              <div class="field">
                <div id="g_id_onload"
                  data-client_id="196182658810-gri5vaek708sgnukf8rov1ke9i7iu62d.apps.googleusercontent.com"
                  data-context="signin"
                  data-ux_mode="popup"
                  data-callback="handleCredentialResponse"
                  data-auto_prompt="false">
                </div>

                <div class="g_id_signin"
                  data-type="standard"
                  data-shape="pill"
                  data-theme="outline"
                  data-text="signin_with"
                  data-size="large"
                  data-logo_alignment="left">
                </div>

                <div id="status"></div>
              </div>

            </form>

            <!-- FORMULARIO RECUPERAR CONTRASEÑA -->
            <form id="formresetpassword" name="formresetpassword" style="display:none;">
              <div class="field padding-bottom--24">
                <label for="txtemailreset">Correo electrónico</label>
                <input type="email" id="txtemailreset" name="txtemailreset" placeholder="tucorreo@ejemplo.com" required>
              </div>
              <div class="field">
                <input type="submit" value="Reiniciar">
              </div>
              <div class="field">
                <a href="#" data-toggle="flip">Iniciar Sesión</a>
              </div>
            </form>

          </div>
        </div>

        <div class="footer-link padding-top--24">
          <span>¿No tienes cuenta? <a href="registro.php">Regístrate</a></span>
          <div class="listing padding-top--24 padding-bottom--24 flex-flex center-center">
            <span><a href="#">© TuSistema</a></span>
            <span><a href="#">Contacto</a></span>
            <span><a href="#">Política de privacidad</a></span>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Base URL -->
  <script>
    const baseurl = "<?= base_url(); ?>";
  </script>

  <!-- JS -->
  <script src="<?= media() ?>/js/jquery-3.3.1.min.js"></script>
  <script src="<?= media() ?>/js/popper.min.js"></script>
  <script src="<?= media() ?>/js/bootstrap.min.js"></script>
  <script src="<?= media() ?>/js/main.js"></script>
  <script src="<?= media() ?>/js/fontawesome.js"></script>
  <script type="text/javascript" src="<?= media() ?>/js/plugins/sweetalert.min.js"></script>
  <script src="<?= media() ?>/js/functions/<?= $data['page_functions_js'] ?>"></script>

  <!-- JS para mostrar/ocultar formularios -->
  <script>

    document.querySelectorAll('[data-toggle="flip"]').forEach(el => {
      el.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('#formlogin').style.display =
          document.querySelector('#formlogin').style.display === 'none' ? 'block' : 'none';
        document.querySelector('#formresetpassword').style.display =
          document.querySelector('#formresetpassword').style.display === 'none' ? 'block' : 'none';
      });
    });
  </script>



  <!-- inicio de sesion google functiongoogle -->
  

  <script src="https://accounts.google.com/gsi/client"></script>
  <script src="<?= media() ?>/js/functions/functiongoogle.js"></script>
</body>

</html>