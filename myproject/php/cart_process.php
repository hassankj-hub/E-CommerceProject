<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// 1. Handle adjustments coming from the explicit form button posts
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['action'])) {
    $product_id = $_POST['product_id'];
    $action = $_POST['action'];

    if (isset($_SESSION['cart'][$product_id])) {
        if ($action === 'increase') {
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } elseif ($action === 'decrease') {
            $_SESSION['cart'][$product_id]['quantity'] -= 1;
            // If quantity drops to zero or below, drop it from the stack automatically
            if ($_SESSION['cart'][$product_id]['quantity'] <= 0) {
                unset($_SESSION['cart'][$product_id]);
            }
        } elseif ($action === 'remove') {
            unset($_SESSION['cart'][$product_id]);
        }
    }
    
    header("Location: cart.php");
    exit;
}

// 2. Fallback rule routing requests coming from the storefront "ADD TO CART" buttons
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $image = isset($_POST['image']) ? $_POST['image'] : 'logo.png';

    $cart_item = array(
        'id' => $product_id,
        'name' => $product_name,
        'price' => $price,
        'image' => $image,
        'quantity' => 1
    );

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$product_id] = $cart_item;
    }

    header("Location: products.php?status=added");
    exit;
}
?>