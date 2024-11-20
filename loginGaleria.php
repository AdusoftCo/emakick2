<?php 
ob_start(); 
session_start();

#validar datos
if ($_POST){
    
    if ($_POST['role'] == "admin" && $_POST['password']=='cac') {
        $_SESSION['usuario']="Admin";
        $_SESSION['logueado']='S';
        #redirecciono porque ingreso ok 
        
        # Return success response for AJAX
        echo 'success';
        
        // Stop further script execution
        exit;
    } else {
    # Return error response for AJAX
        echo 'error';
        
        // Stop further script execution
        exit;
    }
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Galeria Feria Sol</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <style>
        #error-message {
            /* Adjust the height to fit your design   */
            min-height: 55px;
            color: red;
        }
    </style>
</head>

<body>
    <a href="galeriaSol.php" class="back-link"><i class="fas fa-arrow-left"></i></a>
    
    <div class="login">
        <div class="text-center mb-3">
            <img src="imagenes/apple.jpg" alt="Logo" width="100" height="100" class="img-fluid d-block mx-auto">
        </div>

        <form id="login-form" method="post" class="mt-5">
            <div class="mb-3">
                <input type="text" name="role" id="role" class="form-control" 
                placeholder="Usuario" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" id="password" class="form-control" 
                placeholder="Password" required>
                
                <div class="recuperar-link">
                    <a href="#" class="disabled-link">recuperar contraseña</a>
                </div>
            </div>
                
            <div class="mb-3 mt-5">
                <button type="submit" class="btn btn-block" style="width: 55%; background-color: #5728b7; color: white; border-radius: 25px;">Entrar</button>
            </div>
        </form>

        <p id="error-message" class="mb-0"></p>
        
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#login-form').on('submit', function(e) {
                e.preventDefault();  // Prevent the form from refreshing the page
                
                // Gather form data
                var role = $('#role').val();
                var password = $('#password').val();
                
                // Send AJAX request to the server
                $.ajax({
                    url: 'loginGaleria.php',  // Your PHP login processing file
                    method: 'POST',
                    data: { role: role, password: password },
                    success: function(response) {
                        if(response == 'success') {
                            window.location.href = 'loginAdmin.php';  // Redirect on successful login
                        } else {
                            $('#error-message').text("Usuario y/o Contraseña Incorrecta !!");
                            window.scrollTo(0, 0);  // Keep the page at the top
                              // Prevent page jumps e.preventDefault();
                        }
                    }
                });
            });
        });
    </script>

</body> 
</html>
