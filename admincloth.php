<?php
$msg = "";
$file_path = "products.json";

// Load data
if(file_exists($file_path)){
    $products = json_decode(file_get_contents($file_path), true);
} else {
    $products = [];
}

// UPLOAD
if(isset($_POST['upload'])){
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);

    if(!empty($name) && !empty($price) && isset($_FILES['image'])){
        
        $file = $_FILES['image'];

        if($file['error'] == 0){

            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = time() . "." . $ext;

            $folder = "uploads/" . $filename;

            if(move_uploaded_file($file['tmp_name'], $folder)){

                $products[] = [
                    "image" => $filename,
                    "name" => htmlspecialchars($name),
                    "price" => htmlspecialchars($price)
                ];

                file_put_contents($file_path, json_encode($products, JSON_PRETTY_PRINT));

                $msg = "✅ Uploaded Successfully!";
            } else {
                $msg = "❌ Upload Failed!";
            }
        }
    }
}

// DELETE
if(isset($_GET['delete'])){
    $index = $_GET['delete'];

    if(isset($products[$index])){

        $file = "uploads/" . $products[$index]['image'];

        if(file_exists($file)){
            unlink($file);
        }

        array_splice($products, $index, 1);
        file_put_contents($file_path, json_encode($products, JSON_PRETTY_PRINT));

        $msg = "🗑️ Deleted Successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>

<style>
body {
    font-family: Arial;
    background: #eef3f7;
    text-align: center;
    margin: 0;
}

/* Form */
form {
    background: white;
    padding: 20px;
    margin: 30px auto;
    border-radius: 10px;
    width: 300px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

input {
    margin: 8px 0;
    padding: 10px;
    width: 90%;
    border-radius: 5px;
    border: 1px solid #ccc;
}

button {
    padding: 10px;
    background: green;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background: darkgreen;
}

/* Message */
.msg {
    font-weight: bold;
    margin: 10px;
}

/* Gallery */
.gallery {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.card {
    background: white;
    margin: 10px;
    padding: 10px;
    border-radius: 10px;
    width: 180px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
}

.card img {
    width: 100%;
    height: 130px;
    object-fit: cover;
    border-radius: 5px;
}

.card h4 {
    margin: 8px 0 4px;
}

.card p {
    margin: 0;
}

/* Delete Button */
.delete-btn {
    display: block;
    margin-top: 8px;
    padding: 6px;
    background: red;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.delete-btn:hover {
    background: darkred;
}

/* Go Button */
.go-btn {
    display: inline-block;
    margin: 20px;
    padding: 12px 25px;
    background: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 8px;
}

.go-btn:hover {
    background: #0056b3;
}
</style>

</head>
<body>

<h2>🛠️ Admin Product Upload</h2>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Product Name" required><br>
    <input type="number" name="price" placeholder="Price" required><br>
    <input type="file" name="image" required><br>
    <button name="upload">Upload</button>
</form>

<p class="msg"><?php echo $msg; ?></p>

<h3>📦 Uploaded Products</h3>

<div class="gallery">
<?php
foreach($products as $index => $p){
?>
    <div class="card">
        <img src="uploads/<?php echo $p['image']; ?>">
        <h4><?php echo $p['name']; ?></h4>
        <p>₹<?php echo $p['price']; ?></p>
        <a class="delete-btn" href="?delete=<?php echo $index; ?>">Delete</a>
    </div>
<?php } ?>
</div>

<a href="cloths.php" class="go-btn">➡ Go to Product Page</a>

</body>
</html>