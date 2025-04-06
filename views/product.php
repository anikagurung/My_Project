<?php
session_start();
include_once('config.php');

// Check if the user is logged in
$userId = $_SESSION['id'];

if (isset($userId)) {
    // User is logged in, include header2.php
    include("header2.php");
} else {
    // User is not logged in, include header.php
    include("header.php");
}
?>
<div class="cream-container">
        <div class="container mt-3">
        <h2 style="padding-top: 20px; font-style: italic;">It's Book O' Clock</h2>
        <p>Explore our book options and find your next favorite book at the best prices.</p>
    <div id="product-grid" class="custom-container">
<!-- <div class="txt-heading">Products</div> -->
<?php
include('config.php');
$product= mysqli_query($mysqli,"SELECT * FROM product");
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
     