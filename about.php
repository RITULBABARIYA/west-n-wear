<?php
include_once("header.php");

?>
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
    background-image: url('images/slider/91ba47820d663b52fb2a7299aacb169b.jpg'); /* Replace with your image path */
    background-size: cover;   /* Ensures the image covers the full container */
    background-position: center; /* Centers the background image */
    height: 20vh; /* Full height of the viewport */
    display: flex; /* Enables flexbox */
    justify-content: center; /* Center content horizontally */
    align-items: center; /* Center content vertically */
}

.container-fluid {
    padding: 0; /* Remove default padding */
}

.text-center1 h1 {
    font-size: 2vw; /* Makes the text size responsive based on viewport width */
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
<!-- <div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-4 align-center">
            <h1>About Western wear</h1>
        </div>
        
    </div> -->
    <br>
 <br>
    <div class="row p-4">
        <?php
        $query = "SELECT * FROM about_us";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                echo $row['content'];
            }
        }

        ?>

    </div>
</div>

<?php
include_once("footer.php");
?>