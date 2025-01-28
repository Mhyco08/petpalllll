<?php 

include 'connect.php';

// Handle sign up
if(isset($_POST['signUp'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate if passwords match
    if($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    // Hash the password
    $hashed_password = md5($password);

    // Check if the email or username is already taken
    $checkUser = "SELECT * FROM users WHERE email='$email' OR username='$username'";
    $result = $conn->query($checkUser);

    if($result->num_rows > 0) {
        echo "Email or Username Already Exists!";
    } else {
        // Insert new user into the database
        $insertQuery = "INSERT INTO users(username, email, password)
                        VALUES ('$username', '$email', '$hashed_password')";
        if($conn->query($insertQuery) === TRUE) {
            header("Location: dashboard.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Handle sign in
if(isset($_POST['signIn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = md5($password);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$hashed_password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Incorrect Email or Password!";
    }
}
?>
