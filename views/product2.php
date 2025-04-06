<!DOCTYPE html>
<html lang="en">
<head>
    <title>Second life of books</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" type="text/css" href="CSS/home.css">

    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="cream">
        <nav class="navbar navbar-expand-sm navbar-light">
            <div class="container">
                <a class="navbar-brand" href="/project4">Second life of Books</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">

                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="product2.php">Product</a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact us</a>
                        </li>-->
                    </ul>
                    <div class="cart">

                    <a href="cartt.php" style="text-decoration:none; display:inline-block; color: black;">
                        <i class="fa-solid fa-cart-shopping fa-lg"></i>
                    
                    <style>
                        .cart{
                            margin-right: 20px;
                        }
                    </style>
                        <!--<span id="cart-count">0</span></a> -->
                    </div>
                    <div class="join-seller">
                        <a href="becomeseller.php" class="join-seller-link" style="text-decoration:none; display:inline-block; color: black; margin-right: 20px;">Join as Seller</a>
                        
                    </div>
                    <div class="space">
                        <!--<form class="d-flex">-->
                            <a href="userinfo.php" style="text-decoration:none; display:inline-block; color: black;">
                                <i class="fa-solid fa-user"></i>
                            </a>


                         </form>
                     </div>
                </div>
            </div>

        </nav>
    </div>
     <div class="cream-container">
        <div class="container mt-3">
        <h2 style="padding-top: 20px; font-style: italic;">It's Book O' Clock</h2>
        <p>Explore our book options and find your next favorite book at the best prices.</p>
    <div id="product-grid" class="custom-container">
<!-- <div class="txt-heading">Products</div> -->
<?php
include('config.php');
$product= mysqli_query($mysqli,"SELECT * FROM product WHERE status='approved'");
if (!empty($product)) {
while ($row=mysqli_fetch_array($product)) {
?>
<div class="product-item">
<!-- <form method="post" action="action.php"> -->
     <div class="product-image"><img src="../admin/<?php echo $row["photo"]; ?>"></div>
      <div class="product-tile-footer">

         <div class="product-title"><?php echo $row["title"]; ?></div>
           <div class="product-title" style="color:black; font-size: 14px;"><?php echo $row["authorname"]; ?></div>
          <div class="product-price"><?php echo "Rs".$row["price"]; ?></div>
      <a href='action.php?id=<?php echo"$row[id]"?>' class="custom-button" onclick="addToCart()">Add to Cart</a>

</div>
</div>

<!-- </form> -->

<?php
}
} else {
echo "No Records.";
}

?>
</div>
</div>
 <script>
        function addToCart() {
            alert('Product added to cart!');
        }
    </script>
<style>

/*.cream-container {
            background-color: #f9f9f9;
            padding: 20px;
        }

        .cream-container .custom-container {
            max-width: 800px;
            margin: 0 auto;
        }

        /*#product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }*/
        #product-grid{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            cursor: pointer;
        }

        .product-item {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            margin: 20px;
            width: 250px;
            display: inline-block;
            transition: box-shadow 0.3s ease, background-color 0.3s ease;;
        }
        .product-item:hover {
         box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.3); /* Change box shadow on hover */
           background-color: rgba(230, 216, 186, 0.916);
        }

        .product-item .product-image img {
            /*max-width: 80%;
            height: 15%;
            border: none; /* Remove the outline 
            padding-bottom: 10px;*/
            align-items: center;
            max-width: 100%;
             height: 200px;
             }

        .product-item .product-tile-footer {
            padding-top: 10px;
        }


        .product-item a {
            display: inline-block;
            background-color: white;
            color: #brown;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;

        }

        .product-item a:hover {
            background-color: rgb(128, 128, 0);
        }
        .custom-button{
             display: block;
             text-align: center;
             color: brown;
             padding: 5px 10px;
             border: 2px solid rgb(131, 95, 70);

        }
       .product-price {
         font-size: 14px;
         color: #ff6600;
        }            
    </style>
     <body>
    <footer class="footer">
        <?php
        include('footer.php');?>
    </footer>
</body>