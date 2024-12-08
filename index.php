<?php

use function Composer\Autoload\includeFile;

include_once("header.php");

$con = mysqli_connect("localhost", "root", "", "php_pro1");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$q = "SELECT * FROM sliders";
$count = mysqli_num_rows(mysqli_query($con, $q));
$result = mysqli_query($con, $q);

$q1 = "SELECT * FROM best_practices";
$result1 = mysqli_query($con, $q1);
?>

<div class="container my-5">
    <!-- Carousel -->
    <div class="carousel-container mb-5">
        <div id="carouselExampleIndicators" class="carousel slide shadow-lg" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php for ($i = 0; $i <= $count - 1; $i++) { ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i; ?>" class="<?php echo $i === 0 ? 'active' : ''; ?>" aria-label="Slide <?php echo $i + 1; ?>"></button>
                <?php } ?>
            </div>
            <div class="carousel-inner">
                <?php
                $i = 0;
                while ($r = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                        <img src="images/slider/<?php echo $r['img_name']; ?>" class="d-block w-100" alt="Slide Image">
                        <div class="carousel-caption d-none d-md-block">
                            <!-- <h5>Slide <?php echo $i + 1; ?></h5>
                            <p>Captivating caption for slide <?php echo $i + 1; ?>.</p> -->
                        </div>
                    </div>
                <?php $i++;
                } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Product Collections -->
    <section class="products-section">
        <h2 class="text-center bg-primary text-white p-3 rounded">Products Collection</h2>
        <div class="row g-4 mt-4">
            <?php while ($r1 = mysqli_fetch_assoc($result1)) { ?>
                <div class="col-md-4 col-lg-3">
                    <div class="card shadow">
                        <img src="images/best_practices/<?php echo $r1['img_name']; ?>" class="card-img-top" alt="Best Practices Image">
                        <div class="card-body">
                            <!-- <h5 class="card-title">Collection Name</h5>
                            <p class="card-text">A brief description of this collection.</p> -->
                            <a href="gallery.php" class="btn btn-outline-primary w-100">Learn More</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Search and Products -->
    <section class="search-section mt-5">
        <h2 class="text-center">Find Your Product</h2>
        <form method="GET" action="" class="d-flex justify-content-center my-4">
            <input type="text" name="search" class="form-control w-50 me-2" placeholder="Search for products..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <div class="product-gallery">
            <?php
            $search_keyword = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
            $query = $search_keyword
                ? "SELECT * FROM products WHERE status='Active' AND product_name LIKE '%$search_keyword%'"
                : "SELECT * FROM products WHERE status='Active' LIMIT 4";

            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="product-card">
                        <div class="card">
                            <img src="images/products/<?php echo $row['main_image']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['product_name']); ?></h5>
                                <?php if ($row['discount'] != 0) { ?>
                                    <span class="price text-muted text-decoration-line-through">Rs. <?php echo $row['price']; ?></span>
                                    <span class="badge bg-danger"><?php echo $row['discount']; ?>% Off</span>
                                    <p class="final-price text-success">Rs. <?php echo $row['price'] - ($row['discount'] * $row['price'] / 100); ?></p>
                                <?php } else { ?>
                                    <p class="price">Rs. <?php echo $row['price']; ?></p>
                                <?php } ?>
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i></a>
                                    <a href="view_product.php?id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                    <a href="add_to_wishlist.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fa-solid fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                echo '<p class="text-center text-muted">No products found for "' . htmlspecialchars($search_keyword) . '".</p>';
            }
                ?>
        </div>
    </section>
</div>
<style>.carousel img {
    height: 400px;
    object-fit: cover;
}

.card {
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.product-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.product-card img {
    height: 200px;
    object-fit: cover;
}
</style>
<br>
    <div class="container-fluid bg-image">
    <div class="row text-center1">
        <div class="col-12   text-white p-5">
            <h1>Western Wear</h1>
        </div>
    </div>
    <br><br>
    <!-- Additional content here -->
</div>

<style>.bg-image {
    background-image: url('images/slider/prints_banner.webp'); /* Replace with your image path */
    background-size: cover;   /* Ensures the image covers the full container */
    background-position: center; /* Centers the background image */
    height: 60vh; /* Full height of the viewport */
    display: flex; /* Enables flexbox */
    justify-content: center; /* Center content horizontally */
    align-items: center; /* Center content vertically */
}

.container-fluid{
    padding: 0; /* Remove default padding */
}

.text-center1 h1 {
    font-size: 3vw; /* Makes the text size responsive based on viewport width */
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7); /* Optional: adds a shadow to text for better visibility */
    margin: 0; /* Optional: Removes margin for better alignment */
    
    border: 2px solid white; /* Adds a solid white border around the text */
    padding: 10px; /* Adds padding inside the border for better spacing */
    display: inline-block; /* Ensures the border only wraps the text */
    background-color: grey;
}


/* Optional: Adjust font size for small screens using media queries */
@media (max-width: 768px) {
    .text-center h1 {
        font-size: 10vw; /* Adjust font size for smaller screens */
    }
}

</style>
<br>
    
<?php
include("footer.php");
?>