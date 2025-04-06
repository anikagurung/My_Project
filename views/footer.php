 <style>
        .footer {
            background-color: rgba(230, 216, 186, 0.916) ;
            color: black;
            padding: 20px 0; /* Increased padding for better spacing */
            text-align: center;
        }

        .footer-columns {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .column {
            flex: 1 1 200px; /* Each column should have a maximum width of 200px */
            margin: 10px;
        }

        .column h3 {
            margin-bottom: 10px;
        }

        .column a {
            display: block;
            margin-bottom: 5px;
            color: black;
            text-decoration: none;
        }

        .column a:hover {
            text-decoration: underline;
        }

        .social-icons {
            list-style: none;
            padding:  0;
           
        }

        .social-icons li {
            display: inline;
            margin: 0 10px;
        }

        .social-icons a {
            color: black;
            font-size: 24px;
            text-decoration: none;
        }

    </style>
</head>

<body>
    <footer class="footer">
        <div class="footer-columns">
            <div class="column">
                <h3>Quick links</h3>
                <a href="#">Home</a>
                <a href="home2.php">About us</a>
                <a href="product.php">Products</a>
                <!--<a href="contact.php">contact</a>-->
            </div>
            <div class="column">
                <h3>Support</h3>
                <a href="userinfo.php">My account</a>
                <a href="cartt.php">My Cart</a>
                <!--<a href="#">my favorite</a>-->
            </div>

            <div class="column">
                <h3>Contact Us</h3>
                <p>Email: info@secondlife.com</p>
                <p>Phone: +977 9845678900</p>

            </div>

           
         </div>
        

        <ul class="social-icons">
            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
        </ul>


        <p>
            <a href="#">
                Copyright Protected By Books The Second Life of Books, 2023
                <span class="underlined">Terms of Use</span> |
                <span class="underlined">Privacy Policy</span>
            </a>
        </p>
       
    </footer>
</body>