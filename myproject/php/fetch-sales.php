<?php
// Initialize session memory tracking
session_start();

// Import core database link configurations
include('test_db.php');

// 1. Capture filter and page variables securely
$filter = isset($_GET['filter']) ? mysqli_real_escape_string($conn, $_GET['filter']) : 'all';
$page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// Define how many shoes you want to display per page slice
$limit = 6; 
$offset = ($page - 1) * $limit;

// 2. Build the conditional MySQL query statement with pagination parameters
if ($filter === 'pending' || $filter === 'completed') {
    $query = "SELECT * FROM sales_products WHERE status = '$filter' ORDER BY id DESC LIMIT $limit OFFSET $offset";
} else {
    $query = "SELECT * FROM sales_products ORDER BY id DESC LIMIT $limit OFFSET $offset";
}

$result = mysqli_query($conn, $query);
$total_sales = mysqli_num_rows($result);

// OUTPUT MATRIX: Renders card components back to the JavaScript engine
if ($total_sales > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="bg-white border border-slate-100 rounded-3xl p-4 shadow-sm group hover:shadow-md transition duration-300">
          <div class="bg-white rounded-2xl overflow-hidden aspect-[4/3] flex items-center justify-center p-2 relative">
            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>" class="w-full h-full object-contain transform group-hover:scale-105 transition duration-300">
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

// Safely close the database pipeline connection
mysqli_close($conn);
?>