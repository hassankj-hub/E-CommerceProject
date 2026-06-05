<?php 
// 1. Initialize session memory tracking to see if a user is logged in
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoccerShoesXI Home Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:ital,wght@1,800;1,900&display=swap" rel="stylesheet">
    
    <style>
        /* ------------------------------------
           1. CSS RESET & GLOBAL STYLES
        ------------------------------------ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff; 
            color: #1b8549; 
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* ------------------------------------
           2. HEADER & NAVIGATION
        ------------------------------------ */
        header {
            width: 100%;
            max-width: 1300px;
            margin: 0 auto;
            padding: 30px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-text {
            font-family: 'Inter', sans-serif;
            font-weight: 800;
            font-size: 24px;
            color: #10a352; 
            text-decoration: none;
        }

        nav {
            display: flex;
            gap: 30px;
        }

        nav a {
            text-decoration: none;
            color: #10a352;
            font-weight: 500;
            font-size: 16px;
            transition: opacity 0.2s ease;
        }

        nav a:hover {
            opacity: 0.8;
        }

        .header-icons {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .icon {
            width: 22px;
            height: 22px;
            fill: none;
            stroke: #000000; 
            stroke-width: 2;
            cursor: pointer;
        }
        
        .icon-profile {
            fill: #10a352; 
            stroke: none;
        }

        /* Welcome Message Styling Container */
        .session-welcome-banner {
            width: 100%;
            max-width: 1220px;
            margin: 10px auto 20px auto;
            padding: 0 40px;
        }

        .welcome-card {
            background-color: #e2fef4; 
            color: #27563f; 
            padding: 16px 24px; 
            border-radius: 12px; 
            border: 1px solid #9ee5c4; 
            font-size: 0.95rem; 
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-card span {
            text-transform: uppercase; 
            font-weight: 800; 
            color: #10a352;
        }

        .logout-link {
            color: #cc0000;
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid #ffcccc;
            background-color: #fff0f0;
            padding: 6px 12px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }
        .logout-link:hover {
            background-color: #cc0000;
            color: #ffffff;
            border-color: #cc0000;
        }

        /* ------------------------------------
           3. HERO MAIN SECTION
        ------------------------------------ */
        .hero-container {
            width: 100%;
            max-width: 1300px;
            margin: 0 auto;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-grow: 1;
        }

        .hero-content {
            max-width: 55%;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .hero-content h1 {
            font-family: 'Montserrat', sans-serif;
            font-style: italic;
            font-weight: 900;
            font-size: 48px;
            line-height: 1.2;
            letter-spacing: -0.5px;
            color: #10a352;
            text-transform: uppercase;
        }

        .hero-content p {
            font-size: 18px;
            line-height: 1.5;
            color: #10a352;
            font-weight: 500;
        }

        .order-now-btn {
            display: inline-block;
            margin-top: 40px;
            font-weight: 600;
            font-size: 16px;
            color: #10a352;
            text-transform: uppercase;
            text-decoration: none;
            letter-spacing: 1px;
            align-self: flex-start;
            transition: letter-spacing 0.2s ease;
        }

        .order-now-btn:hover {
            letter-spacing: 2px;
        }

        .hero-banner {
            max-width: 40%;
            display: flex;
            justify-content: flex-end;
            padding-top: 20px;
        }

        .brand-card-img {
            width: 280px;
            height: auto;
            border-radius: 4px;
            box-shadow: 15px 15px 0px rgba(0, 0, 0, 0.15);
        }

        /* ------------------------------------
           4. PRODUCT SHOWCASE FOOTER
        ------------------------------------ */
        .product-showcase {
            width: 100%;
            max-width: 1300px;
            margin: 40px auto 60px auto;
            padding: 0 40px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .product-card {
            width: 100%;
            height: 200px; 
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: transparent;
            overflow: hidden;
        }

        .product-card img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain; 
            transition: transform 0.3s ease;
        }

        .product-card img:hover {
            transform: scale(1.05); 
        }
    </style>
</head>
<body>

    <header>
        <a href="homepage.php" class="logo-text">SoccerShoesXI</a>
        
        <nav class="nav-links">
            <a href="../php/homepage.php">Home</a>
            <a href="../php/products.php">Products</a> 
            <a href="../php/about.php">About</a>
            <a href="../php/contact.php">Contact</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="../php/dashboard.php">Dashboard</a>
            <?php else: ?>
                <a href="../html/login.html">Login</a>
            <?php endif; ?>
        </nav>

        <div class="header-icons">
            <svg class="icon" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <svg class="icon" viewBox="0 0 24 24">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <a href="<?php echo isset($_SESSION['username']) ? '../php/homepage.php' : 'login.html'; ?>">
                <svg class="icon icon-profile" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path>
                </svg>
            </a>
        </div>
    </header>

    <?php if (isset($_SESSION['username'])): ?>
        <div class="session-welcome-banner">
            <div class="welcome-card">
                <div>
                  Welcome back to the pitch, <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>! Ready to scout some fresh boots?
                </div>
                <a href="../php/logout.php" class="logout-link">Sign Out</a>
            </div>
        </div>
    <?php endif; ?>

    <main class="hero-container">
        <div class="hero-content">
            <h1>Step into greatness.<br>Welcome to Soccershoes XI.</h1>
            <p>Engineered for control. Styled for the pitch.<br>Source the absolute best boots from around the world.</p>
            <a href="../php/products.php" class="order-now-btn">Order Now</a>
        </div>

        <div class="hero-banner">
            <img src="../images/logo.png" alt="SoccerShoesXI Graphic Badge" class="brand-card-img">
        </div>
    </main>

    <section class="product-showcase">
        <div class="product-card">
            <img src="../images/Nike Phantom GT Elite DF.png" alt="Nike Phantom GT Elite DF">
        </div>
        <div class="product-card">
            <img src="../images/Adidas ACE 16+ Purecontrol.png" alt="Adidas ACE 16+ Purecontrol">
        </div>
        <div class="product-card">
            <img src="../images/Nike Mercurial Superfly 10 Elite.png" alt="Nike Mercurial Superfly 10 Elite">
        </div>
    </section>

</body>
</html>