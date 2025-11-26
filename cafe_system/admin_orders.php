<?php
require 'db.php';

// FETCH ALL ORDERS SORTED BY DATE (NEWEST FIRST)
$sql = "
SELECT 
    o.id AS order_id,
    o.user_id,
    o.subtotal,
    o.gst_rate,
    o.gst_amount,
    o.total,
    o.created_at,
    u.email
FROM orders o
LEFT JOIN user u ON o.user_id = u.id
ORDER BY DATE(o.created_at) DESC, o.id ASC
";

$result = $conn->query($sql);

// GROUP BY DATE
$orders_by_date = [];
while ($row = $result->fetch_assoc()) {
    $date = date("d M Y", strtotime($row['created_at']));
    $orders_by_date[$date][] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin — Orders</title>
    <link rel="stylesheet" href="style.css">

    <style>
        .date-title {
            background: #8b4b20;
            color: white;
            padding: 10px;
            margin-top: 30px;
            border-radius: 6px;
            font-size: 20px;
            font-weight: bold;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow:0 4px 12px rgba(0,0,0,0.1);
        }

        .order-table th {
            background: #f2e4d8;
            padding: 10px;
            text-align: left;
        }

        .order-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .child-table {
            width: 90%;
            margin: 10px 0 10px 30px;
            border-collapse: collapse;
            background: #fff8f3;
        }
        
        .child-table th, .child-table td {
            padding: 6px;
            border-bottom: 1px solid #eee;
        }

        .order-row {
            background: #fffdfb;
        }
    </style>
</head>

<body>

<div class="container">

    <?php foreach ($orders_by_date as $date => $orders): ?>
        
        <!-- DATE HEADER -->
        <div class="date-title"><?php echo $date; ?></div>

        <!-- MAIN TABLE -->
        <table class="order-table">
            <tr>
                <th>Daily Order #</th>
                <th>Customer Email</th>
                <th>Subtotal</th>
                <th>GST</th>
                <th>Total</th>
                <th>Time</th>
            </tr>

            <?php
            $daily_count = 1;
            foreach ($orders as $order):
            ?>

                <tr class="order-row">
                    <td><?php echo $daily_count++; ?></td>
                    <td><?php echo $order['email']; ?></td>
                    <td>₹<?php echo $order['subtotal']; ?></td>
                    <td>₹<?php echo $order['gst_amount']; ?> (<?php echo $order['gst_rate']; ?>%)</td>
                    <td><b>₹<?php echo $order['total']; ?></b></td>
                    <td><?php echo date("h:i A", strtotime($order['created_at'])); ?></td>
                </tr>

                <!-- ITEM TABLE FOR THIS ORDER -->
                <tr>
                    <td colspan="6">
                        <table class="child-table">
                            <tr><th>Item</th><th>Qty</th><th>Price</th></tr>

                            <?php
                            $oid = $order['order_id'];
                            $item_sql = "
                            SELECT 
                                oi.qty, 
                                oi.price,
                                m.item_name
                            FROM order_items oi
                            JOIN menu m ON oi.item_id = m.id
                            WHERE oi.order_id=$oid
                            ";
                            $items = $conn->query($item_sql);
                            while ($it = $items->fetch_assoc()):
                            ?>
                                <tr>
                                    <td><?php echo $it['item_name']; ?></td>
                                    <td><?php echo $it['qty']; ?></td>
                                    <td>₹<?php echo $it['price']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    </td>
                </tr>

            <?php endforeach; ?>

        </table>

    <?php endforeach; ?>

</div>

</body>
</html>
