<?php 
// 1. Initialize user session memory tracking
session_start(); 

// 2. Import database connector configurations
include('test_db.php');

// 3. Fetch all available boot inventory models sorted by ID
$sql = "SELECT * FROM products ORDER BY id ASC";
$result = mysqli_query($conn, $sql);

// 4. Handle default credentials fallback matching your platform state
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'BootsXI';
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : 'Boots@gmail.com';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCCERSHOES XI - Products</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex">

    <aside class="w-72 bg-[#00C853] text-white flex flex-col justify-between p-6 shrink-0 rounded-r-[2rem] shadow-xl">
        <div>
            <div class="flex items-center justify-between mb-10 mt-2">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div class="w-12 h-12 rounded-full border-2 border-white bg-white overflow-hidden flex items-center justify-center shadow-sm">
                            <img src="../images/logo.png?v=1" alt="SoccerShoes XI Logo" class="w-[85%] h-[85%] object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="hidden w-full h-full bg-emerald-700 text-white flex items-center justify-center font-bold text-sm">SS</div>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-bold text-xs tracking-tight leading-tight max-w-[140px] truncate">
                            <?php echo htmlspecialchars($user_name); ?>
                        </h4>
                        <span class="text-[10px] text-green-100 font-medium block max-w-[140px] truncate">
                            <?php echo htmlspecialchars($user_email); ?>
                        </span>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down text-xs cursor-pointer opacity-80 hover:opacity-100"></i>
            </div>

            <nav class="space-y-1.5">
                <a href="../php/homepage.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
                    <i class="fa-solid fa-house text-base w-6 text-center"></i>
                    <span class="font-semibold text-xs tracking-wide">Home</span>
                </a>
                <a href="../php/products.php" class="flex items-center gap-4 px-5 py-3.5 bg-white text-[#00C853] rounded-2xl shadow-md font-bold text-xs tracking-wide relative">
                    <div class="absolute left-0 top-1/4 bottom-1/4 w-1 bg-[#00C853] rounded-r"></div>
                    <i class="fa-solid fa-shoe-prints text-base w-6 text-center"></i>
                    <span>Products</span>
                </a>
                <a href="../php/about.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
                    <i class="fa-solid fa-circle-info text-base w-6 text-center"></i>
                    <span class="font-semibold text-xs tracking-wide">About Us</span>
                </a>
                <a href="../php/contact.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
                    <i class="fa-solid fa-envelope text-base w-6 text-center"></i>
                    <span class="font-semibold text-xs tracking-wide">Contact Us</span>
                </a>
                <a href="../php/statistic.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
                    <i class="fa-solid fa-chart-line text-base w-6 text-center"></i>
                    <span class="font-semibold text-xs tracking-wide">Dashboard</span>
                </a>
            </nav>
        </div>

        <div class="border-t border-white/20 pt-4 space-y-1.5">
            <a href="#" class="flex items-center gap-4 px-4 py-2 rounded-xl text-[11px] font-medium opacity-75 hover:opacity-100 transition">
                <i class="fa-solid fa-gear w-5 text-center"></i>
                <span>Setting</span>
            </a>
            <a href="../php/logout.php" class="flex items-center gap-4 px-4 py-2 rounded-xl text-[11px] font-medium opacity-75 hover:opacity-100 transition">
                <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center"></i>
                <span>Log Out</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto max-w-[1400px] mx-auto w-full">
        
        <header class="flex justify-between items-start mb-8">
            <div>
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-6 bg-black rounded"></div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Storefront Collection</h1>
                </div>
                <p class="text-[11px] text-[#00C853] font-bold tracking-wide mt-0.5 ml-3.5">EXPLORE ELITE FOOTWEAR ARRIVALS</p>
            </div>
            <div class="flex items-center gap-6 text-slate-700">
                <button class="p-1 hover:text-[#00C853] transition-colors">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                </button>
                <a href="cart.php" class="p-1 hover:text-[#00C853] transition-colors relative">
                    <i class="fa-solid fa-bag-shopping text-lg"></i>
                    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                        <span class="absolute -top-1 -right-2 bg-red-500 text-white font-extrabold text-[9px] w-4 h-4 rounded-full flex items-center justify-center animate-pulse">
                            <?php echo count($_SESSION['cart']); ?>
                        </span>
                    <?php endif; ?>
                </a>
            </div>
        </header>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'added'): ?>
            <div class="mb-6 max-w-md bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm text-xs font-semibold">
                <i class="fa-solid fa-circle-check text-base text-[#00C853]"></i>
                <span>Boot successfully added to your shopping cart!</span>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12 items-center justify-items-center w-full mt-4">
            
            <?php 
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    
                    // Parse price float into separate Dollar and Cents components
                    $priceParts = explode('.', sprintf('%01.2f', $row['price']));
                    $dollars = $priceParts[0];
                    $cents = $priceParts[1];
                    
                    // Apply specialized class scaling modifications depending on brand profiles
                    $imageName = $row['image'];
                    $customImageStyles = "w-[85%] h-[85%] object-contain scale-[1.15]"; // Balanced safe default scale
                    
                    if (strpos($imageName, 'Puma Future Z 4.4 MG') !== false) {
                        $customImageStyles = "w-[85%] h-[85%] object-contain scale-[1.3] object-left";
                    } elseif (strpos($imageName, 'Nike Mercurial Vapor 16 Elite') !== false) {
                        $customImageStyles = "w-[85%] h-[85%] object-contain scale-125";
                    } elseif (strpos($imageName, 'Adidas F50 Elite Fast Reborn') !== false) {
                        $customImageStyles = "w-[85%] h-[85%] object-contain scale-110";
                    } elseif (strpos($imageName, 'Adidas F50 Elite.png') !== false) {
                        $customImageStyles = "w-[85%] h-[85%] object-contain scale-[1.3] object-bottom";
                    } elseif (strpos($imageName, 'Nike Zoom Mercurial Vapor 15 Elite') !== false || strpos($imageName, 'Puma Future 7 Ultimate') !== false) {
                        $customImageStyles = "w-[85%] h-[85%] object-contain scale-125";
                    }
                    ?>
                    
                    <form action="cart_process.php" method="POST" class="w-full max-w-[280px]">
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                        <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                        <input type="hidden" name="image" value="<?php echo htmlspecialchars($row['image']); ?>">

                        <div class="flex flex-col items-center group cursor-pointer w-full bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300">
                            <div class="w-44 h-44 rounded-full overflow-hidden bg-slate-50 flex items-center justify-center shadow-inner transition-transform group-hover:scale-105 duration-300 relative">
                                <img src="../images/<?php echo htmlspecialchars($row['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($row['name']); ?>" 
                                     class="<?php echo $customImageStyles; ?>">
                            </div>
                            <div class="mt-4 text-center text-sm font-semibold tracking-wide w-full px-2">
                                <div class="text-slate-800 font-bold truncate mb-1" title="<?php echo htmlspecialchars($row['name']); ?>">
                                    <?php echo htmlspecialchars($row['name']); ?>
                                </div>
                                <div class="text-[#00C853] font-extrabold text-base mb-3">
                                    $<?php echo $dollars; ?>.<span class="text-xs align-super font-bold"><?php echo $cents; ?></span>
                                </div>
                            </div>

                            <button type="submit" name="add_to_cart" class="w-full py-2.5 bg-[#00C853] hover:bg-[#00b049] text-white text-xs font-bold tracking-wider rounded-xl transition-all duration-200 transform group-hover:translate-y-0 opacity-90 group-hover:opacity-100 shadow-sm flex items-center justify-center gap-2">
                                <i class="fa-solid fa-cart-plus text-sm"></i>
                                <span>ADD TO CART</span>
                            </button>
                        </div>
                    </form>

                    <?php
                }
            } else {
                echo "<p class='col-span-3 text-center text-gray-400 font-medium py-12'>No inventory elements located in the storefront registry.</p>";
            }
            // Terminate system connections safely
            mysqli_close($conn);
            ?>

        </div>
    </main>

</body>
</html>