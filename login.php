<?php ob_start(); ?>
<?php session_start();
    #validar datos
    if ($_POST){
      #conexion a la base
      #mail
      #contraseña
      #es_admin s o n 
      /*
      select mail, pass
      from usuarios where
      es_admin = 'S';*/
      /* USUARIOS["mail"] */
        if( ($_POST['email']=="admin") && ($_POST['pass']=='cac') ){
          $_SESSION['usuario']="Admin";
          $_SESSION['logueado']='S';
          #redirecciono porque ingreso ok 
          header("location:index_admin.php");
          die();
         // exit;
        }
        else{
           echo '<script> alert("Usuario y/o Contraseña incorrecta");</script>';
           header("location:index3.php");
          
           die();
        }
    }?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Backend</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
    <a href="index3.php" class="back-link"><i class="fas fa-arrow-left"></i></a>
    
    <div class="login">
        <div class="text-center mb-3">
            <img src="imagenes/1.png" alt="Logo" width="100" height="100" class="img-fluid d-block mx-auto">
        </div>

        <form action="login.php" method="post" class="mt-5">
            <div class="mb-3">
                <input type="text" name="email" id="email" class="form-control" 
                placeholder="Usuario" required>
            </div>

            <div class="mb-3">
                <input type="password" name="pass" id="subject" class="form-control" 
                placeholder="Password" required>
                
                <div class="recuperar-link">
                    <a href="#" class="disabled-link">recuperar contraseña</a>
                </div>
            </div>
                
            <div class="mb-3 mt-5">
                <button type="submit" class="btn btn-block" style="width: 40%; background-color: #5728b7; color: white; border-radius: 5px;">Entrar</button>
            </div>
        </form>
        
    </div>
</body> 
</html>
