<?php
require 'db.php';

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    header("Location: menu.php");
    exit;
}

// --- ADD / REMOVE BUTTON LOGIC ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {

    $id = intval($_POST["item_id"]);

    if ($_POST["action"] == "add") {
        $_SESSION["cart"][$id] = ($_SESSION["cart"][$id] ?? 0) + 1;
    }

    if ($_POST["action"] == "remove") {
        if (isset($_SESSION["cart"][$id])) {
            $_SESSION["cart"][$id]--;
            if ($_SESSION["cart"][$id] <= 0) unset($_SESSION["cart"][$id]);
        }
    }

    header("Location: checkout.php");
    exit;
}

$cart = $_SESSION["cart"];
$ids = implode(",", array_keys($cart));

$sql = "SELECT * FROM menu WHERE id IN ($ids)";
$res = $conn->query($sql);

$items = [];
$subtotal = 0;

while ($row = $res->fetch_assoc()) {
    $qty = $cart[$row['id']];
    $line = $qty * $row['price'];

    $row['qty'] = $qty;
    $row['line'] = $line;

    $subtotal += $line;
    $items[] = $row;
}

$gst_rate = 18;
$gst_amount = $subtotal * 0.18;
$total = $subtotal + $gst_amount;

// Final order submit
if (isset($_POST["place_order"])) {

    $ins = $conn->prepare("INSERT INTO orders (user_id, subtotal, gst_rate, gst_amount, total) VALUES (?, ?, 18, ?, ?)");
    $ins->bind_param("iddd", $_SESSION['user_id'], $subtotal, $gst_amount, $total);
    $ins->execute();
    $order_id = $ins->insert_id;

    foreach ($items as $it) {
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, item_id, qty, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $order_id, $it['id'], $it['qty'], $it['price']);
        $stmt->execute();
    }

    unset($_SESSION["cart"]);

    header("Location: order_success.php?id=" . $order_id);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">

<style>
body { overflow-x:hidden; font-family: Arial; background:#faf4ef; }

/* PAGE HEADER */
.checkout-header {
    text-align:center;
    margin:30px 0 15px;
}
.checkout-header h1 {
    font-size:32px;
    font-weight:800;
    color:#6a2d07;
}

/* TABLE STYLING SAME AS MENU DESIGN */
.checkout-box {
    max-width:900px;
    margin:20px auto;
    background:#fff;
    border-radius:12px;
    padding:25px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
}

.table {
    width:100%;
    border-collapse: collapse;
    margin-top:20px;
}
.table th {
    background:#7b3f00;
    color:white;
    padding:12px;
    font-size:16px;
}
.table td {
    padding:12px;
    border-bottom:1px solid #e6d5c5;
    font-size:16px;
    color:#4e2d0b;
}

/* QTY BUTTONS */
.qty-controls {
    display:flex;
    align-items:center;
    gap:10px;
    justify-content:center;
}

.qty-btn {
    width:35px;
    height:35px;
    border:none;
    background:#7b3f00;
    color:white;
    font-size:20px;
    border-radius:6px;
    cursor:pointer;
}

.qty-num {
    width:40px;
    text-align:center;
    font-weight:700;
    color:#6a2d07;
}

/* TOTAL BOX */
.total-box {
    margin-top:25px;
    text-align:right;
    font-size:20px;
    color:#5a2d0c;
    line-height:34px;
}

/* PLACE ORDER BUTTON */
.place-btn {
    margin-top:25px;
    width:100%;
    padding:14px;
    font-size:20px;
    border:none;
    background:#7b3f00;
    color:white;
    border-radius:8px;
    cursor:pointer;
    font-weight:700;
}
.place-btn:hover {
    background:#5e2f00;
}

</style>
</head>

<body>

<div class="checkout-header">
    <h1>Checkout</h1>
</div>

<div class="checkout-box">

<table class="table">
    <tr>
        <th>Item</th>
        <th>Qty</th>
        <th>Price (₹)</th>
        <th>Total (₹)</th>
    </tr>

    <?php foreach($items as $it): ?>
    <tr>
        <td><?php echo $it['item_name']; ?></td>

        <td>
            <!-- QTY BUTTONS -->
            <div class="qty-controls">

                <form method="post">
                    <input type="hidden" name="action" value="remove">
                    <input type="hidden" name="item_id" value="<?php echo $it['id']; ?>">
                    <button class="qty-btn">−</button>
                </form>

                <div class="qty-num"><?php echo $it['qty']; ?></div>

                <form method="post">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="item_id" value="<?php echo $it['id']; ?>">
                    <button class="qty-btn">+</button>
                </form>

            </div>
        </td>

        <td><?php echo $it['price']; ?></td>
        <td><?php echo $it['line']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="total-box">
    Subtotal: <b>₹<?php echo $subtotal; ?></b><br>
    GST (18%): <b>₹<?php echo $gst_amount; ?></b><br>
    <span style="font-size:26px;">Grand Total: <b>₹<?php echo $total; ?></b></span>
</div>

<form method="post">
    <button class="place-btn" name="place_order">Confirm Order</button>
</form>

</div>

</body>
</html>
