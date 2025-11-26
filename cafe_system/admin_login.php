<?php
require 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $_SESSION['admin'] = $username;
        header("Location: admin_orders.php");
        exit;
    } else {
        $error = "Invalid admin credentials!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">

<style>
body {
    background:#faf4ef;
    font-family:Arial;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    margin:0;
}

/* CARD */
.form-card {
    width:350px;
    background:white;
    padding:25px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
    text-align:center;
    animation: fadeIn 0.6s ease;
}

/* INPUT */
.form-card input {
    width:100%;
    padding:12px 14px;
    margin:10px 0;
    border:2px solid #d5c4b6;
    border-radius:8px;
    font-size:16px;
    transition:0.3s;
}

.form-card input:focus {
    border-color:#7b3f00;
    box-shadow:0 0 6px rgba(123,63,0,0.3);
    outline:none;
}

/* PASSWORD + EYE */
.input-wrapper {
    position:relative;
}

.eye-btn {
    position:absolute;
    right:12px;
    top:50%;
    transform:translateY(-50%);
    cursor:pointer;
    font-size:20px;
    color:#7b3f00;
}

/* ADMIN LOGIN BUTTON */
.big-btn {
    width:100%;
    padding:12px;
    background:#7b3f00;
    color:white;
    border:none;
    border-radius:8px;
    font-size:18px;
    font-weight:700;
    cursor:pointer;
    margin-top:12px;
    transition:0.3s;
}

.big-btn:hover {
    background:#5e2f00;
}

h2 {
    color:#6a2d07;
    margin-bottom:10px;
}

.error-msg {
    color:red;
    font-weight:600;
}

@keyframes fadeIn {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
}
</style>

</head>

<body>

<div class="form-card">
<h2>Admin Login</h2>

<?php if($error): ?>
    <p class="error-msg"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post">

    <input type="text" name="username" placeholder="Admin Username" required>

    <div class="input-wrapper">
        <input type="password" name="password" id="adminPass" placeholder="Admin Password" required>
        <span class="eye-btn" id="adminEye">👁️</span>
    </div>

    <button class="big-btn" type="submit">Login</button>
</form>

</div>

<script>
// SHOW / HIDE PASSWORD
let ap = document.getElementById("adminPass");
let ae = document.getElementById("adminEye");

ae.onclick = () => {
    if (ap.type === "password") {
        ap.type = "text";
        ae.textContent = "🙈";
    } else {
        ap.type = "password";
        ae.textContent = "👁️";
    }
};
</script>

</body>
</html>
