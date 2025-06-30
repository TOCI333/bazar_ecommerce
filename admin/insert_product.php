<?php
include('../includes/connect.php');
if(isset($_POST['insert_product'])){
    $product_title=$_POST['product_title'];
    $product_description=$_POST['product_description'];
    $product_keywords=$_POST['product_keywords'];
    $product_category=$_POST['product_category'];
    $product_brand=$_POST['product_brand'];
    $product_precio=$_POST['product_precio'];
    $product_status='true';
    //access images
    $product_image_uno=$_FILES['product_image_uno']['name'];
    $product_image_dos=$_FILES['product_image_dos']['name'];
    $product_image_tres=$_FILES['product_image_tres']['name'];
    //access images tmp name
    $temp_image_one=$_FILES['product_image_uno']['tmp_name'];
    $temp_image_two=$_FILES['product_image_dos']['tmp_name'];
    $temp_image_three=$_FILES['product_image_tres']['tmp_name'];
    //checking empty condition
    if($product_title == '' || $product_description == '' || $product_keywords == '' || $product_category == '' || $product_brand == '' || empty($product_precio) || empty($product_image_uno) || empty($product_image_dos) || empty($product_image_tres)){
        echo "<script>alert(\"Fields should not be empty\");</script>";
        exit();
    }else{
        //move folders
        move_uploaded_file($temp_image_one,"./product_images/$product_image_uno");
        move_uploaded_file($temp_image_two,"./product_images/$product_image_dos");
        move_uploaded_file($temp_image_three,"./product_images/$product_image_tres");
        //insert query in db
        $insert_query = "INSERT INTO `products` (product_title,product_description,product_keywords,category_id,brand_id,product_image_uno,product_image_dos,product_image_tres,product_precio,date,status) VALUES ('$product_title','$product_description','$product_keywords','$product_category','$product_brand','$product_image_uno','$product_image_dos','$product_image_tres','$product_precio',NOW(),'$product_status')";
        $insert_result=mysqli_query($con,$insert_query);
        if($insert_result){
        echo "<script>alert(\"Product Inserted Successfully\");</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Productos</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>

<body>
    <div class="container py-4 px-2">
        <div class="categ-header text-center mb-4">
            <!-- <div class="sub-title">
                    <span class="shape"></span>
                    <span class="title">Admin Dashboard</span>
                </div> -->
            <h2>Insert Products</h2>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <!-- title -->
                    <div class="form-outline mb-4">
                        <label for="product_title" class="form-label">Título del Producto</label>
                        <input type="text" placeholder="Enter Product Title" name="product_title" id="product_title" class="form-control" autocomplete="off" required>
                    </div>
                    <!-- description -->
                    <div class="form-outline mb-4">
                        <label for="product_description" class="form-label">Descripción del Producto</label>
                        <input type="text" placeholder="Enter Product Description" name="product_description" id="product_description" class="form-control" autocomplete="off" required>
                    </div>
                    <!-- keywords -->
                    <div class="form-outline mb-4">
                        <label for="product_keywords" class="form-label">Palabras Clave del Producto</label>
                        <input type="text" placeholder="Enter Product Keywords" name="product_keywords" id="product_keywords" class="form-control" autocomplete="off" required>
                    </div>
                    <!-- categories -->
                    <div class="form-outline mb-4">
                        <select class="form-select" name="product_category" id="product_category">
                            <option selected disabled>Selecciona una Categoría</option>
                            <?php
                            $select_query = 'SELECT * FROM `categories`';
                            $select_result = mysqli_query($con, $select_query);
                            while ($row = mysqli_fetch_assoc($select_result)) {
                                $category_title = $row['category_title'];
                                $category_id = $row['category_id'];
                                echo "
                                        <option value='$category_id'>$category_title</option>
                                        ";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- brands -->
                    <div class="form-outline mb-4">
                        <select class="form-select" name="product_brand" id="product_brand">
                            <option selected disabled>Selecciona una Marca</option>
                            <?php
                            $select_query = 'SELECT * FROM `brands`';
                            $select_result = mysqli_query($con, $select_query);
                            while ($row = mysqli_fetch_assoc($select_result)) {
                                $brand_title = $row['brand_title'];
                                $brand_id = $row['brand_id'];
                                echo "
                                        <option value='$brand_id'>$brand_title</option>
                                        ";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Image one -->
                    <div class="form-outline mb-4">
                        <label for="product_image_uno" class="form-label">Imagen del producto uno</label>
                        <input type="file" name="product_image_uno" id="product_image_uno" class="form-control" required>
                    </div>
                    <!-- Image two -->
                    <div class="form-outline mb-4">
                        <label for="product_image_dos" class="form-label">Imagen del producto dos</label>
                        <input type="file" name="product_image_dos" id="product_image_dos" class="form-control" required>
                    </div>
                    <!-- Image three -->
                    <div class="form-outline mb-4">
                        <label for="product_image_tres" class="form-label">Imagen del producto tres</label>
                        <input type="file" name="product_image_tres" id="product_image_tres" class="form-control" required>
                    </div>
                    <!-- Price -->
                    <div class="form-outline mb-4">
                        <label for="product_precio" class="form-label">Precio del Producto</label>
                        <input type="number" placeholder="Ingrese el Precio del Producto" name="product_precio" id="product_precio" class="form-control" autocomplete="off" required>
                    </div>
                    <!--  -->
                    <div class="form-outline mb-4">
                        <input type="submit" value="Insertar Producto" name="insert_product" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>