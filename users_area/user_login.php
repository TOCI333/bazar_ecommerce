<?php
include('../includes/connect.php');
include('../functions/funciones varias.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion o Registrate</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>

<body>

    <div class="register">
        <div class="container py-3">
            <h2 class="text-center mb-4">Inicia Sesión o Registrate</h2>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form action="" method="post" class="d-flex flex-column gap-4">
                        <!-- username field  -->
                        <div class="form-outline">
                            <label for="user_username" class="form-label">Nombre de Usuario</label>
                            <input type="text" placeholder="Ingresa tu nombre de usuario" autocomplete="off" required="required" name="user_username" id="user_username" class="form-control">
                        </div>
                        <!-- password field  -->
                        <div class="form-outline">
                            <label for="user_password" class="form-label">Contraseña</label>
                            <input type="password" placeholder="Ingresa tu contraseña" autocomplete="off" required="required" name="user_password" id="user_password" class="form-control">
                        </div>
                        <div><a href="" class="text-decoration-underline">¿Olvidaste tu contraseña?</a></div>
                        <div>
                            <input type="submit" value="Iniciar Sesión" class="btn btn-primary mb-2" name="user_login">
                            <p>
                                No tienes una cuenta? <a href="user_registration.php" class="text-primary text-decoration-underline"><strong>Registrarse</strong></a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets//js/bootstrap.bundle.js"></script>
</body>

</html>
<?php
if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    $select_result = mysqli_query($con, $select_query);
    $row_data = mysqli_fetch_assoc($select_result);
    $row_count = mysqli_num_rows($select_result);
    $user_ip = getIPAddress();
    //check if user have items |! -> redirect to payment | index 
    $select_cart_query = "SELECT * FROM `card_details` WHERE ip_address='$user_ip'";
    $select_cart_result = mysqli_query($con, $select_cart_query);
    $row_cart_count = mysqli_num_rows($select_cart_result);
    //user check about username & pass
    if ($row_count > 0) {
        if (password_verify($user_password, $row_data['user_password'])) {
            // echo "<script>alert('Login Successfully')</script>";
            $_SESSION['username'] = $user_username;
            if ($row_count == 1 && $row_cart_count == 0) {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Inicio de Sesión Exitosa');</script>";
               // echo "<script>window.open('profile.php','_self');</script>";
            } else if ($row_count == 1 && $row_cart_count > 0) {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Inicio de Sesión Exitosa');</script>";
                echo "<script>window.open('index.php.php','_self');</script>";
            }
        } else {
            echo "<script>alert('Credenciales inválidas')</script>";
        }
    } else {
        echo "<script>alert('Credenciales inválidas')</script>";
    }
}
?>