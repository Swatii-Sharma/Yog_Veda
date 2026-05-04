<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cloth Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="index.html" class="navbar-brand px-4">YOGAVEDA</a>
</nav>

<!-- Header -->
<div class="container-fluid bg-primary py-5 mb-5">
    <div class="container text-center">
        <h1 class="text-white">Cloth Collection</h1>
    </div>
</div>

<!-- CLOTH SECTION -->
<div class="container-xxl py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h1>Cloths</h1>
        </div>

        <div class="row g-4">

<?php
$file = "products.json";

// File check
if(file_exists($file)){

    $json = file_get_contents($file);
    $products = json_decode($json, true);

    if(!empty($products)){

        foreach($products as $p){
?>

    <div class="col-lg-3 col-md-6">
        <div class="team-item bg-light">

            <div class="overflow-hidden">
                <img class="img-fluid" src="uploads/<?php echo $p['image']; ?>" alt="">
            </div>

            <div class="text-center p-4">
                <h5><?php echo $p['name']; ?></h5>
                <small>₹<?php echo $p['price']; ?></small><br><br>

                <a href="payment_form.html">
                    <button class="btn btn-primary">Buy Now</button>
                </a>
            </div>

        </div>
    </div>

<?php
        }

    } else {
        echo "<h3>No products found</h3>";
    }

} else {
    echo "<h3>products.json file not found</h3>";
}
?>

</div>
        </div>
    </div>

<?php
    }
} else {
    echo "<p>No products available</p>";
}
?>

</div>
    </div>
</div>

<!-- Footer -->
<div class="container-fluid bg-dark text-light text-center p-3">
    © Yogaveda
</div>

</body>
</html>