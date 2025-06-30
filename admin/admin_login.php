<?php
include('../includes/connect.php');
include('../functions/funciones varias.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bazar Inicio de sesión de administrador </title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>

<body>

    <!-- Start Landing Section -->
    <div class="landing admin-register">
        <div class="">
            <h2 class="text-center mb-1">Registro de Super Usuario</h2>
            <h4 class="text-center mb-3 fw-light">Ingresa a tu Cuenta</h4>
            <div class="row m-0 align-items-center">
                
                <div class="col-md-6 py-4 px-5 d-flex flex-column gap-4">
                    <div>
                        <form action="" method="post" class="d-flex flex-column gap-4">
                            <div class="form-outline">
                                <label for="username" class="form-label">Usuario</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
                            </div>
                            <div class="form-outline">
                                <label for="password" class="form-label">Constraseña</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your Password" required>
                            </div>
                            <div class="form-outline">
                                <a href="" class="text-2 text-decoration-underline">¿Olvidaste tu contraseña?</a>
                            </div>
                            <div class="form-outline">
                                <input type="submit" value="Login" class="btn btn-primary mb-3" name="admin_login">
                                <p class="small">
                                    ¿Tienes una cuenta? <a href="./admin_resgistration.php" class="text-decoration-underline text-success fw-bold">Registrate</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Landing Section -->

    <script src="../assets/js/bootstrap.bundle.js"></script>
</body>

</html>
<?php
if (isset($_POST['admin_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$username'";
    $select_result = mysqli_query($con, $select_query);
    $row_data = mysqli_fetch_assoc($select_result);
    $row_count = mysqli_num_rows($select_result);
    //user check about username & pass
    if ($row_count > 0) {
        if (password_verify($password, $row_data['admin_password'])) {
            $_SESSION['admin_username'] = $username;
            echo "<script>alert('Inicio de sesión exitoso');</script>";
            echo "<script>window.open('./index.php','_self');</script>";
        } else {
            echo "<script>alert('Credenciales inválidas')</script>";
        }
    } else {
        echo "<script>alert('Usuario no existe')</script>";
    }
}
?>