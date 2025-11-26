<?php
require 'db.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } elseif (strlen($password) < 6) {
        $error = "Password must be minimum 6 characters";
    } else {
        $check = $conn->prepare("SELECT id FROM user WHERE email=?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Email already registered!";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $conn->prepare("INSERT INTO user(email, password) VALUES (?, ?)");
            $ins->bind_param("ss", $email, $hash);

            if ($ins->execute()) {
                $_SESSION['user_id'] = $ins->insert_id;
                $_SESSION['user_email'] = $email;
                header("Location: menu.php");
                exit;
            }
        }
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

/* FORM CARD */
.form-card {
    width:350px;
    background:white;
    padding:25px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
    text-align:center;
    animation: fadeIn 0.6s ease;
}

/* INPUTS */
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

/* BUTTON */
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

/* Fade animation */
@keyframes fadeIn {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
}
</style>
</head>

<body>

<div class="form-card">
<h2>Create Account</h2>

<?php if($error): ?>
    <p class="error-msg"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post">

    <input type="email" name="email" placeholder="Enter Email" required>

    <div class="input-wrapper">
        <input type="password" name="password" id="regPassword" placeholder="Enter Password" required>
        <span class="eye-btn" id="regToggle">👁️</span>
    </div>

    <button class="big-btn" type="submit">Register</button>

</form>

</div>

<script>
// SHOW/HIDE PASSWORD
let p = document.getElementById("regPassword");
let b = document.getElementById("regToggle");

b.onclick = () => {
    if (p.type === "password") {
        p.type = "text";
        b.textContent = "🙈";
    } else {
        p.type = "password";
        b.textContent = "👁️";
    }
};
</script>

</body>
</html>
