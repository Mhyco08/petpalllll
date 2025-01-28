<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    <div class="logo">
        <img src="Components/PETPAL LOGO.svg" alt="Logo" class="petpal">
        <img src="Components/login_cat.png" alt="" class="cat">
    </div>
    <div class="login-container" id="signIn">
        <h1>Welcome Back</h1>
        <p>Log in to your Account?</p>
        <form id="login-form" method="post" action="register.php">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required>
            
            <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <div class="signup-link">
            Don't have an account? <a href="signUp.html">Sign Up</a>
        </div>
    </div>
    <script src="JS/script.js"></script>
</body>
</html>
