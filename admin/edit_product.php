<?php
    // fetch all data
    if(isset($_GET['edit_product'])){
        $edit_id = $_GET['edit_product'];
        $get_data_query = "SELECT * FROM `products` WHERE product_id = $edit_id";
        $get_data_result = mysqli_query($con,$get_data_query);
        $row_fetch_data = mysqli_fetch_array($get_data_result);
        $product_id = $row_fetch_data['product_id'];
        $product_title = $row_fetch_data['product_title'];
        $product_description = $row_fetch_data['product_description'];
        $product_keywords = $row_fetch_data['product_keywords'];
        $category_id = $row_fetch_data['category_id'];
        $brand_id = $row_fetch_data['brand_id'];
        $product_image_uno_old = $row_fetch_data['product_image_uno'];
        $product_image_dos_old = $row_fetch_data['product_image_dos'];
        $product_image_tres_old = $row_fetch_data['product_image_tres'];
        $product_precio = $row_fetch_data['product_precio'];
    }
    // edit product
    if(isset($_POST['update_product'])){
        $product_title = $_POST['product_title'];
        $product_description = $_POST['product_description'];
        $product_keywords = $_POST['product_keywords'];
        $product_category_id = $_POST['product_category'];
        $product_brand_id = $_POST['product_brand'];
        $product_image_uno = $_FILES['product_image_uno']['name'] == '' ? $product_image_uno_old : $_FILES['product_image_uno']['name'];
        $product_image_uno_tmp = $_FILES['product_image_uno']['tmp_name'];
        $product_image_dos = $_FILES['product_image_dos']['name'] == '' ? $product_image_dos_old : $_FILES['product_image_dos']['name'];
        $product_image_dos_tmp = $_FILES['product_image_dos']['tmp_name'];
        $product_image_tres = $_FILES['product_image_tres']['name'] == '' ? $product_image_tres_old : $_FILES['product_image_tres']['name'];
        $product_image_tres_tmp = $_FILES['product_image_tres']['tmp_name'];
        $product_precio = $_POST['product_precio'];
        
        // check empty fields 
        if(empty($product_title) || empty($product_description) || empty($product_keywords) || empty($product_category_id) || empty($product_brand_id) || empty($product_image_uno) || empty($product_image_dos) || empty($product_image_tres) || empty($product_precio)){
            echo "<script>window.alert('Please fill all fields');</script>";
        }else{
            move_uploaded_file($product_image_uno_tmp,"./product_images/$product_image_uno");
            move_uploaded_file($product_image_dos_tmp,"./product_images/$product_image_dos");
            move_uploaded_file($product_image_tres_tmp,"./product_images/$product_image_tres");
            // update query 
            $update_product_query = "UPDATE `products` SET category_id=$product_category_id,brand_id=$product_brand_id,product_title='$product_title',product_description='$product_description',product_keywords='$product_keywords',product_image_uno='$product_image_uno',product_image_dos='$product_image_dos',product_image_tres='$product_image_tres',product_precio='$product_precio',date=NOW() WHERE product_id = $edit_id";
            $update_product_result = mysqli_query($con,$update_product_query);
            if($update_product_result){
                echo "<script>window.alert('Product updated successfully');</script>";
                echo "<script>window.open('./index.php?view_products','_self');</script>";
            }
        }
    }
    ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4">Editar Producto</h1>
            <form action="" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-3 mb-3">
                <div class="form-outline">
                    <label for="product_title" class="form-label">Título del Producto</label>
                    <input type="text" name="product_title" id="product_title" class="form-control" required value="<?php echo $product_title;?>">
                </div>
                <div class="form-outline">
                    <label for="product_description" class="form-label">Descripción del Producto</label>
                    <input type="text" name="product_description" id="product_description" class="form-control" required value="<?php echo $product_description;?>">
                </div>
                <div class="form-outline">
                    <label for="product_keywords" class="form-label">Palabras Clave del Producto</label>
                    <input type="text" name="product_keywords" id="product_keywords" class="form-control" required value="<?php echo $product_keywords;?>">
                </div>
                <div class="form-outline">
                    <label for="product_category" class="form-label">Categoría del Producto</label>
                    <select name="product_category" id="product_category" class="form-select" required >
                        <?php
                        // fetch all category with selected
                        $select_category_query_all = "SELECT * FROM `categories`";
                        $select_category_result_all = mysqli_query($con,$select_category_query_all);
                        while($fetch_category_name_all = mysqli_fetch_array($select_category_result_all)){
                            $category_name_is_all = $fetch_category_name_all['category_title'];
                            $category_id_is_all = $fetch_category_name_all['category_id'];
                            echo $category_id_is_all == $category_id ? "
                            <option value='$category_id_is_all' selected>$category_name_is_all</option>
                        ": "
                        <option value='$category_id_is_all'>$category_name_is_all</option>
                    ";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-outline">
                    <label for="product_brand" class="form-label">Categoría del Producto</label>
                    <select name="product_brand" id="product_brand" class="form-select" required>
                        <?php
                        // fetch all brands with selected
                        $select_brand_query_all = "SELECT * FROM `brands`";
                        $select_brand_result_all = mysqli_query($con,$select_brand_query_all);
                        while($fetch_brand_name_all = mysqli_fetch_array($select_brand_result_all)){
                            $brand_name_is_all = $fetch_brand_name_all['brand_title'];
                            $brand_id_is_all = $fetch_brand_name_all['brand_id'];
                            echo $brand_id_is_all == $brand_id ? "
                            <option value='$brand_id_is_all' selected>$brand_name_is_all</option>
                        ": "
                        <option value='$brand_id_is_all'>$brand_name_is_all</option>
                    ";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-outline">
                    <label for="product_image_uno" class="form-label">Imagen del product uno</label>
                    <div class="d-flex">
                        <input type="file" name="product_image_uno" id="product_image_uno" class="form-control" value="<?php echo $product_image_uno_old;?>">
                        <img src="./product_images/<?php echo $product_image_uno_old;?>" alt="<?php echo $product_title;?>" class="img-thumbnail" width="100px">
                    </div>
                </div>
                <div class="form-outline">
                    <label for="product_image_dos" class="form-label">Imagen del producto dos</label>
                    <div class="d-flex">
                        <input type="file" name="product_image_dos" id="product_image_dos" class="form-control" value="<?php echo $product_image_dos_old;?>">
                        <img src="./product_images/<?php echo $product_image_dos_old;?>" alt="<?php echo $product_title;?>" class="img-thumbnail" width="100px">
                    </div>
                </div>
                <div class="form-outline">
                    <label for="product_image_tres" class="form-label">Imagen del producto tres</label>
                    <div class="d-flex">
                        <input type="file" name="product_image_tres" id="product_image_tres" class="form-control" value="<?php echo $product_image_tres_old;?>">
                        <img src="./product_images/<?php echo $product_image_tres_old;?>" alt="<?php echo $product_title;?>" class="img-thumbnail" width="100px">
                    </div>
                </div>
                <div class="form-outline">
                    <label for="product_precio" class="form-label">Precio del Producto</label>
                    <input type="number" name="product_precio" id="product_precio" class="form-control" required value="<?php echo $product_precio;?>">
                </div>
                <div class="form-outline text-center">
                    <input type="submit" value="Actualizar Producto" class="btn btn-primary" name="update_product">
                </div>
            </form>
        </div>
    </div>
</div>