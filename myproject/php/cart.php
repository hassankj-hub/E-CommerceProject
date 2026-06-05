<?php
// 1. Initialize user session memory tracking
session_start();

// 2. Handle default credentials fallback matching your platform state
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'BootsXI';
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : 'Boots@gmail.com';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCCERSHOES XI - Shopping Cart</title>
    
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

    <main class="flex-1 p-8 overflow-y-auto max-w-[1400px] mx-auto w-full">
        
        <header class="flex justify-between items-start mb-8">
            <div>
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-6 bg-black rounded"></div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Review Your Purchase</h1>
                </div>
                <p class="text-[11px] text-[#00C853] font-bold tracking-wide mt-0.5 ml-3.5">FINALIZE YOUR SELECTIONS & CHECKOUT</p>
            </div>
            <div class="flex items-center gap-6 text-slate-700">
                <a href="products.php" class="flex items-center gap-2 text-xs font-bold text-[#00C853] hover:underline">
                    <i class="fa-solid fa-arrow-left"></i> Continue Shopping
                </a>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start w-full mt-4">
            
            <?php if (empty($_SESSION['cart'])): ?>
                <div class="col-span-3 bg-white border border-slate-100 rounded-3xl p-12 text-center shadow-sm flex flex-col items-center justify-center">
                    <div class="w-20 h-20 bg-slate-50 text-slate-300 flex items-center justify-center rounded-full mb-4 shadow-inner">
                        <i class="fa-solid fa-bag-shopping text-3xl"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 mb-1">Your cart is empty</h3>
                    <p class="text-xs text-slate-400 mb-6">Looks like you haven't selected any elite footwear yet.</p>
                    <a href="products.php" class="px-5 py-2.5 bg-[#00C853] hover:bg-[#00b049] text-white text-xs font-bold tracking-wider rounded-xl transition shadow-sm">
                        BROWSE BOOTS
                    </a>
                </div>
            <?php else: ?>
                
                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-xs font-extrabold tracking-wider text-slate-400 uppercase mb-2">Shopping Bag Items</h3>
                    
                    <?php 
                    $total_amount = 0;
                    foreach ($_SESSION['cart'] as $item_id => $item): 
                        $subtotal = $item['price'] * $item['quantity'];
                        $total_amount += $subtotal;
                        
                        $priceParts = explode('.', sprintf('%01.2f', $item['price']));
                        $subtotalParts = explode('.', sprintf('%01.2f', $subtotal));
                    ?>
                        <div class="bg-white border border-slate-100 rounded-2xl p-5 flex flex-col sm:flex-row items-center gap-4 shadow-sm hover:shadow-md transition-shadow duration-300">
                            
                            <div class="flex-1 min-w-0 text-center sm:text-left pl-2">
                                <h4 class="font-extrabold text-slate-800 text-sm tracking-tight truncate" title="<?php echo htmlspecialchars($item['name']); ?>">
                                    <?php echo htmlspecialchars($item['name']); ?>
                                </h4>
                                <p class="text-xs text-[#00C853] font-bold mt-0.5">
                                    $<?php echo $priceParts[0]; ?>.<span class="text-[10px]"><?php echo $priceParts[1]; ?></span>
                                </p>
                            </div>

                            <div class="flex flex-wrap items-center gap-6 justify-between sm:justify-end w-full sm:w-auto shrink-0 border-t sm:border-t-0 pt-3 sm:pt-0 mt-2 sm:mt-0">
                                
                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mr-1">Qty:</span>
                                    
                                    <form action="cart_process.php" method="POST" class="inline">
                                        <input type="hidden" name="product_id" value="<?php echo $item_id; ?>">
                                        <input type="hidden" name="action" value="decrease">
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-slate-50 border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100 transition flex items-center justify-center">-</button>
                                    </form>

                                    <span class="w-10 h-8 rounded-lg bg-slate-100 border border-slate-200 text-xs font-extrabold flex items-center justify-center text-slate-800">
                                        <?php echo $item['quantity']; ?>
                                    </span>

                                    <form action="cart_process.php" method="POST" class="inline">
                                        <input type="hidden" name="product_id" value="<?php echo $item_id; ?>">
                                        <input type="hidden" name="action" value="increase">
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-slate-50 border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100 transition flex items-center justify-center">+</button>
                                    </form>
                                </div>

                                <div class="text-right min-w-[90px]">
                                    <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider mb-0.5">Subtotal</span>
                                    <span class="text-sm font-extrabold text-slate-800">
                                        $<?php echo $subtotalParts[0]; ?>.<span class="text-xs"><?php echo $subtotalParts[1]; ?></span>
                                    </span>
                                </div>

                                <form action="cart_process.php" method="POST" class="inline ml-2">
                                    <input type="hidden" name="product_id" value="<?php echo $item_id; ?>">
                                    <input type="hidden" name="action" value="remove">
                                    <button type="submit" title="Remove from Cart" class="w-8 h-8 rounded-lg bg-rose-50 text-rose-500 border border-rose-100 hover:bg-rose-100 hover:text-rose-600 transition flex items-center justify-center">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xs font-extrabold tracking-wider text-slate-400 uppercase mb-2">Order Summary</h3>
                    
                    <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-md flex flex-col">
                        <div class="space-y-3.5 pb-5 border-b border-slate-100 text-xs font-medium text-slate-500">
                            <div class="flex justify-between">
                                <span>Cart Subtotal</span>
                                <span class="font-bold text-slate-700">$<?php echo number_format($total_amount, 2); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span>Shipping Fees</span>
                                <span class="text-emerald-600 font-bold">FREE</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-baseline pt-5 pb-6">
                            <span class="text-xs font-extrabold text-slate-800 uppercase tracking-wide">Grand Total:</span>
                            <?php 
                                $grandParts = explode('.', sprintf('%01.2f', $total_amount));
                            ?>
                            <span class="text-2xl font-black text-[#00C853]">
                                $<?php echo $grandParts[0]; ?>.<span class="text-base font-bold align-super"><?php echo $grandParts[1]; ?></span>
                            </span>
                        </div>

                        <form action="../php/checkout_process.php" method="POST" class="w-full">
                            <button type="submit" class="w-full py-3.5 bg-[#00C853] hover:bg-[#00b049] text-white text-xs font-bold tracking-widest rounded-xl transition duration-200 shadow-md shadow-emerald-100 flex items-center justify-center gap-2 transform active:scale-[0.99]">
                                <i class="fa-solid fa-shield-checkmark text-sm"></i>
                                <span>CONFIRM & PURCHASE</span>
                            </button>
                        </form>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </main>

</body>
</html>