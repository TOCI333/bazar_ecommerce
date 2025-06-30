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
    <title>Admin Registro</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>

<body>

    <!-- Start Landing Section -->
    <div class="landing admin-register">
        <div class="">
            <h2 class="text-center mb-1">Registro de Admin</h2>
            <h4 class="text-center mb-3 fw-light">Crea una cuenta</h4>
            <div class="row m-0">
               
                <div class="col-md-6 py-4 px-5 d-flex flex-column gap-4">
                    <div>
                        <form action="" method="post" class="d-flex flex-column gap-4" enctype="multipart/form-data">
                            <div class="form-outline">
                                <label for="username" class="form-label">Nombre de Usuario</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Ingrese su nombre de usuario" required>
                            </div>
                            <div class="form-outline">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese su correo electrónico" required>
                            </div>
                            <div class="form-outline">
                                <label for="admin_image" class="form-label">Admin Imagen</label>
                                <input type="file" name="admin_image" id="admin_image" class="form-control" required>
                            </div>
                            <div class="form-outline">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese su Contraseña" required>
                            </div>
                            <div class="form-outline">
                                <label for="conf_password" class="form-label">Confirmar Contraseña</label> 
                                <input type="password" name="conf_password" id="conf_password" class="form-control" placeholder="Confirmar Contraseña" required>
                            </div>
                            <div class="form-outline">
                                <input type="submit" value="Registrar" class="btn btn-primary mb-3" name="admin_register">
                                <p class="small">
                                    ¿Ya tienes una cuenta? <a href="./admin_login.php" class="text-decoration-underline text-success fw-bold">Iniciar Sesión</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Landing Section -->





    <!-- Start Footer -->
    <!-- <div class="upper-nav primary-bg p-2 px-3 text-center text-break">
        <span>All CopyRight &copy;2023</span>
    </div> -->
    <!-- End Footer -->

    <script src="../assets/js/bootstrap.bundle.js"></script>
</body>

</html>
<!-- php code  -->
<?php
if (isset($_POST['admin_register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash_password = password_hash($password,PASSWORD_DEFAULT);
    $conf_password = $_POST['conf_password'];
    $image = $_FILES['admin_image']['name'];
    $image_tmp = $_FILES['admin_image']['tmp_name'];
    // check if user exist or not
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$username' OR admin_email='$email'";
    $select_result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($select_result);
    if ($rows_count > 0) {
        echo "<script>window.alert('Username | Email already exist');</script>";
    } else if ($password != $conf_password) {
        echo "<script>window.alert('Passwords are not match');</script>";
    } else {
        // insert query
        move_uploaded_file($image_tmp, "./admin_images/$image");
        $insert_query = "INSERT INTO `admin_table` (admin_name,admin_email,admin_image,admin_password) VALUES ('$username','$email','$image','$hash_password')";
        $insert_result = mysqli_query($con, $insert_query);
        if ($insert_result) {
            echo "<script>window.alert('Admin added successfully');</script>";
        } else {
            die(mysqli_error($con));
        }
    }
}
?>