<?php
require 'db.php';

// USER MUST BE LOGGED IN
if (!isset($_SESSION['user_id'])) {
    $_SESSION['after_login'] = "menu.php";
    header("Location: login.php");
    exit;
}

// ---------- CART OPERATIONS ----------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && isset($_POST["item_id"])) {

    $item_id = intval($_POST["item_id"]);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if ($_POST["action"] === "add") {
        $_SESSION['cart'][$item_id] = ($_SESSION['cart'][$item_id] ?? 0) + 1;

    } elseif ($_POST["action"] === "remove") {
        if (isset($_SESSION["cart"][$item_id])) {
            $_SESSION["cart"][$item_id]--;
            if ($_SESSION["cart"][$item_id] <= 0) unset($_SESSION["cart"][$item_id]);
        }
    }

    header("Location: menu.php");
    exit;
}

// ---------- FETCH MENU ----------
$menu = [];
$sql = "SELECT * FROM menu ORDER BY category ASC, id ASC";
$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $cat = $row['category'];
    if (!isset($menu[$cat])) $menu[$cat] = [];
    $menu[$cat][] = $row;
}

$cartCount = array_sum($_SESSION["cart"] ?? []);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CafeXpress — Menu</title>
    <link rel="stylesheet" href="style.css">
<style>
/* ---------- BASIC ---------- */
body { overflow-x: hidden; margin:0; font-family: Arial, sans-serif; }

/* ---------- HEADER CENTER ---------- */
.menu-header {
    text-align: center;
    margin: 30px auto 10px;
}

.menu-header h1 {
    font-size: 32px;
    font-weight: 800;
    color: #6a2d07;
    margin-bottom: 12px;
}

.menu-header .btn {
    background: #7b3f00;
    color: white;
    padding: 10px 18px;
    text-decoration: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: 600;
    margin: 0 8px;
    display: inline-block;
}

/* ---------- FILTER BAR ---------- */
.filter-bar {
    width: 100%;
    padding: 10px;
    background: #fff2e6;
    display: flex;
    gap: 10px;
    overflow-x: auto;
    white-space: nowrap;
    padding-bottom: 15px;
    border-bottom: 2px solid #e6d5c5;
    position: sticky;
    top: 0;
    z-index: 10;
}

.filter-btn {
    padding: 10px 14px;
    border-radius: 6px;
    background: #7b3f00;
    color: white;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}

/* ---------- DOOR ANIMATION ---------- */
/* overlay fades out, doors slide outward */
.overlay {
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: linear-gradient(180deg,#f6ede4,#efe3d8);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    transition: opacity 450ms ease;
    opacity: 1;
    pointer-events: auto;
}

/* doors: initial closed state (no transform) */
.door {
    width: 50vw;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff7ef;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    transition: transform 950ms cubic-bezier(.25,.9,.3,1);
}

.door.left { transform-origin: left center; border-right: 1px solid #ddd; }
.door.right { transform-origin: right center; border-left: 1px solid #ddd; }

/* when we add .open to each door, they will slide off-screen */
.door.left.open { transform: translateX(-110%); }
.door.right.open { transform: translateX(110%); }

.logo-text { font-size: 40px; font-weight: 800; color: #6a2d07; text-align:center; }
.logo-sub { font-size: 16px; margin-top: 8px; color: #8a5a36; text-align:center; }

/* ---------- MENU CONTENT ---------- */
.menu-container {
    max-width: 1100px;
    margin: 40px auto;
    padding: 20px;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity .45s ease, transform .45s ease;
}

.menu-container.visible {
    opacity: 1;
    transform: translateY(0);
}

.category { margin-top: 30px; }

.category h2 {
    font-size: 22px;
    color: #7a3f14;
    padding-bottom: 6px;
    border-bottom: 2px solid #f2e8e0;
}

.item-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    background: #fff;
    margin-top: 10px;
    padding: 14px;
    border-radius: 10px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.05);
}

.item-name { font-size: 18px; font-weight: 700; color: #4e2d0b; }
.item-desc { color: #6b4d39; font-size: 14px; margin-top: 4px; max-width: 70%; }

.price { font-weight: 800; color: #5a2d0c; }

.qty-controls {
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.qty-btn {
    width: 35px;
    height: 35px;
    border: none;
    background: #7b3f00;
    color: #fff;
    border-radius: 6px;
    font-size: 20px;
    cursor: pointer;
}

.qty-num {
    width: 30px;
    font-weight: 700;
    text-align: center;
    color: #5a2d0c;
}
</style>
</head>
<body>

<!-- DOOR ANIMATION -->
<div id="overlay" class="overlay" aria-hidden="true">
    <div id="doorLeft" class="door left" aria-hidden="true">
        <div>
            <div class="logo-text">CafeXpress</div>
            <div class="logo-sub">Good Coffee. Good Vibes.</div>
        </div>
    </div>

    <div id="doorRight" class="door right" aria-hidden="true">
        <div>
            <div class="logo-text">CafeXpress</div>
            <div class="logo-sub">Welcome!</div>
        </div>
    </div>
</div>

<!-- MENU CONTENT -->
<div class="menu-container" id="menuContent" aria-live="polite">
    <div class="menu-header">
        <h1>Menu</h1>
        <a class="btn" href="index.php">Home</a>
        <a class="btn" href="checkout.php">Checkout (<?php echo $cartCount; ?>)</a>
        <a class="btn" href="logout.php">Logout</a>
    </div>

    <!-- CATEGORY FILTER BAR -->
    <div class="filter-bar">
        <?php foreach ($menu as $category => $items): ?>
            <a href="#cat_<?php echo urlencode($category); ?>" class="filter-btn">
                <?php echo $category; ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- MENU LIST -->
    <?php foreach ($menu as $category => $items): ?>
        <div class="category" id="cat_<?php echo urlencode($category); ?>">
            <h2><?php echo htmlspecialchars($category); ?></h2>

            <?php foreach ($items as $item): ?>
                <?php
                $id = $item['id'];
                $qty_here = $_SESSION['cart'][$id] ?? 0;
                ?>

                <div class="item-row">
                    <div>
                        <div class="item-name"><?php echo htmlspecialchars($item['item_name']); ?></div>
                        <div class="item-desc"><?php echo htmlspecialchars($item['description']); ?></div>
                    </div>

                    <div style="text-align:right;">
                        <div class="price">₹<?php echo htmlspecialchars($item['price']); ?></div>

                        <div class="qty-controls">
                            <form method="post">
                                <input type="hidden" name="action" value="remove">
                                <input type="hidden" name="item_id" value="<?php echo $id; ?>">
                                <button class="qty-btn" type="submit">−</button>
                            </form>

                            <div class="qty-num"><?php echo $qty_here; ?></div>

                            <form method="post">
                                <input type="hidden" name="action" value="add">
                                <input type="hidden" name="item_id" value="<?php echo $id; ?>">
                                <button class="qty-btn" type="submit">+</button>
                            </form>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>
    <?php endforeach; ?>

</div>

<script>
// -------- preserve scroll when forms submit (so page doesn't jump to top) --------
document.addEventListener("click", function(e) {
    // if a button inside a form is clicked, store scroll before the submit
    if (e.target.closest("form")) {
        try { localStorage.setItem("menuScroll", String(window.scrollY || 0)); } catch(e){}
    }
});
window.addEventListener("load", function() {
    try {
        let scrollPos = localStorage.getItem("menuScroll");
        if (scrollPos !== null) {
            window.scrollTo(0, parseInt(scrollPos, 10) || 0);
            localStorage.removeItem("menuScroll");
        }
    } catch(e){}
});

// -------- DOOR ANIMATION (robust) --------
(function() {
    const overlay = document.getElementById('overlay');
    const left = document.getElementById('doorLeft');
    const right = document.getElementById('doorRight');
    const menu = document.getElementById('menuContent');

    // helper to reveal menu
    function revealMenuInstant() {
        // hide overlay immediately and show menu
        overlay.style.display = 'none';
        menu.classList.add('visible');
    }

    // If already opened before, skip animation
    let openedFlag = null;
    try { openedFlag = localStorage.getItem('doorsOpened'); } catch(e){}

    if (openedFlag) {
        // skip animation
        revealMenuInstant();
        return;
    }

    // Play animation:
    // 1) add .open to doors -> they slide out (CSS transition)
    // 2) when both doors have finished transitioning, fade out overlay and show menu
    // We'll use transitionend to be robust.
    let transitionsRemaining = 2; // left + right

    function onDoorTransitionEnd(ev) {
        // only count transform transitions on door elements
        if (ev.propertyName !== 'transform') return;
        transitionsRemaining--;
        if (transitionsRemaining <= 0) {
            // fade overlay then hide it when fade finishes
            overlay.style.opacity = '0';

            // when overlay fade finishes, fully hide and reveal menu
            const onOverlayTransitionEnd = function(ev2) {
                if (ev2.propertyName !== 'opacity') return;
                overlay.removeEventListener('transitionend', onOverlayTransitionEnd);
                overlay.style.display = 'none';
                menu.classList.add('visible');
            };
            overlay.addEventListener('transitionend', onOverlayTransitionEnd);

            // mark opened so it won't play again
            try { localStorage.setItem('doorsOpened', 'yes'); } catch(e){}
            // detach door listeners
            left.removeEventListener('transitionend', onDoorTransitionEnd);
            right.removeEventListener('transitionend', onDoorTransitionEnd);
        }
    }

    // ensure overlay is visible and menu hidden initially
    overlay.style.display = 'flex';
    overlay.style.opacity = '1';
    menu.classList.remove('visible');

    // attach listeners
    left.addEventListener('transitionend', onDoorTransitionEnd);
    right.addEventListener('transitionend', onDoorTransitionEnd);

    // small timeout to allow paint, then start the door open transform
    // this prevents the transform from being applied before the initial render
    setTimeout(function() {
        left.classList.add('open');
        right.classList.add('open');
    }, 50);
})();
</script>
</body>
</html>
