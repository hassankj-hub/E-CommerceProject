<?php
// Initialize session memory tracking matrix
session_start();

// Import local environment database connection links
include('test_db.php');

// Fetch trending cleats from your testdb table
$query = "SELECT * FROM sales_products WHERE status = 'trending' OR status = 'all' ORDER BY id DESC LIMIT 6";
$result = mysqli_query($conn, $query);
$total_trending = mysqli_num_rows($result);

// FALLBACK MATRIX: Prepended directory stepouts standard paths directly to array images
$fallback_shoes = [
    [
        "product_name" => "Nike Zoom Mercurial Vapor 15 Elite",
        "price" => 250.00,
        "image_url" => "../images/Nike Zoom Mercurial Vapor 15 Elite.png",
        "badge" => "Search Volume +180%",
        "badge_style" => "bg-rose-100 text-rose-600",
        "desc" => "High velocity viral traction across social engines."
    ],
    [
        "product_name" => "Puma Future 7 Ultimate",
        "price" => 240.00,
        "image_url" => "../images/Puma Future 7 Ultimate.png",
        "badge" => "Cart Adds +94%",
        "badge_style" => "bg-amber-100 text-amber-700",
        "desc" => "Sudden localized conversion surge in global hubs."
    ],
    [
        "product_name" => "Nike Mercurial Superfly 9 Academy",
        "price" => 120.00,
        "image_url" => "../images/Nike Mercurial Superfly 9 Academy.png",
        "badge" => "Trending #1",
        "badge_style" => "bg-emerald-100 text-emerald-700",
        "desc" => "Massive breakout demand following recent player matchdays."
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SOCCERSHOES XI - Trending Products</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style> body { font-family: 'Montserrat', sans-serif; } </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex">

  <aside class="w-72 bg-[#00C853] text-white flex flex-col justify-between p-6 shrink-0 rounded-r-[2rem] shadow-xl">
    <div>
      <div class="flex items-center justify-between mb-10 mt-2">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 rounded-full border-2 border-white bg-white overflow-hidden flex items-center justify-center shadow-sm">
            <img src="../images/logo.png?v=1" alt="SoccerShoes XI Logo" class="w-[85%] h-[85%] object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="hidden w-full h-full bg-emerald-700 text-white flex items-center justify-center font-bold text-sm">SS</div>
          </div>
          <div>
            <h4 class="font-bold text-xs tracking-tight leading-tight">
              <?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'BootsXI'; ?>
            </h4>
            <span class="text-[10px] text-green-100 font-medium block max-w-[140px] truncate">
              <?php echo isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : 'Boots@gmail.com'; ?>
            </span>
          </div>
        </div>
        <i class="fa-solid fa-chevron-down text-xs opacity-80"></i>
      </div>

      <nav class="space-y-1.5">
        <a href="../php/homepage.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
          <i class="fa-solid fa-house text-base w-6 text-center"></i><span class="font-semibold text-xs tracking-wide">Home</span>
        </a>
        <a href="../php/top-selling.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
          <i class="fa-solid fa-chart-bar text-base w-6 text-center"></i><span class="font-semibold text-xs tracking-wide">Top-Selling Items</span>
        </a>
        <a href="../php/sales-product.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
          <i class="fa-solid fa-cart-shopping text-base w-6 text-center"></i><span class="font-semibold text-xs tracking-wide">Sales Product</span>
        </a>
        <a href="../php/statistic.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
          <i class="fa-solid fa-chart-line text-base w-6 text-center"></i><span class="font-semibold text-xs tracking-wide">Statistic</span>
        </a>
        
        <a href="../php/trending.php" class="flex items-center gap-4 px-5 py-3.5 bg-white text-[#00C853] rounded-2xl shadow-md font-bold text-xs tracking-wide relative">
          <div class="absolute left-0 top-1/4 bottom-1/4 w-1 bg-[#00C853] rounded-r"></div>
          <i class="fa-solid fa-border-all text-base w-6 text-center"></i>
          <span>Trending Products</span>
        </a>
        
        <a href="../php/promo.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
          <i class="fa-solid fa-tag text-base w-6 text-center"></i><span class="font-semibold text-xs tracking-wide">Promo</span>
        </a>
        <a href="../php/user.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
          <i class="fa-solid fa-user text-base w-6 text-center"></i><span class="font-semibold text-xs tracking-wide">User</span>
        </a>
      </nav>
    </div>
    
    <div class="border-t border-white/20 pt-4 space-y-1">
      <a href="#" class="text-[11px] opacity-75 flex items-center gap-4 px-4 py-2 hover:opacity-100 transition"><i class="fa-solid fa-gear w-5 text-center"></i>Settings</a>
      <a href="../php/logout.php" class="text-[11px] opacity-75 flex items-center gap-4 px-4 py-2 hover:opacity-100 transition"><i class="fa-solid fa-arrow-right-from-bracket w-5 text-center"></i>Log Out</a>
    </div>
  </aside>

  <main class="flex-1 p-8 overflow-y-auto max-w-[1400px] mx-auto w-full">
    <header class="mb-8">
      <div class="flex items-center gap-2">
        <div class="w-1.5 h-6 bg-black rounded"></div>
        <h1 class="text-2xl font-[800] text-slate-900 tracking-tight">Trending Cleats Feed</h1>
      </div>
      <p class="text-[11px] text-[#00C853] font-bold tracking-wide mt-0.5 ml-3.5 uppercase">
        <?php echo ($total_trending > 0) ? $total_trending : count($fallback_shoes); ?> Spiking Demand Channels
      </p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <?php 
      if ($total_trending > 0) {
          // A: If database records are found, render the dynamic layout loops
          $counter = 0;
          while($row = mysqli_fetch_assoc($result)) {
              $counter++;
              $badgeText = ($counter % 2 == 0) ? "Cart Adds +94%" : "Search Volume +180%";
              $badgeColor = ($counter % 2 == 0) ? "bg-amber-100 text-amber-700" : "bg-rose-100 text-rose-600";
              
              // Formatting database column configurations securely to append file stepouts
              $image_path = htmlspecialchars($row['image_url']);
              if (strpos($image_path, '../') === false && strpos($image_path, 'http') === false) {
                  $image_path = '../images/' . $image_path;
              }
              ?>
              <div class="bg-white border border-slate-100 rounded-2xl p-5 flex gap-4 items-center shadow-sm hover:shadow-md transition duration-300">
                <div class="w-32 h-24 bg-slate-50 rounded-xl overflow-hidden p-1 flex items-center justify-center shrink-0">
                  <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>" class="w-full h-full object-contain">
                </div>
                
                <div class="flex flex-col flex-1 min-w-0">
                  <div class="flex mb-1">
                    <span class="text-[9px] <?php echo $badgeColor; ?> font-[800] px-2 py-0.5 rounded uppercase tracking-wider"><?php echo $badgeText; ?></span>
                  </div>
                  <h4 class="text-xs font-[700] text-slate-900 tracking-tight truncate"><?php echo htmlspecialchars($row['product_name']); ?></h4>
                  <div class="mt-0.5 flex flex-col">
                    <span class="text-[11px] font-[800] text-[#00C853]">$<?php echo number_format($row['price'], 2); ?></span>
                    <p class="text-[10px] text-slate-400 font-[500] leading-tight mt-0.5">High velocity viral traction across social engines.</p>
                  </div>
                </div>
              </div>
              <?php
          }
      } else {
          // B: Standalone fallback loops using safe path array items
          foreach ($fallback_shoes as $shoe) {
              ?>
              <div class="bg-white border border-slate-100 rounded-2xl p-5 flex gap-4 items-center shadow-sm hover:shadow-md transition duration-300">
                <div class="w-32 h-24 bg-slate-50 rounded-xl overflow-hidden p-1 flex items-center justify-center shrink-0">
                  <img src="<?php echo $shoe['image_url']; ?>" alt="<?php echo $shoe['product_name']; ?>" class="w-full h-full object-contain">
                </div>
                
                <div class="flex flex-col flex-1 min-w-0">
                  <div class="flex mb-1">
                    <span class="text-[9px] <?php echo $shoe['badge_style']; ?> font-[800] px-2 py-0.5 rounded uppercase tracking-wider"><?php echo $shoe['badge']; ?></span>
                  </div>
                  <h4 class="text-xs font-[700] text-slate-900 tracking-tight truncate"><?php echo $shoe['product_name']; ?></h4>
                  <div class="mt-0.5 flex flex-col">
                    <span class="text-[11px] font-[800] text-[#00C853]">$<?php echo number_format($shoe['price'], 2); ?></span>
                    <p class="text-[10px] text-slate-400 font-[500] leading-tight mt-0.5 max-w-[320px]"><?php echo $shoe['desc']; ?></p>
                  </div>
                </div>
              </div>
              <?php
          }
      }
      mysqli_close($conn);
      ?>
    </div>
  </main>
</body>
</html>