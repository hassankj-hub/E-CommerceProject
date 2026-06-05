<?php
// 1. Initialize user state validation matrix
session_start();

// 2. Import core database link configurations
include('test_db.php');

// 3. Query to load dynamic top-selling items ordered by performance metrics or configuration sequence
$query = "SELECT * FROM sales_products ORDER BY id DESC LIMIT 6";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>SOCCERSHOES XI - Top-Selling Items</title>
  
  <!-- Tailwind CSS Engine Import -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- FontAwesome Icon Package Matrix -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Typography Hub Integration -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <style>
    body { font-family: 'Montserrat', sans-serif; }
  </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex">

  <!-- SIDEBAR SYSTEM NAVIGATION INTERFACE AREA -->
  <aside class="w-72 bg-[#00C853] text-white flex flex-col justify-between p-6 shrink-0 rounded-r-[2rem] shadow-xl">
    <div>
      <!-- BRAND LOGO & DYNAMIC USER PROFILE SECTION -->
      <div class="flex items-center justify-between mb-10 mt-2">
        <div class="flex items-center gap-3">
          <div class="relative">
            <div class="w-12 h-12 rounded-full border-2 border-white bg-white overflow-hidden flex items-center justify-center shadow-sm">
              <!-- Fixed path step out to locate your brand logo asset -->
              <img src="../images/logo.png?v=1" alt="SoccerShoes XI Logo" class="w-[85%] h-[85%] object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
              <div class="hidden w-full h-full bg-emerald-700 text-white flex items-center justify-center font-bold text-sm">SS</div>
            </div>
          </div>
          <div>
            <h4 class="font-bold text-xs tracking-tight leading-tight">
              <?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Striker'; ?>
            </h4>
            <span class="text-[10px] text-green-100 font-medium block max-w-[140px] truncate">
              <?php echo isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : 'Boots@gmail.com'; ?>
            </span>
          </div>
        </div>
        <i class="fa-solid fa-chevron-down text-xs cursor-pointer opacity-80 hover:opacity-100"></i>
      </div>

      <!-- LINK DIRECTORY NAVIGATION ROUTER MENU BAR -->
      <nav class="space-y-1.5">
        <a href="../php/homepage.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
          <i class="fa-solid fa-house text-base w-6 text-center"></i>
          <span class="font-semibold text-xs tracking-wide">Home</span>
        </a>
        <a href="../php/top-selling.php" class="flex items-center gap-4 px-5 py-3.5 bg-white text-[#00C853] rounded-2xl shadow-md font-bold text-xs tracking-wide relative">
          <div class="absolute left-0 top-1/4 bottom-1/4 w-1 bg-[#00C853] rounded-r"></div>
          <i class="fa-solid fa-chart-bar text-base w-6 text-center"></i>
          <span>Top-Selling Items</span>
        </a>
        <a href="../php/sales-product.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
          <i class="fa-solid fa-cart-shopping text-base w-6 text-center"></i>
          <span class="font-semibold text-xs tracking-wide">Sales Product</span>
        </a>
        <a href="../php/statistic.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
          <i class="fa-solid fa-chart-line text-base w-6 text-center"></i>
          <span class="font-semibold text-xs tracking-wide">Statistic</span>
        </a>
        <a href="../php/trending.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
          <i class="fa-solid fa-border-all text-base w-6 text-center"></i>
          <span class="font-semibold text-xs tracking-wide">Trending Products</span>
        </a>
        <a href="../php/promo.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
          <i class="fa-solid fa-tag text-base w-6 text-center"></i>
          <span class="font-semibold text-xs tracking-wide">Promo</span>
        </a>
        <a href="../php/user.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
          <i class="fa-solid fa-user text-base w-6 text-center"></i>
          <span class="font-semibold text-xs tracking-wide">User</span>
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

  <!-- MAIN DATA CONTENT CONSOLE DASHBOARD VIEW -->
  <main class="flex-1 p-8 overflow-y-auto max-w-[1400px] mx-auto w-full">
    <header class="flex justify-between items-start mb-8">
      <div>
        <div class="flex items-center gap-2">
          <div class="w-1.5 h-6 bg-black rounded"></div>
          <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Top-Selling Items Catalog</h1>
        </div>
        <p class="text-[11px] text-[#00C853] font-bold tracking-wide mt-0.5 ml-3.5">CRITICAL PERFORMANCE RANKINGS</p>
      </div>
      <div class="flex items-center gap-8">
        <span class="text-emerald-500 font-extrabold tracking-widest text-sm">SOCCERSHOES XI</span>
      </div>
    </header>

    <!-- LIVE LEADERBOARD DISPLAY CONTAINER -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
      <div class="p-6 border-b border-slate-100 flex justify-between items-center">
        <h3 class="text-xs font-extrabold text-slate-900 tracking-wide uppercase">Velocity Distribution Leaderboard</h3>
        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-3 py-1 rounded-full">Realtime Feeds</span>
      </div>
      
      <div class="divide-y divide-slate-100">
        <?php 
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                // Generate consistent mockup statistics since units dispatched are dashboard-only velocity markers
                $mock_units = rand(400, 1300);
                
                // Formats paths if database stores direct values (e.g. "Adidas F50.png") to correctly step out to your file layout
                $image_path = htmlspecialchars($row['image_url']);
                if (strpos($image_path, '../') === false && strpos($image_path, 'http') === false) {
                    $image_path = '../images/' . $image_path;
                }
                ?>
                <div class="p-4 flex items-center justify-between hover:bg-slate-50/50 transition">
                  <div class="flex items-center gap-4">
                    <div class="w-16 h-12 bg-slate-50 rounded-xl overflow-hidden p-1 flex items-center justify-center border border-slate-100">
                      <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>" class="w-full h-full object-contain">
                    </div>
                    <div>
                      <h4 class="text-xs font-bold text-slate-900"><?php echo htmlspecialchars($row['product_name']); ?></h4>
                      <p class="text-[10px] text-slate-400 font-medium">Performance Track Configuration Matrix</p>
                    </div>
                  </div>
                  <div class="text-right">
                    <span class="text-xs font-extrabold text-slate-900 block">$<?php echo number_format($row['price'], 2); ?></span>
                    <span class="text-[9px] text-[#00C853] font-bold"><?php echo number_format($mock_units); ?> Units Dispatched</span>
                  </div>
                </div>
                <?php
            }
        } else {
            echo '<div class="p-8 text-center text-slate-400 font-semibold text-sm">No dynamic catalog profiles initialized in testdb.</div>';
        }
        ?>
      </div>
    </div>
  </main>

</body>
</html>