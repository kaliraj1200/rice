<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar Section -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="categories.html">Categories</a></li>
                    <li><a href="menu.html">Menu</a></li>
                    <li><a href="cart.html">Cart</a></li>
                    <li id="user-info"></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>

    <!-- Food Menu Section -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <!-- Product 1 -->
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-pizza.jpg" alt="Chicken Hawaiian Pizza" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h4>Chicken Hawaiian Pizza</h4>
                    <p class="food-price">$12.5</p>
                    <p class="food-detail">
                        A classic pizza topped with chicken, pineapple, and a blend of Italian cheeses.
                    </p>
                    <br>
                    <a href="#" class="btn btn-primary" onclick="addToCart('Chicken Hawaiian Pizza', 12.5, 'images/menu-pizza.jpg')">Add to Cart</a>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-burger.jpg" alt="Smoky Burger" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h4>Smoky Burger</h4>
                    <p class="food-price">$9.5</p>
                    <p class="food-detail">
                        A smoky grilled beef patty with fresh lettuce, cheese, and a tangy BBQ sauce.
                    </p>
                    <br>
                    <a href="#" class="btn btn-primary" onclick="addToCart('Smoky Burger', 9.5, 'images/menu-burger.jpg')">Add to Cart</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">Your Name</a></p>
        </div>
    </section>

    <script>
        // Display username in navbar if logged in
        const user = JSON.parse(localStorage.getItem('user'));
        if (user) {
            document.getElementById('user-info').innerHTML = `
                <span>Welcome, ${user.name}</span>
                <a href="#" onclick="logout()">Logout</a>
            `;
        }

        // Add to Cart Function
        function addToCart(title, price, image) {
            const user = JSON.parse(localStorage.getItem('user'));
            if (!user) {
                alert("Please log in to add items to the cart.");
                window.location.href = "login.html";
                return;
            }

            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const newItem = {
                title: title,
                price: price,
                image: image,
                quantity: 1
            };

            const existingItemIndex = cart.findIndex(item => item.title === title);
            if (existingItemIndex !== -1) {
                cart[existingItemIndex].quantity++;
            } else {
                cart.push(newItem);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            alert(title + " has been added to the cart!");
        }

        // Logout Function
        function logout() {
            localStorage.removeItem('user');
            localStorage.removeItem('cart');
            window.location.href = "index.html";
        }
    </script>
</body>
</html>   


---------------------------------
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Registration</h1>
        <form action="register.php" method="POST">
            <div class="form-group">
                <input type="text" name="name" placeholder="Enter Your Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Enter Your Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Create Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <div class="policy">
                <input type="checkbox" name="terms" id="check" required>
                <label for="check">I accept all terms & conditions</label>
            </div>
            <div class="form-group button">
                <button type="submit">Register</button>
            </div>
            <div class="link-to">
                <span>Already have an account? <a href="login.html">Login</a></span>
            </div>
        </form>
    </div>
</body>
</html>

--------------------------------------------
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Function to display the cart and total price
        function displayCart() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartContainer = document.getElementById('cart-items');
            const totalPriceContainer = document.getElementById('total-price');
            
            // Clear any previous cart items
            cartContainer.innerHTML = '';

            let totalPrice = 0;

            // Loop through the cart items and display them
            cart.forEach((item, index) => {
                const cartItem = document.createElement('div');
                cartItem.classList.add('cart-item');
                
                cartItem.innerHTML = `
                    <div class="cart-item-img">
                        <img src="${item.image}" alt="${item.title}" class="img-responsive img-curve">
                    </div>
                    <div class="cart-item-desc">
                        <h4>${item.title}</h4>
                        <p class="food-price">$${(item.price * item.quantity).toFixed(2)}</p>
                    </div>
                    <div class="cart-item-quantity">
                        <button class="btn btn-secondary" onclick="updateQuantity(${index}, 'decrease')">-</button>
                        <span id="quantity-${index}">${item.quantity}</span>
                        <button class="btn btn-secondary" onclick="updateQuantity(${index}, 'increase')">+</button>
                    </div>
                    <div class="cart-item-remove">
                        <button class="btn btn-danger" onclick="removeFromCart(${index})">Remove</button>
                    </div>
                `;

                cartContainer.appendChild(cartItem);

                // Calculate the total price
                totalPrice += item.price * item.quantity;
            });

            // Display the total price
            totalPriceContainer.textContent = '$' + totalPrice.toFixed(2);
        }

        // Function to update the quantity of an item
        function updateQuantity(index, action) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            if (action === 'increase') {
                cart[index].quantity++;
            } else if (action === 'decrease' && cart[index].quantity > 1) {
                cart[index].quantity--;
            }

            // Update localStorage with the new quantity
            localStorage.setItem('cart', JSON.stringify(cart));

            // Reload the cart page to reflect the changes
            displayCart();
        }

        // Function to remove an item from the cart
        function removeFromCart(index) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            // Remove the item from the cart array
            cart.splice(index, 1);
            // Update localStorage with the new cart
            localStorage.setItem('cart', JSON.stringify(cart));
            // Reload the cart page to reflect the changes
            displayCart();
        }

        // Redirect to order page when Place Order button is clicked
        function placeOrder() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const totalPrice = cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
            localStorage.setItem('order', JSON.stringify({ cart, totalPrice }));
            window.location.href = 'order.html';  // Redirect to the order page
        }

        // Call the function to display the cart when the page loads
        window.onload = displayCart;
    </script>
</head>
<body>
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="categories.html">Categories</a></li>
                    <li><a href="foods.html">Foods</a></li>
                    <li><a href="cart.html">Cart</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>

    <!-- Cart Section -->
    <section class="cart">
        <div class="container">
            <h2 class="text-center">Your Cart</h2>

            <!-- Cart items will be inserted here by JavaScript -->
            <div id="cart-items"></div>

            <div class="total-price">
                <h3>Total: <span id="total-price">$0.00</span></h3>
            </div>

            <!-- Checkout and Place Order buttons -->
            <div class="cart-buttons">
                <button class="btn btn-primary" onclick="window.location.href='checkout.html'">Checkout</button>
                <button class="btn btn-success" onclick="placeOrder()">Place Order</button>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">Your Name</a></p>
        </div>
    </section>
</body>
</html>


-----------------------------------------------------------

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Function to load the order details
        function loadOrder() {
            const order = JSON.parse(localStorage.getItem('order'));
            if (order) {
                const cart = order.cart;
                const totalPrice = order.totalPrice;
                const orderDetailsContainer = document.getElementById('order-details');
                
                cart.forEach(item => {
                    const orderItem = document.createElement('div');
                    orderItem.classList.add('order-item');
                    orderItem.innerHTML = `
                        <h4>${item.title}</h4>
                        <p>Price: $${item.price.toFixed(2)}</p>
                        <p>Quantity: ${item.quantity}</p>
                    `;
                    orderDetailsContainer.appendChild(orderItem);
                });

                // Display the total price
                document.getElementById('order-total-price').textContent = '$' + totalPrice.toFixed(2);
            }
        }

        // Call the function when the page loads
        window.onload = loadOrder;
    </script>
</head>
<body>
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="categories.html">Categories</a></li>
                    <li><a href="foods.html">Foods</a></li>
                    <li><a href="cart.html">Cart</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>

    <!-- Order Section -->
    <section class="order">
        <div class="container">
            <h2 class="text-center">Order Summary</h2>

            <div id="order-details"></div>

            <div class="total-price">
                <h3>Total: <span id="order-total-price">$0.00</span></h3>
            </div>

            <!-- Customer details form -->
            <h3>Enter Your Details</h3>
            <form action="submit_order.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
                
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
                
                <!-- Hidden input fields to store cart details -->
                <input type="hidden" name="cart" id="cart">
                <input type="hidden" name="totalPrice" id="totalPrice">
                
                <button type="submit" class="btn btn-primary">Submit Order</button>
            </form>
        </div>
    </section>

    <!-- Footer Section -->
    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">Your Name</a></p>
        </div>
    </section>

    <script>
        // Store cart and totalPrice data in hidden inputs before form submission
        document.querySelector('form').onsubmit = function() {
            const order = JSON.parse(localStorage.getItem('order'));
            if (order) {
                document.getElementById('cart').value = JSON.stringify(order.cart);
                document.getElementById('totalPrice').value = order.totalPrice.toFixed(2);
            }
        };
    </script>
</body>
</html>
-----------------------------------------

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <div class="form-group">
                <input type="email" name="email" placeholder="Enter Your Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Enter Your Password" required>
            </div>
            <div class="form-group button">
                <button type="submit">Login</button>
            </div>
            <div class="link-to">
                <span>Don't have an account? <a href="register.html">Register</a></span>
            </div>
        </form>
    </div>
</body>
</html>