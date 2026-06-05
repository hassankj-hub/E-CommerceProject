<?php
// 1. Initialize user state validation matrix
session_start();

// 2. Import core database link configurations (Looking directly inside the same php/ folder)
include('test_db.php');

// 3. Query to load the initial total count for page initialization
$query = "SELECT * FROM sales_products ORDER BY id DESC LIMIT 6 OFFSET 0";
$result = mysqli_query($conn, $query);
$total_sales = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>SOCCERSHOES XI - Sales Product Dashboard</title>
  
  <script src="https://cdn.tailwindcss.com"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <style>
    body { font-family: 'Montserrat', sans-serif; }
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
            <h4 class="font-bold text-xs tracking-tight leading-tight">
              <?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Minstriker'; ?>
            </h4>
            <span class="text-[10px] text-green-100 font-medium block max-w-[140px] truncate">
              <?php echo isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : 'striker@soccershoes.com'; ?>
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
        <a href="../php/top-selling.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
          <i class="fa-solid fa-chart-bar text-base w-6 text-center"></i>
          <span class="font-semibold text-xs tracking-wide">Top-Selling Items</span>
        </a>
        <a href="../php/sales-product.php" class="flex items-center gap-4 px-5 py-3.5 bg-white text-[#00C853] rounded-2xl shadow-md font-bold text-xs tracking-wide relative">
          <div class="absolute left-0 top-1/4 bottom-1/4 w-1 bg-[#00C853] rounded-r"></div>
          <i class="fa-solid fa-cart-shopping text-base w-6 text-center"></i>
          <span>Sales Product</span>
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

  <main class="flex-1 p-8 overflow-y-auto max-w-[1400px] mx-auto w-full">
    <header class="flex justify-between items-start mb-8">
      <div>
        <div class="flex items-center gap-2">
          <div class="w-1.5 h-6 bg-black rounded"></div>
          <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Sales Product</h1>
        </div>
        <p class="text-[11px] text-[#00C853] font-bold tracking-wide mt-0.5 ml-3.5"><span id="sales-count"><?php echo $total_sales; ?></span> Sales on Current Page</p>
      </div>
      <div class="flex items-center gap-8">
        <button class="text-slate-700 hover:text-black transition mt-1">
          <i class="fa-solid fa-magnifying-glass text-lg"></i>
        </button>
        <span class="text-emerald-500 font-extrabold tracking-widest text-sm">SOCCERSHOES XI</span>
      </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center mb-8">
      
      <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 lg:col-span-7 h-[25rem] flex flex-col justify-between">
        <div class="flex justify-center gap-6 text-[11px] font-semibold text-slate-400">
          <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span> Series 1</span>
          <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-slate-200"></span> Series 2</span>
          <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-[#00C853]"></span> Series 3</span>
        </div>
        <div class="relative flex-1 mt-4 flex flex-col justify-between text-[10px] text-slate-400 font-semibold">
          <div class="border-b border-slate-100 w-full pb-1 flex justify-between"><span>50</span><span class="w-full ml-4 border-t border-slate-100/70 mt-2"></span></div>
          <div class="border-b border-slate-100 w-full pb-1 flex justify-between"><span>40</span><span class="w-full ml-4 border-t border-slate-100/70 mt-2"></span></div>
          <div class="border-b border-slate-100 w-full pb-1 flex justify-between"><span>30</span><span class="w-full ml-4 border-t border-slate-100/70 mt-2"></span></div>
          <div class="border-b border-slate-100 w-full pb-1 flex justify-between"><span>20</span><span class="w-full ml-4 border-t border-slate-100/70 mt-2"></span></div>
          <div class="border-b border-slate-100 w-full pb-1 flex justify-between"><span>10</span><span class="w-full ml-4 border-t border-slate-100/70 mt-2"></span></div>
          <div class="w-full pb-1 flex justify-between"><span>0</span><span class="w-full ml-8 mt-2"></span></div>
          <svg class="absolute inset-0 top-2 left-6 w-[calc(100%-1.5rem)] h-[calc(100%-1.5rem)]" viewBox="0 0 100 50" preserveAspectRatio="none">
            <path d="M 5 45 L 28 40 L 50 12 L 72 20 L 95 18" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M 5 42 L 28 35 L 50 30 L 72 38 L 95 24" fill="none" stroke="#e2e8f0" stroke-width="1" stroke-linecap="round"/>
            <path d="M 5 32 L 28 18 L 50 24 L 72 8 L 95 6" fill="none" stroke="#00C853" stroke-width="2" stroke-linecap="round"/>
            <circle cx="28" cy="18" r="1.2" fill="#00C853"/><circle cx="50" cy="24" r="1.2" fill="#00C853"/><circle cx="72" cy="8" r="1.2" fill="#00C853"/>
          </svg>
        </div>
        <div class="flex justify-between text-[10px] text-slate-400 font-semibold pl-6 mt-1">
          <span>Item 1</span><span>Item 2</span><span>Item 3</span><span>Item 4</span><span>Item 5</span>
        </div>
      </div>

      <div class="lg:col-span-5 space-y-3.5 w-full">
        
        <a href="../php/top-selling.php" class="block bg-white border border-slate-100 p-4 rounded-3xl flex items-center gap-5 shadow-sm hover:shadow-md hover:border-[#00C853]/30 transition duration-300 group">
          <div class="flex -space-x-4 shrink-0 pl-2">
            <div class="w-12 h-12 rounded-full bg-slate-50 border-2 border-white overflow-hidden flex items-center justify-center shadow-sm"><img src="../images/Adidas ACE 16.1 Primeknit.png" alt="Adidas ACE" class="w-[90%] h-[90%] object-contain"></div>
            <div class="w-12 h-12 rounded-full bg-slate-50 border-2 border-white overflow-hidden flex items-center justify-center shadow-sm"><img src="../images/Adidas ACE 16+ Purecontrol.png" alt="Adidas ACE Plus" class="w-[90%] h-[90%] object-contain"></div>
            <div class="w-12 h-12 rounded-full bg-slate-50 border-2 border-white overflow-hidden flex items-center justify-center shadow-sm"><img src="../images/Adidas F50 Elite Fast Reborn.png" alt="Adidas F50 Reborn" class="w-[90%] h-[90%] object-contain"></div>
          </div>
          <div class="min-w-0">
            <h5 class="text-sm font-bold text-slate-800 tracking-tight group-hover:text-[#00C853] transition">Top-Selling Collections</h5>
            <p class="text-[11px] text-slate-400 font-medium leading-tight mt-0.5">Highlight of our most popular premium pieces.</p>
          </div>
        </a>

        <div class="bg-[#00C853] text-white p-4 rounded-3xl flex items-center gap-5 shadow-md">
          <div class="flex -space-x-4 shrink-0 pl-2">
            <div class="w-12 h-12 rounded-full bg-white border border-white/20 overflow-hidden flex items-center justify-center shadow-inner"><img src="../images/Adidas F50 Elite.png" alt="Adidas F50 Elite" class="w-[85%] h-[85%] object-contain"></div>
            <div class="w-12 h-12 rounded-full bg-white border border-white/20 overflow-hidden flex items-center justify-center shadow-inner"><img src="../images/Adidas Predator 24 League.png" alt="Adidas Predator" class="w-[85%] h-[85%] object-contain"></div>
            <div class="w-12 h-12 rounded-full bg-white border border-white/20 overflow-hidden flex items-center justify-center shadow-inner"><img src="../images/Nike Mercurial Vapor 16 Elite.png" alt="Nike Vapor Elite" class="w-[85%] h-[85%] object-contain"></div>
          </div>
          <div class="min-w-0">
            <h5 class="text-sm font-bold tracking-tight">Trending Now</h5>
            <p class="text-[11px] text-green-100 font-medium leading-tight mt-0.5">Styles currently driving high engagement and sales.</p>
          </div>
        </div>

        <a href="../php/trending.php" class="block bg-white border border-slate-100 p-4 rounded-3xl flex items-center gap-5 shadow-sm hover:shadow-md hover:border-[#00C853]/30 transition duration-300 group">
          <div class="flex -space-x-4 shrink-0 pl-2">
            <div class="w-12 h-12 rounded-full bg-slate-50 border-2 border-white overflow-hidden flex items-center justify-center shadow-sm"><img src="../images/Nike Zoom Mercurial Vapor 15 Elite.png" alt="Nike Zoom Mercurial Vapor 15 Elite" class="w-[90%] h-[90%] object-contain" onerror="this.src='../images/Nike Mercurial Vapor 16 Elite.png'"></div>
            <div class="w-12 h-12 rounded-full bg-slate-50 border-2 border-white overflow-hidden flex items-center justify-center shadow-sm"><img src="../images/Puma Future 7 Ultimate.png" alt="Puma Future" class="w-[90%] h-[90%] object-contain"></div>
            <div class="w-12 h-12 rounded-full bg-slate-50 border-2 border-white overflow-hidden flex items-center justify-center shadow-sm"><img src="../images/Nike Mercurial Superfly 9 Academy.png" alt="Nike Zoom Mercurial Superfly 9 Academy" class="w-[90%] h-[90%] object-contain"></div>
          </div>
          <div class="min-w-0">
            <h5 class="text-sm font-bold text-slate-800 tracking-tight group-hover:text-[#00C853] transition">Best Performers</h5>
            <p class="text-[11px] text-slate-400 font-medium leading-tight mt-0.5">Cleats that consistently lead our sales charts.</p>
          </div>
        </a>

      </div>
    </div>

    <div class="flex justify-between items-center mb-6">
      <div class="flex gap-2">
        <button id="filter-all" onclick="updateDashboardState('all', 1)" class="filter-btn px-5 py-1.5 text-[11px] font-bold rounded-full shadow-sm tracking-wide transition bg-[#00C853] text-white">All Sales</button>
        <button id="filter-pending" onclick="updateDashboardState('pending', 1)" class="filter-btn px-5 py-1.5 text-[11px] font-bold rounded-full shadow-sm tracking-wide transition border border-slate-300 text-slate-400 hover:bg-slate-100">Pending</button>
        <button id="filter-completed" onclick="updateDashboardState('completed', 1)" class="filter-btn px-5 py-1.5 text-[11px] font-bold rounded-full shadow-sm tracking-wide transition border border-slate-300 text-slate-400 hover:bg-slate-100">Completed</button>
      </div>
    </div>

    <div class="border-t border-slate-100 pt-6">
      <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
        <div class="flex items-center gap-3 bg-white border border-slate-200/80 px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 shadow-sm">
          <div class="flex items-center gap-2">
            <i class="fa-regular fa-calendar-days text-slate-400"></i>
            <span>25 July 2026</span>
          </div>
          <span class="text-slate-400 font-normal mx-1">To</span>
          <div class="flex items-center gap-2">
            <i class="fa-regular fa-calendar-days text-slate-400"></i>
            <span>29 July 2026</span>
          </div>
          <i class="fa-solid fa-chevron-down text-[10px] ml-2 text-slate-400"></i>
        </div>

        <div class="flex items-center gap-1 text-xs font-semibold text-slate-400">
          <button onclick="navigatePage(-1)" class="w-7 h-7 flex items-center justify-center rounded hover:bg-slate-100 text-slate-300"><i class="fa-solid fa-chevron-left text-[10px]"></i></button>
          
          <button id="page-1" onclick="updateDashboardState(currentFilter, 1)" class="page-btn w-7 h-7 flex items-center justify-center rounded bg-slate-900 text-white shadow-sm">1</button>
          <button id="page-2" onclick="updateDashboardState(currentFilter, 2)" class="page-btn w-7 h-7 flex items-center justify-center rounded hover:bg-slate-100">2</button>
          <button id="page-3" onclick="updateDashboardState(currentFilter, 3)" class="page-btn w-7 h-7 flex items-center justify-center rounded hover:bg-slate-100">3</button>
          
          <button onclick="navigatePage(1)" class="w-7 h-7 flex items-center justify-center rounded hover:bg-slate-100"><i class="fa-solid fa-chevron-right text-[10px]"></i></button>
        </div>
      </div>

      <div id="product-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php 
        if ($total_sales > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $image_path = htmlspecialchars($row['image_url']);
                // Checks if the column entry string lacks folder stepouts and dynamically formats it
                if (strpos($image_path, '../') === false && strpos($image_path, 'http') === false) {
                    $image_path = '../images/' . $image_path;
                }
                ?>
                <div class="bg-white border border-slate-100 rounded-3xl p-4 shadow-sm group hover:shadow-md transition duration-300">
                  <div class="bg-white rounded-2xl overflow-hidden aspect-[4/3] flex items-center justify-center p-2 relative">
                    <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>" class="w-full h-full object-contain transform group-hover:scale-105 transition duration-300">
                  </div>
                  <div class="mt-4 flex items-center justify-between px-1">
                    <div class="flex items-center gap-2">
                      <span class="text-sm font-extrabold text-[#00C853]">$<?php echo number_format($row['price'], 2); ?></span>
                      <span class="text-slate-300 text-xs">|</span>
                      <h3 class="text-xs font-bold text-slate-800 tracking-tight"><?php echo htmlspecialchars($row['product_name']); ?></h3>
                    </div>
                  </div>
                </div>
                <?php
            }
        } else {
            echo '<div class="col-span-full py-12 text-center text-slate-400 font-semibold text-sm">No matchday entries logged under this category filter.</div>';
        }
        ?>
      </div>
    </div>
  </main>

  <script>
  let currentFilter = 'all';
  let currentPage = 1;

  function updateDashboardState(category, pageNumber) {
      currentFilter = category;
      currentPage = pageNumber;
      
      const grid = document.getElementById('product-grid');
      grid.style.opacity = '0.4';
      
      fetch(`fetch-sales.php?filter=${currentFilter}&page=${currentPage}`)
          .then(response => response.text())
          .then(htmlMarkup => {
              grid.innerHTML = htmlMarkup;
              grid.style.opacity = '1';
              
              const itemsFound = grid.querySelectorAll('.group').length;
              document.getElementById('sales-count').innerText = itemsFound;
              
              document.querySelectorAll('.filter-btn').forEach(btn => {
                  btn.className = "filter-btn px-5 py-1.5 text-[11px] font-bold rounded-full shadow-sm tracking-wide transition border border-slate-300 text-slate-400 hover:bg-slate-100";
              });
              document.getElementById(`filter-${currentFilter}`).className = "filter-btn px-5 py-1.5 text-[11px] font-bold rounded-full shadow-sm tracking-wide transition bg-[#00C853] text-white";
              
              document.querySelectorAll('.page-btn').forEach(btn => {
                  btn.className = "page-btn w-7 h-7 flex items-center justify-center rounded hover:bg-slate-100 text-slate-400";
              });
              const activePageBtn = document.getElementById(`page-${currentPage}`);
              if(activePageBtn) {
                  activePageBtn.className = "page-btn w-7 h-7 flex items-center justify-center rounded bg-slate-900 text-white shadow-sm";
              }
          })
          .catch(err => {
              console.error('AJAX Error Execution:', err);
              grid.style.opacity = '1';
          });
  }

  function navigatePage(direction) {
      let targetPage = currentPage + direction;
      if (targetPage >= 1 && targetPage <= 3) {
          updateDashboardState(currentFilter, targetPage);
      }
  }
  </script>
</body>
</html>