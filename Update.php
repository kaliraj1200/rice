<?php
@include 'config.php';

$Id = $_GET['edit'];

if (isset($_POST['updateProduct'])) {
    $p_Name = $_POST['P_Name'];
    $p_Var = $_POST['P_Var'];
    $p_Qty = $_POST['P_Qty'];
    $p_Price = $_POST['P_Price'];
    $p_Image = $_FILES['p_Image']['name'];
    $p_Image_tmp_name = $_FILES['p_Image']['tmp_name'];
    $p_Image_folder = 'Images_upload/' . $p_Image;

    $update_query = mysqli_query($conn, "UPDATE product_data SET ProductName='$p_Name' ,Product_Vartity='$p_Var',Product_Quantity='$p_Qty',ProductPrice= '$p_Price',ProductImage ='$p_Image' WHERE Id =$Id ");
    if ($update_query) {
        move_uploaded_file($p_Image_tmp_name, $p_Image_folder);
        // echo '<script>alert("Product Updated Successfully")</script>';

        header('location:Products.php');
    }



}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Barlow' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <title>Add Product</title>
    <link rel="icon" type="image/x-icon" href="Image/avartar.png">
    <link rel="stylesheet" href="CSS/style.css" type="text/css">
</head>

<body>
    <section class="Product_main">

        <?php
        $select = mysqli_query($conn, "SELECT * FROM `product_data` WHERE Id =$Id") or die("QueryFailed");
        while ($row = mysqli_fetch_assoc($select)) {

            ?>

            <form action="" method="POST" class="addProduct_form" enctype="multipart/form-data">
                <a href="Products.php"><i class="fa-solid fa-xmark"></i></a>
                <h3>Update a Product</h3>
                <input type="text" name="P_Name" value="<?php echo $row['ProductName'] ?>"
                    placeholder="Enter the Brand Name" class="box-container" required>
                <input type="text" name="P_Var" value="<?php echo $row['Product_Vartity'] ?>"
                    placeholder="Enter the Varieties" class="box-container" required>
                <input type="text" name="P_Qty" value="<?php echo $row['Product_Quantity']; ?>"
                    placeholder="Enter the Quantity" class="box-container" required>
                <input type="number" name="P_Price" value="<?php echo $row['ProductPrice']; ?>"
                    placeholder="Enter the Price" class="box-container" required>
                <input type="file" name="p_Image" accept="Image/png, Image/jpag, Image/jpg" class="box-container" required>
                <input type="submit" value="Update The Product" name="updateProduct" class="btn">

            </form>

        <?php }
        ; ?>
    </section>
</body>

</html>