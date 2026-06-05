<?php
// 1. Initialize user session memory tracking
session_start();

// Redirect to product dashboard if the user attempts to access checkout with an empty bag
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: products.php");
    exit;
}

// 2. Handle default fallback variables matching your application context
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'BootsXI';
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : 'Boots@gmail.com';

// Calculate current transaction values
$total_amount = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_amount += $item['price'] * $item['quantity'];
}

$grandParts = explode('.', sprintf('%01.2f', $total_amount));

// ================= PROCESSING POST ORDER SUBMISSION =================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    // Collect order details securely
    $fullName = isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : '';
    $phone = isset($_POST['phone_number']) ? htmlspecialchars($_POST['phone_number']) : '';
    $address = isset($_POST['shipping_address']) ? htmlspecialchars($_POST['shipping_address']) : '';
    $paymentMethod = isset($_POST['payment_method']) ? htmlspecialchars($_POST['payment_method']) : 'card';
    
    /* 
       DATABASE PERSISTENCE ARCHITECTURE:
       If you want to store this in your 'testdb' database, you would add your SQL logic here:
       
       include 'db_connect.php';
       $stmt = $conn->prepare("INSERT INTO orders (user, total, phone, address, payment) VALUES (?, ?, ?, ?, ?)");
       $stmt->bind_param("sdsss", $user_name, $total_amount, $phone, $address, $paymentMethod);
       $stmt->execute();
    */

    // Flash order parameters to session to use on success display banner screen
    $_SESSION['last_order'] = [
        'id' => 'SX' . rand(100000, 999999),
        'total' => $total_amount,
        'customer' => $fullName,
        'email' => $user_email
    ];

    // Wipe active shopping basket data state cleanly 
    unset($_SESSION['cart']);
    $show_success = true;
} else {
    $show_success = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCCERSHOES XI - Checkout Secure Terminal</title>
    
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

    <!-- ================= LEFT SIDEBAR ================= -->
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
                <a href="../php/products.php" class="flex items-center gap-4 px-4 py-3 rounded-xl transition hover:bg-white/10 opacity-80 hover:opacity-100">
                    <i class="fa-solid fa-shoe-prints text-base w-6 text-center"></i>
                    <span class="font-semibold text-xs tracking-wide">Products</span>
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

    <!-- ================= MAIN CORE SCREEN WORKPLACE INTERFACE ================= -->
    <main class="flex-1 p-8 overflow-y-auto max-w-[1400px] mx-auto w-full flex flex-col justify-start">
        
        <?php if ($show_success): ?>
            <!-- ================= STATE A: ORDER PLACED SUCCESS INTERFACE ================= -->
            <div class="m-auto max-w-xl w-full bg-white border border-slate-100 rounded-3xl p-10 shadow-lg text-center flex flex-col items-center justify-center animate-fade-in">
                <div class="w-20 h-20 bg-emerald-50 text-[#00C853] flex items-center justify-center rounded-full mb-6 shadow-sm border border-emerald-100">
                    <i class="fa-solid fa-circle-check text-4xl"></i>
                </div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight mb-2">Order Confirmed!</h2>
                <p class="text-xs text-slate-400 max-w-sm mb-6 leading-relaxed">
                    Thank you for shopping with <span class="font-bold text-[#00C853]">SOCCERSHOES XI</span>. Your processing request completed flawlessly.
                </p>
                
                <div class="w-full bg-slate-50 border border-slate-200/60 rounded-2xl p-5 text-left text-xs mb-8 space-y-2.5">
                    <div class="flex justify-between"><span class="text-slate-400 font-medium">Order Number:</span><span class="font-extrabold text-slate-700"><?php echo $_SESSION['last_order']['id']; ?></span></div>
                    <div class="flex justify-between"><span class="text-slate-400 font-medium">Customer:</span><span class="font-bold text-slate-700"><?php echo $_SESSION['last_order']['customer']; ?></span></div>
                    <div class="flex justify-between"><span class="text-slate-400 font-medium">Total Paid:</span><span class="font-black text-[#00C853] text-sm">$<?php echo number_format($_SESSION['last_order']['total'], 2); ?></span></div>
                </div>

                <a href="products.php" class="w-full py-3.5 bg-[#00C853] hover:bg-[#00b049] text-white text-xs font-bold tracking-widest rounded-xl transition duration-200 shadow-md text-center block uppercase">
                    Continue to Dashboard
                </a>
            </div>

        <?php else: ?>
            <!-- ================= STATE B: COMPILING SHIPPING FORM INTERFACE ================= -->
            <header class="flex justify-between items-start mb-8">
                <div>
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-6 bg-black rounded"></div>
                        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Secure Checkout</h1>
                    </div>
                    <p class="text-[11px] text-[#00C853] font-bold tracking-wide mt-0.5 ml-3.5">ENTER SHIPPING DETAILS & PAYMENT GATEWAY</p>
                </div>
                <a href="cart.php" class="flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i> Return to Cart
                </a>
            </header>

            <form action="checkout_process.php" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start w-full mt-4">
                
                <!-- Left Section: Details Input Fields (Spans 2 columns) -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Form Part 1: Shipping and Delivery Information -->
                    <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm space-y-4">
                        <h3 class="text-xs font-extrabold tracking-wider text-slate-400 uppercase mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-truck text-emerald-500"></i> Shipping Address
                        </h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Recipient Full Name</label>
                                <input type="text" name="full_name" required placeholder="e.g. SoccerShoesXI" 
                                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 text-xs font-semibold rounded-xl focus:outline-none focus:border-[#00C853] focus:bg-white transition">
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Phone Number</label>
                                <input type="tel" name="phone_number" required placeholder="e.g. +254 672  12424" 
                                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 text-xs font-semibold rounded-xl focus:outline-none focus:border-[#00C853] focus:bg-white transition">
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Delivery Street / Building / Location Address</label>
                            <textarea name="shipping_address" rows="3" required placeholder="Provide clear local dropoff instruction configurations details..." 
                                      class="w-full px-4 py-3 bg-slate-50 border border-slate-200 text-xs font-semibold rounded-xl focus:outline-none focus:border-[#00C853] focus:bg-white transition resize-none"></textarea>
                        </div>
                    </div>

                    <!-- Form Part 2: Secure Payment Mode Pickers -->
                    <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm space-y-4">
                        <h3 class="text-xs font-extrabold tracking-wider text-slate-400 uppercase mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-credit-card text-emerald-500"></i> Settlement Option
                        </h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <!-- Card Option -->
                            <label class="border-2 border-[#00C853] bg-emerald-50/20 p-4 rounded-xl flex items-center gap-3 cursor-pointer select-none relative group">
                                <input type="radio" name="payment_method" value="card" checked class="accent-[#00C853] h-4 w-4">
                                <div class="flex flex-col">
                                    <span class="text-xs font-bold text-slate-800">Credit Card</span>
                                    <span class="text-[9px] text-slate-400">Visa / MasterCard</span>
                                </div>
                            </label>

                            <!-- Mobile Money Integration Option -->
                            <label class="border border-slate-200 p-4 rounded-xl flex items-center gap-3 cursor-pointer select-none relative hover:bg-slate-50 transition">
                                <input type="radio" name="payment_method" value="mpesa" class="accent-[#00C853] h-4 w-4">
                                <div class="flex flex-col">
                                    <span class="text-xs font-bold text-slate-800">M-Pesa</span>
                                    <span class="text-[9px] text-slate-400">Mobile Express</span>
                                </div>
                            </label>

                            <!-- Cash on Delivery Option -->
                            <label class="border border-slate-200 p-4 rounded-xl flex items-center gap-3 cursor-pointer select-none relative hover:bg-slate-50 transition">
                                <input type="radio" name="payment_method" value="cod" class="accent-[#00C853] h-4 w-4">
                                <div class="flex flex-col">
                                    <span class="text-xs font-bold text-slate-800">On Delivery</span>
                                    <span class="text-[9px] text-slate-400">Pay at Hand</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Sticky Final Summary Review Panel -->
                <div class="space-y-4">
                    <h3 class="text-xs font-extrabold tracking-wider text-slate-400 uppercase mb-2">Final Review</h3>
                    
                    <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-md flex flex-col">
                        
                        <!-- Mini Inline items checklist loop -->
                        <div class="max-h-40 overflow-y-auto mb-4 pr-1 space-y-2.5 division-y border-b border-slate-100 pb-4">
                            <?php foreach ($_SESSION['cart'] as $item): ?>
                                <div class="flex justify-between items-center text-xs">
                                    <span class="text-slate-600 font-medium truncate max-w-[160px]"><?php echo htmlspecialchars($item['name']); ?> <span class="text-[10px] text-slate-400 font-bold">x<?php echo $item['quantity']; ?></span></span>
                                    <span class="font-bold text-slate-700">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="space-y-3.5 pb-5 border-b border-slate-100 text-xs font-medium text-slate-500">
                            <div class="flex justify-between">
                                <span>Cart Subtotal</span>
                                <span class="font-bold text-slate-700">$<?php echo number_format($total_amount, 2); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span>Shipping Logistics</span>
                                <span class="text-emerald-600 font-bold">FREE</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-baseline pt-5 pb-6">
                            <span class="text-xs font-extrabold text-slate-800 uppercase tracking-wide">Grand Total:</span>
                            <span class="text-2xl font-black text-[#00C853]">
                                $<?php echo $grandParts[0]; ?>.<span class="text-base font-bold align-super"><?php echo $grandParts[1]; ?></span>
                            </span>
                        </div>

                        <!-- Final Execution Submission Parameter Trigger -->
                        <input type="hidden" name="place_order" value="1">
                        <button type="submit" class="w-full py-3.5 bg-[#00C853] hover:bg-[#00b049] text-white text-xs font-bold tracking-widest rounded-xl transition duration-200 shadow-md shadow-emerald-100 flex items-center justify-center gap-2 transform active:scale-[0.99]">
                            <i class="fa-solid fa-lock text-xs"></i>
                            <span>AUTHORIZE & PAY</span>
                        </button>
                    </div>
                </div>

            </form>
        <?php endif; ?>

    </main>

    <!-- Custom inline JS to toggle card accent highlights beautifully when alternative options are clicked -->
    <script>
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('input[name="payment_method"]').forEach(r => {
                    r.parentElement.classList.remove('border-[#00C853]', 'bg-emerald-50/20');
                    r.parentElement.classList.add('border-slate-200');
                });
                if(this.checked) {
                    this.parentElement.classList.remove('border-slate-200');
                    this.parentElement.classList.add('border-[#00C853]', 'bg-emerald-50/20');
                }
            });
        });
    </script>
</body>
</html>