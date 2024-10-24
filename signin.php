<?php
session_start(); // Start the session

// Database configuration
$host = 'localhost'; // Database host
$database = 'marco'; // Database name
$user = 'root'; // Default username for XAMPP
$password = ''; // Default password for XAMPP (usually empty)

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ''; // Variable to store notification messages

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Query to find the user by email
    $sql = "SELECT * FROM regis WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store user information in session
            $_SESSION['user'] = $user['firstname'];
            header('Location: welcome.php'); // Redirect to welcome page
            exit();
        } else {
            $message = "Incorrect password. Please try again.";
        }
    } else {
        $message = "No account found with that email.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <style>
        body {
            background-color: rgba(173, 216, 230, 0.8);
            backdrop-filter: blur(10px);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 350px;
            padding: 20px;
            border-radius: 20px;
            position: relative;
            background-color: #1a1a1a;
            color: #fff;
            border: 1px solid #333;
        }
        .title {
            font-size: 28px;
            font-weight: 600;
            letter-spacing: -1px;
            position: relative;
            display: flex;
            align-items: center;
            padding-left: 30px;
            color: #00bfff;
        }
        .message, 
        .signin {
            font-size: 14.5px;
            color: rgba(255, 255, 255, 0.7);
        }
        .signin {
            text-align: center;
        }
        .signin a:hover {
            text-decoration: underline royalblue;
        }
        .signin a {
            color: #00bfff;
        }
        .form label {
            position: relative;
        }
        .form label .input {
            background-color: #333;
            color: #fff;
            width: 100%;
            padding: 20px 5px 5px 10px;
            outline: 0;
            border: 1px solid rgba(105, 105, 105, 0.397);
            border-radius: 10px;
        }
        .submit {
            border: none;
            outline: none;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            background-color: #00bfff;
        }
        .submit:hover {
            background-color: #00bfff96;
        }
    </style>
</head>
<body>
    <center>
    <form class="form" method="POST" action="home.php">
        <p class="title">Sign In</p>
        <p class="message">Log in to access your account.</p>

        <?php if ($message): ?>
            <p style="color: red;"><?php echo $message; ?></p>
        <?php endif; ?>

        <label>
            <input class="input" type="email" name="email" placeholder="" required="">
            <span>Email</span>
        </label> 
        
        <label>
            <input class="input" type="password" name="password" placeholder="" required="">
            <span>Password</span>
        </label>
        
        <button class="submit">Submit</button>
        <p class="signin">Don't have an account? <a href="user.php">Sign Up</a></p>
        <p class="signin">You are Admin? <a href="login.php">Admin sign in</a></p>
        <div data-role="footer" align="center">
        <small>Programmed by: Roniel Marco Bayaua
      </div>
    </form>
    </center>
</body>
</html>
