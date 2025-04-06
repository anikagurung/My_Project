<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Result</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CSS/home.css">
    <style>
        /* Your custom styles 
        #product-grid {
            justify-content: center;
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            white-space: nowrap;
            cursor: pointer;
    
        }

        .product-item {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            margin: 10px;
            width: 250px;
            display: flex;
            flex-direction: column;


        }

        .product-item .product-image img {
            max-width: 100%;
            height: auto;
        }

        .product-item .product-tile-footer {
            padding-top: 10px;
            flex-grow: 1;
        }

        .product-item a {
            display: inline-block;
            background-color: white;
            color: brown;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: auto;
        }

        .product-item a:hover {
            background-color: rgb(128, 128, 0);
        }*/
        #product-grid {
    justify-content: center;
    display: flex;
    flex-wrap: wrap; /* Allow items to wrap to the next row */
    margin: -10px; /* Adjust margin to counteract individual item margins */
}

.product-item {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    margin: 10px;
    width: 250px;
    display: flex;
    flex-direction: column;
    box-sizing: border-box; /* Include padding and border in the width calculation */
}

.product-item .product-image img {
    max-width: 100%;
    height: auto;
}

.product-item .product-tile-footer {
    padding-top: 10px;
    flex-grow: 1;
}

.product-item a {
    display: inline-block;
    background-color: white;
    color: brown;
    padding: 8px 15px;
    text-decoration: none;
    border-radius: 5px;
    margin-top: auto;
}

.product-item a:hover {
    background-color: rgb(128, 128, 0);
}

    </style>
</head>
<body>

<?php
$search_value = $_POST["search"];
include('config.php');

$result = mysqli_query($mysqli, "SELECT * FROM product where status='approved' AND product.title LIKE '$search_value%'");
$result_count = mysqli_num_rows($result);

if ($result_count > 0) {
    echo '<div id="product-grid" class="custom-container">
              <div class="txt-heading">Products</div>';

    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="product-item">
                  <div class="product-image"><img src="../admin/' . $row["photo"] . '"></div>
                  <div class="product-tile-footer">
                      <div class="product-title">' . $row["title"] . '</div>
                      <div class="product-title">' . $row["authorname"] . '</div>
                      <div class="product-price">Rs' . $row["price"] . '</div>
                      <a href="action.php?id=' . $row["id"] . '" class="custom-button">Add to Cart</a>
                  </div>
              </div>';
    }

    echo '</div>'; // Close product-grid container
} else {
    echo "No Records.";
}
?>

<!-- JavaScript libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Your custom JavaScript code -->
<script type="text/javascript">
    // Your custom JavaScript code
</script>

</body>
</html>

  

