[18-03-2025 23:45] CK: <html>

<head>

    <link href='https://fonts.googleapis.com/css?family=Barlow' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <title>SalesReport</title>
    <link rel="icon" type="image/x-icon" href="Image/avartar.png">
    <link rel="stylesheet" href="CSS/style.css" type="text/css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>
    <section id="sideMenu">

        <div class="sideNav">
            <div class="brand">
                <h3>
                    <Span><img src="Image/logo.png" alt="">Vel Rice Shop</Span>

                </h3>
            </div>

            <a href="admin.php"><i class="fa fa-solid fa-house"></i>Dashboard</a>
            <a href="Products.php"><i class="fa-solid fa-pen-to-square"></i>Products</a>
            <a href="salesReport.php    "><i class="fa-solid fa-chart-column"></i>Analytics</a>
            <a href="#Customer"><i class="fa-solid fa-users"></i>Custormer</a>
            <a href="#Purchase" class="drop-down"><i class="fa-solid fa-clipboard"></i>Purchase Details</a>
            <div class="drop-down-container ">
                <a href="add.html"><i class="fa-solid fa-square-plus"></i>Add Product</a>
            </div>
            <a href=""><i class="fa fa-solid fa-house"></i>sample</a>
            <a href=""></a>


        </div>
    </section>

    <section id="main">
        <div class="navBar">
            <div class="search-div">

                <input class="Search " type="search" placeholder="Search here">
                <button type="submit"><i class="fa fa-search"></i></button>


                <div class="userProfile">

                    <h3>Hai, Admin <span>Ajith</span></h3>
                    <img src="Image/avartar.png" alt="">


                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", { packages: ["corechart"] });
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['KKK Brand', 10],
                ['Vinayakar Brand', 2],
                ['IndiaGate Brand', 2],
                ['Apple Brand', 2],
                ['Suriya Brand', 7]
            ]);

            var options = {
                title: 'My Daily Sales Report',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
    <div id="piechart_3d" style="width: 80%; height: 85%;margin-left:300px;margin-top:20px;cursor:pointer;"></div>


</body>

</html>
[19-03-2025 08:58] CK: <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rice Brand Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Rice Brand Admin Panel</h1>
        <form action="add_brand.php" method="POST">
            <label for="name">Brand Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <button type="submit">Add Brand</button>
        </form>

        <h2>Brand List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php include 'fetch_brands.php'; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
[19-03-2025 08:58] CK: body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 50px auto;
    background: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    text-align: center;
}

form {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input, textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    padding: 10px 20px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #218838;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f8f9fa;
}

.actions {
    display: flex;
    gap: 10px;
}

.actions a {
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 4px;
}

.actions .edit {
    background-color: #ffc107;
    color: #000;
}

.actions .delete {
    background-color: #dc3545;
    color: #fff;
}
[19-03-2025 08:58] CK: <?php
$host = 'localhost';
$dbname = 'rice_brand_db';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
[19-03-2025 08:58] CK: <?php
include 'db.php';

$stmt = $conn->query("SELECT * FROM rice_brands");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['description']}</td>
            <td>{$row['price']}</td>
            <td class='actions'>
                <a href='edit_brand.php?id={$row['id']}' class='edit'>Edit</a>
                <a href='delete_brand.php?id={$row['id']}' class='delete'>Delete</a>
            </td>
          </tr>";
}
?>
[19-03-2025 08:58] CK: <?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM rice_brands WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $brand = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE rice_brands SET name = :name, description = :description, price = :price WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);

    if ($stmt->execute()) {
        header("Location: index.html");
    } else {
        echo "Error updating brand.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Brand</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Edit Brand</h1>
        <form action="edit_brand.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $brand['id']; ?>">
            <label for="name">Brand Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $brand['name']; ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $brand['description']; ?></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" value="<?php echo $brand['price']; ?>" required>

            <button type="submit">Update Brand</button>
        </form>
    </div>
</body>
</html>
[19-03-2025 08:58] CK: <?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM rice_brands WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: index.html");
    } else {
        echo "Error deleting brand.";
    }
}
?>