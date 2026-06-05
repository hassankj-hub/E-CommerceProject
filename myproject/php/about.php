<?php 
// ========================================================================
// PROJECT: SoccerShoes XI Storefront - "About Us" Module (Unified Design)
// BRAND ARCHITECTURE: Black, White, & Vibrant Green Colorway (#10b981)
// ENHANCEMENT: Integrated Dynamic Session Routing Logic
// ========================================================================

// 1. Initialize session memory tracking for your navigation header architecture
session_start(); 

// OPTIONAL SECURITY GATE: Uncomment the lines below if you want to force users to login before viewing
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.html");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Story | SoccerShoes XI</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        /* --- BRAND COLOR ENGINE (:ROOT VARIABLES) --- */
        :root {
            --brand-green: #10b981; /* Logo Background Green */
            --pitch-black: #111111; /* Logo Text & Graphics Black */
            --clean-white: #ffffff;
            --light-gray: #f4f4f5;
            --text-dark: #1f2937;
            --border-gray: #e4e4e7;
        }

        /* --- CSS RESET & BASE TYPOGRAPHY LAYOUT --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            color: var(--text-dark);
            background-color: var(--clean-white);
            line-height: 1.6;
        }

        /* --- GLOBAL WRAPPER UTILITY --- */
        .container {
            width: 90%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 0;
        }

        /* --- TOP NAVIGATION BAR --- */
        .back-home-nav {
            background-color: var(--pitch-black);
            padding: 15px 0;
            border-bottom: 1px solid #27272a;
            display: flex;
        }

        .back-btn {
            color: var(--clean-white);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 8px 16px;
            border: 1px solid var(--brand-green);
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background-color: var(--brand-green);
            color: var(--pitch-black);
            transform: translateX(4px);
        }

        /* --- HERO HEADER SECTION --- */
        .about-hero {
            background-color: var(--pitch-black);
            color: var(--clean-white);
            text-align: center;
            padding: 50px 20px;
            border-bottom: 5px solid var(--brand-green);
        }

        .brand-logo-img {
            max-width: 130px;
            height: auto;
            margin-bottom: 15px;
            border-radius: 12px;
        }

        .about-hero h1 {
            font-size: 2.5rem;
            font-weight: 900;
            letter-spacing: 1px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .about-hero h1 span {
            color: var(--brand-green);
        }

        .about-hero p {
            font-size: 1.1rem;
            font-weight: 700;
            color: #a1a1aa;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* --- CONTENT SPLIT GRID --- */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 50px;
            margin-top: 20px;
        }

        @media (min-width: 768px) {
            .about-grid {
                grid-template-columns: 1fr 1.2fr; 
            }
        }

        /* --- LEFT COLUMN: CORE PILLAR CARDS --- */
        .pillars-sidebar {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .pillar-card {
            background-color: var(--light-gray);
            padding: 30px;
            border-radius: 12px;
            border-left: 5px solid var(--pitch-black);
            transition: border-color 0.3s ease;
        }

        .pillar-card:hover {
            border-left-color: var(--brand-green);
        }

        .pillar-card h3 {
            font-size: 1.2rem;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 10px;
            color: var(--pitch-black);
            letter-spacing: 0.5px;
        }

        .pillar-card p {
            font-weight: 500;
            color: #4b5563;
            font-size: 0.95rem;
        }

        /* --- RIGHT COLUMN: EDITORIAL SHOWCASE PANEL --- */
        .editorial-container {
            background-color: var(--clean-white);
            padding: 40px;
            border: 2px solid var(--border-gray);
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .editorial-container h2 {
            font-size: 1.8rem;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 20px;
            color: var(--pitch-black);
        }

        .editorial-container p {
            font-weight: 500;
            color: #4b5563;
            margin-bottom: 20px;
            font-size: 1.05rem;
        }

        .showcase-box {
            background-color: var(--light-gray);
            border: 2px dashed var(--border-gray);
            border-radius: 8px;
            padding: 15px;
            margin-top: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color 0.3s ease;
        }

        .showcase-box:hover {
            border-color: var(--brand-green);
        }

        .showcase-box img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            object-fit: contain;
        }

        /* --- BOTTOM FULL-WIDTH MISSION BANNER --- */
        .mission-banner {
            background-color: var(--pitch-black);
            color: var(--clean-white);
            text-align: center;
            padding: 60px 20px;
            border-left: 8px solid var(--brand-green);
            margin-top: 40px;
            border-radius: 12px;
        }

        .mission-banner blockquote {
            font-size: 1.3rem;
            font-weight: 700;
            font-style: italic;
            max-width: 850px;
            margin: 0 auto;
            line-height: 1.7;
        }
    </style>
</head>
<body>

    <nav class="back-home-nav">
        <div class="container" style="padding: 0;">
            <a href="../php/homepage.php" class="back-btn">← Back to Homepage</a>
        </div>
    </nav>

    <header class="about-hero">
        <a href="homepage.php">
            <img src="../images/logo.png" alt="SoccerShoes XI Logo" class="brand-logo-img">
        </a>
        <h1>OUR <span>STORY</span></h1>
        <p>Best Shoes From ATW!!</p>
    </header>

    <main class="container">
        <div class="about-grid">
            
            <section class="pillars-sidebar">
                
                <div class="pillar-card">
                    <h3>Precision Curation</h3>
                    <p>We match footwear architecture directly to specific player positions, touch metrics, and pitch layouts (Firm Ground, Artificial Grass, Turf).</p>
                </div>

                <div class="pillar-card">
                    <h3>Global Access (ATW)</h3>
                    <p>We bridge the gap between regional market exclusives and competitive players who demand the absolute best the world has to offer.</p>
                </div>

                <div class="pillar-card">
                    <h3>Authentic Innovation</h3>
                    <p>Every product inside our inventory pipeline is strictly vetted for premium manufacturing quality, elite traction patterns, and comfort parameters.</p>
                </div>

            </section>

            <section class="editorial-container">
                <h2>The XI Standard</h2>
                
                <p>At <strong>SoccerShoes XI</strong>, we live and breathe the beautiful game. We know that when you cross that white line onto the pitch, confidence starts from the ground up.</p>
                
                <p>The "XI" in our name stands for the perfect starting eleven—the ultimate squad where every player has a distinct role and demands exact performance from their gear. Whether you are a clinical winger, a midfield general, or a defensive wall, we curate footwear specifically engineered to elevate your unique position.</p>
                
                <p>Driven by our promise to deliver the <strong>"Best Shoes From ATW!!"</strong>, our team relentlessly scouts the global market to import elite-tier footwear layout tech, directly handling the logistics so you can focus entirely on your performance.</p>

                <div class="showcase-box">
                    <img src="../images/Adidas ACE 16.1 Primeknit.png" alt="Adidas ACE 16.1 Primeknit Elite Product Showcase">
                </div>
            </section>

        </div>

        <section class="mission-banner">
            <blockquote>
                "To equip every footballer with the world's finest footwear tools, empowering them to step onto any pitch with the confidence of an elite professional."
            </blockquote>
        </section>
    </main>

</body>
</html>