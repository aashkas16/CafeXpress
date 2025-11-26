<?php
require 'db.php';

$id = intval($_GET['id']);

$sql = "SELECT o.*, u.email FROM orders o 
        LEFT JOIN user u ON o.user_id = u.id 
        WHERE o.id=$id";

$order = $conn->query($sql)->fetch_assoc();

$items = $conn->query("SELECT oi.*, m.item_name 
                       FROM order_items oi 
                       JOIN menu m ON oi.item_id = m.id 
                       WHERE oi.order_id=$id");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">

<style>
body {
    background:#faf4ef;
    font-family: Arial, sans-serif;
    margin:0;
    padding:0;
}

/* MAIN INVOICE BOX */
.invoice-box {
    max-width:900px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.invoice-header {
    text-align:center;
    margin-bottom:25px;
}

.invoice-header h1 {
    color:#6a2d07;
    font-size:36px;
    font-weight:800;
}

.invoice-header p {
    color:#7a4f2b;
    font-size:16px;
}

/* ORDER DETAILS BOX */
.details-box {
    margin-top:15px;
    background:#fff7ef;
    padding:18px;
    border-radius:10px;
    border:1px solid #e5d1be;
    margin-bottom:25px;
}

.details-box p {
    margin:5px 0;
    font-size:17px;
    color:#4e2d0b;
    line-height:24px;
}

/* TABLE */
.invoice-table {
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

.invoice-table th {
    background:#7b3f00;
    color:white;
    padding:12px;
    font-size:16px;
}

.invoice-table td {
    padding:12px;
    border-bottom:1px solid #e6d5c5;
    font-size:17px;
    color:#4e2d0b;
}

/* TOTALS */
.total-box {
    margin-top:25px;
    padding:18px;
    background:#fff7ef;
    border:1px solid #e6d5c5;
    border-radius:10px;
    font-size:18px;
    color:#4e2d0b;
    line-height:32px;
    text-align:right;
}

.total-box span {
    font-size:28px;
    font-weight:800;
    color:#6a2d07;
}

/* BUTTONS */
.btn-area {
    margin-top:30px;
    text-align:center;
}

.btn {
    background:#7b3f00;
    color:white;
    padding:12px 22px;
    margin:0 10px;
    border-radius:8px;
    font-size:17px;
    text-decoration:none;
    font-weight:700;
    display:inline-block;
    transition:0.3s;
}

.btn:hover {
    background:#5e2f00;
}

</style>
</head>

<body>

<div class="invoice-box">

    <div class="invoice-header">
        <h1>Order Successful!</h1>
        <p>Thank you for ordering from CafeXpress</p>
    </div>

    <div class="details-box">
        <p><b>Invoice ID:</b> <?php echo $id; ?></p>
        <p><b>User Email:</b> <?php echo $order['email']; ?></p>
        <p><b>Date:</b> <?php echo date("d M Y, h:i A", strtotime($order['created_at'] ?? "now")); ?></p>
    </div>

    <h2 style="color:#6a2d07; margin-top:10px;">Order Summary</h2>

    <table class="invoice-table">
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price (₹)</th>
        </tr>

        <?php while ($it = $items->fetch_assoc()): ?>
        <tr>
            <td><?php echo $it['item_name']; ?></td>
            <td><?php echo $it['qty']; ?></td>
            <td><?php echo $it['price']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="total-box">
        Subtotal: ₹<?php echo $order['subtotal']; ?><br>
        GST (18%): ₹<?php echo $order['gst_amount']; ?><br>
        <span>Total Paid: ₹<?php echo $order['total']; ?></span>
    </div>

    <div class="btn-area">
        <a href="menu.php" class="btn">Back to Menu</a>
        <a href="index.php" class="btn">Home</a>
    </div>

</div>

</body>
</html>
