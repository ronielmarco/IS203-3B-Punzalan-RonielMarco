<?php
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
    $Fname = $conn->real_escape_string($_POST['firstname']);
    $Lname = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM regis WHERE email='$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        $message = "This email is already registered. Please use a different email.";
    } else {
        // Insert into database
        $sql = "INSERT INTO regis (firstname, lastname, email, password) VALUES ('$Fname', '$Lname', '$email', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            header('Location: signin.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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

.title::before {
  width: 18px;
  height: 18px;
}

.title::after {
  width: 18px;
  height: 18px;
  animation: pulse 1s linear infinite;
}

.title::before,
.title::after {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  border-radius: 50%;
  left: 0px;
  background-color: #00bfff;
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

.flex {
  display: flex;
  width: 100%;
  gap: 6px;
}

.form label {
  position: relative;
}

.form label .input {
  background-color: #333;
  color: #fff;
  width: 100%;
  padding: 20px 05px 05px 10px;
  outline: 0;
  border: 1px solid rgba(105, 105, 105, 0.397);
  border-radius: 10px;
}

.form label .input + span {
  color: rgba(255, 255, 255, 0.5);
  position: absolute;
  left: 10px;
  top: 0px;
  font-size: 0.9em;
  cursor: text;
  transition: 0.3s ease;
}

.form label .input:placeholder-shown + span {
  top: 12.5px;
  font-size: 0.9em;
}

.form label .input:focus + span,
.form label .input:valid + span {
  color: #00bfff;
  top: 0px;
  font-size: 0.7em;
  font-weight: 600;
}

.input {
  font-size: medium;
}

.submit {
  border: none;
  outline: none;
  padding: 10px;
  border-radius: 10px;
  color: #fff;
  font-size: 16px;
  transform: .3s ease;
  background-color: #00bfff;
}

.submit:hover {
  background-color: #00bfff96;
}

@keyframes pulse {
  from {
    transform: scale(0.9);
    opacity: 1;
  }

  to {
    transform: scale(1.8);
    opacity: 0;
  }
}
    </style>
</head>
<body>
    <center>
    <form class="form" method="POST" action="">
        <p class="title">Register</p>
        <p class="message">Signup now and get full access to our app.</p>

        <?php if ($message): ?>
            <p style="color: red;"><?php echo $message; ?></p>
        <?php endif; ?>

        <div class="flex">
            <label>
                <input class="input" type="text" name="firstname" placeholder="" required="">
                <span>Firstname</span>
            </label>

            <label>
                <input class="input" type="text" name="lastname" placeholder="" required="">
                <span>Lastname</span>
            </label>
        </div>  
        
        <label>
            <input class="input" type="email" name="email" placeholder="" required="">
            <span>Email</span>
        </label> 
        
        <label>
            <input class="input" type="password" name="password" placeholder="" required="">
            <span>Password</span>
        </label>
        
        <label>
            <input class="input" type="password" placeholder="" required="">
            <span>Confirm password</span>
        </label>
        
        <button class="submit">Submit</button>
        <p class="signin">Already have an account? <a href="signin.php">Signin</a></p>
        <div data-role="footer" align="center">
        <small>Programmed by: Roniel Marco Bayaua
      </div>
    </form>
    </center>
</body>
</html>
