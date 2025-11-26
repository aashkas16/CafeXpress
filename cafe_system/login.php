<?php
require 'db.php';
$error = "";

// SHOW WELCOME MESSAGE IF SET
$welcome = $_SESSION['welcome_msg'] ?? "";
unset($_SESSION['welcome_msg']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM user WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($uid, $hash);

    if ($stmt->fetch()) {
        if (password_verify($password, $hash)) {

            $_SESSION['user_id'] = $uid;
            $_SESSION['user_email'] = $email;

            // SET WELCOME MESSAGE
            $_SESSION['welcome_msg'] = "Welcome back, $email!";

            header("Location: menu.php");
            exit;

        } else $error = "Incorrect password!";
    } else $error = "Email not registered!";
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">

<style>
body {
    background:#faf4ef; /* Same cream background */
    font-family:Arial;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    margin:0;
}

/* SAME FEEL AS BEFORE */
.form-card {
    width:350px;
    background:white;
    padding:25px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
    text-align:center;
    animation: fadeIn 0.6s ease;
}

/* INPUT BOXES */
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

/* EYE ICON */
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

/* LOGIN BUTTON */
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

/* HEADINGS */
h2 {
    color:#6a2d07;
    margin-bottom:10px;
}

.error-msg {
    color:red;
    font-weight:600;
}

/* WELCOME BANNER */
.welcome-msg {
    background:#7b3f00;
    color:white;
    padding:10px;
    border-radius:8px;
    margin-bottom:15px;
    font-weight:600;
}

/* Smooth animation */
@keyframes fadeIn {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
}
</style>
</head>

<body>

<div class="form-card">

<h2>User Login</h2>

<!-- SHOW WELCOME MESSAGE -->
<?php if($welcome): ?>
    <div class="welcome-msg"><?php echo $welcome; ?></div>
<?php endif; ?>

<!-- ERROR -->
<?php if($error): ?>
    <p class="error-msg"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post">

    <input type="email" name="email" placeholder="Email" required>

    <div class="input-wrapper">
        <input type="password" name="password" id="passwordField" placeholder="Password" required>
        <span class="eye-btn" id="togglePassword">👁️</span>
    </div>

    <button class="big-btn" type="submit">Login</button>

</form>

</div>

<script>
// PASSWORD SHOW/HIDE
let ps = document.getElementById("passwordField");
let eye = document.getElementById("togglePassword");

eye.onclick = () => {
    if (ps.type === "password") {
        ps.type = "text";
        eye.textContent = "🙈";
    } else {
        ps.type = "password";
        eye.textContent = "👁️";
    }
};
</script>

</body>
</html>
