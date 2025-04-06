<?php
include "header.php";
?>
<script type="text/javascript" src="jquery-3.7.1.js">
</script>
<script>
    $(document).ready(function(){
        // alert('hey');
  $("#search-in").on("keyup",function(){
    var search_term=$(this).val();
    var x = document.getElementById('search-result');
    if($(this).val() == "") {
      x.style.display = 'none';
    } else {
      x.style.display = 'block';
    }
  
    $.ajax({
      url:"searchresult.php",
      
      type:"POST",
      data:{search:search_term},
      success:function(data){
        $("#search-result").html(data);
     
        }
      });
  });

});
</script>
 <div class="cream"> <br> <br>
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-4 col-12">
                    <div class="rounded-box1">
                        <div class="dot"></div>
                        Your next great read is waiting
                    </div> <br>

                    <h1 style="font-family: 'Times New Roman', Times, serif; text-align: left;"> Buy books for the best
                        price.</h1>
                    <p style="text-align:left;">Explore a world of knowledge without breaking the bank. Our thrifted books offer affordable access to a diverse range of topics, making learning accessible for everyone</p>
                    <div class="search-container" style="width: 75%;">

                        <input type="text" class="search-in" id="search-in" placeholder="Search...">
                        <img src="photo/search.png" alt="Search Icon" class="search-icon"> <br>

                    </div> <br>
                    <div class="search-result" id="search-result" style="width: 100%; display:none;">

                       <!-- <h1>here</h1> -->

                    </div><br>
                    <a href="register.php">
                        <button class="rounded-button">Join for free</button></a>
                        <a href="product.php">
                    <button class="rounded-button">Browse Books</button></a>


                </div>
                <br>
                <br>

                <div class="col">
                    <br>
                    <!-- Carousel -->
                    <div id="demo" class="carousel slide" data-bs-ride="carousel">

                        <!-- Indicators/dots -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                        </div>

                        <!-- The slideshow/carousel -->


                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <center>
                                    <img src="photo/smart.jpeg" alt="Los Angeles" class="d-block w-80 img-fluid"
                                        style=" height: 400px; ">
                                </center>
                                <div class="carousel-caption">
                                    <h4>Welcome to second life of books</h4>
                                    <p>Explore book thrifting world</p>
                                    
                                </div>
                            </div>
                            <div class="carousel-item">
                                <center>
                                    <img src="book/iki.JPG" alt="Chicago" class="d-block w-80 img-fluid"
                                        style=" height: 400px;">
                                </center>
                                <div class="carousel-caption">

                                </div>
                            </div>
                            <div class="carousel-item">
                                <center>
                                    <img src="photo/end.jpeg" alt="New York" class="d-block w-80 img-fluid"
                                        style=" height: 400px;">
                                </center>
                                <div class="carousel-caption">
                                    
                                    <p>Don't miss out</p>
                                </div>
                            </div>
                        </div>


                        <!-- Left and right controls/icons -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>

                    <div class="container-fluid mt-3">

                        <p></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="rounded-box">
                        <div class="dot"></div>
                        Why choose Second life of books?
                    </div> <br>
                  
                        <h2>Best Way to manage your reading life</h2>
                        <p>Second Life of Book can be your go-to platform for thrifting second-hand books online. Explore a diverse collection and discover the joy of sustainable reading today!</p>
                </div>
                <div class="col">
                    <h1></h1>

                </div>
            </div>
        </div>


        <div class="container " id="featured-3">

            <div class="row  py-5 row-cols-lg-3">
                <div class="feature col">
                    <div class="fs-2 mb-3 ">
                        <img src="photo/sea.png" alt="search icon" style="width:1em; height: 1em; ">
                    </div>

                    <h4>Book Discovery</h4>
                    <p>Discover new books to read based on your interests, choices, and the recommendations of other users.</p>

                </div>
                <div class="feature col">
                    <div class=" fs-2 mb-3">
                        <img src="photo/gro.png" style="width: 1em; height: 1em;">
                    </div>
                    <h4>Selling your books</h4>
                    <p>You can sell your pre-owned books and give them second chance by selling with other readers who have love of reading.
                    </p>

                </div>
                <div class="feature col">
                    <div class=" fs-2 mb-3">
                        <img src="photo/star.png" style="width: 1em; height: 1em;">
                    </div>
                    <h4>User experience</h4>
                    <p>You can read experience that other user had and share your thoughts with them.</p>

                </div>
            </div>
        </div>
    

    </div>
    <div class="cream1">
        <div class="container mt-3">
            <h2>Our Suggestion</h2>
            <p>Find Your Next Great Read Among Our suggestion list.</p>

            <br>
            <div class="products-container">
                 <?php
               include('config.php');
             $product = mysqli_query($mysqli, "SELECT * FROM product WHERE status='approved' ORDER BY rand() LIMIT 6");
            if (!empty($product)) {
              while ($row = mysqli_fetch_array($product)) {
                ?>
                
                <div class="product">
                     
                    <img src="../admin/<?php echo $row["photo"]; ?>" alt="Product 1">
                  <div class="product-tile-footer">
                     <div class="product-title"><?php echo $row["title"]; ?></div>
                     <p><?php echo $row["authorname"]; ?></p>
                     <div class="product-price"><?php echo "Rs". $row["price"] ?></div>
                     <a href='register.php?id=<?php echo "$row[id]" ?>' onclick="addToCart() ">
                        <button class="custom-button" style="text-decoration: none; display: inline-block; border-radius: 5px;">Add to Cart</button></a>
                  </div>
                    <!--<button class="add-to-cart" onclick="addToCart()">Add to Cart</button>-->
                </div>
                <?php
            }
        } else {
            echo "No Records.";
        }
        ?>
                <!--<div class="product">
                    <img src="book/img1.webp" alt="Product 1">
                    <div class="product-title">Twisted Love</div>
                    <p>by Ana Huang</p>
                    <div class="product-price">Rs350</div>
                    <button class="add-to-cart" onclick="addToCart()">Add to Cart</button>
                </div>

                <div class="product">
                    <img src="book/img5.webp" alt="Product 2">
                    <div class="product-title" onclick="addToCart()">Ice Breaker</div>
                    <p>by Hannah Grace
                    </p>
                    <div class="product-price">Rs350</div>
                    <button class="add-to-cart" onclick="addToCart()">Add to Cart</button>
                </div>

                <div class="product">
                    <img src="book/itends.jpeg" alt="Product 3">
                    <div class="product-title" onclick="addToCart()">It ends with us</div>
                    <p>by Colleen Hoover</p>
                    <div class="product-price">Rs350</div>
                    <button class="add-to-cart" onclick="addToCart()">Add to Cart</button>
                </div>

                <div class="product">
                    <img src="book/img4.webp" alt="Product 4">
                    <div class="product-title">Think and Grow Rich</div>
                    <p>by Napoleon Hill</p>
                    <div class="product-price">Rs350</div>
                    <button class="add-to-cart" onclick="addToCart()">Add to Cart</button>
                </div>
                <div class="product">
                    <img src="book/img6.webp" alt="Product 4">
                    <div class="product-title">November 9</div>
                    <p>by Colleen Hoover</p>
                    <div class="product-price">Rs350</div>
                    <button class="add-to-cart" onclick="addToCart()">Add to Cart</button>
                </div>
                <div class="product">
                    <img src="book/img8.jpeg" alt="Product 2">
                    <div class="product-title" onclick="addToCart()">Sapiens:</div>
                    <p>by Yuval Noah Harari</p>
                    <div class="product-price">Rs350</div>
                    <button class="add-to-cart" onclick="addToCart()">Add to Cart</button>
                </div>-->

            </div>

        </div>
    </div>
    
<div class="cream-container">
    <div class="container mt-3">
        <h2 style="padding-top: 20px;">New Arrivals</h2>
        <p>Explore Fresh Arrivals and Find Your Next Great Read.</p>
    <div id="product-grid" class="custom-container">
        <?php
        include('config.php');
        $product = mysqli_query($mysqli, "SELECT * FROM product ORDER BY id DESC LIMIT 8");
        if (!empty($product)) {
            while ($row = mysqli_fetch_array($product)) {
                ?>
                <div class="product-item">
                    <div class="product-image"><img src="../admin/<?php echo $row["photo"]; ?>" alt="<?php echo $row["title"]; ?>"></div>
                    <div class="product-tile-footer">
                        <div class="product-title" style="font-size: 15px; font-weight: bold;"><?php echo $row["title"]; ?></div>
                        <div class="product-title" style="color:black; font-size: 14px;"><?php echo $row["authorname"]; ?></div>
                        <div class="product-price"><?php echo "Rs" . $row["price"]; ?></div>
                        <a href="register.php"class="custom-button">Add to Cart</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No Records.";
        }
        ?>
    </div>
</div>

        </center>
    

    <script>
        let cartCount = 0;
        // function addToCart($a) {
        //     // b=$a;
        //     cartCount++;
        //     document.getElementById('cart-count').innerText = cartCount;
        //     // alert('Product added to cart!');
        //     // alert($a);
        //     // alert(cartCount);


        // }
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
</head>
<?php
include "footer.php";
?>