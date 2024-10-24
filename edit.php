<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

$host = 'localhost';
$database = 'marco';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch patient details for editing
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM patients WHERE id = $id");
    $patient = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values and sanitize
    $name = $conn->real_escape_string($_POST['name']);
    $concern = $conn->real_escape_string($_POST['concern']);
    $address = $conn->real_escape_string($_POST['address']);
    $contact_number = $conn->real_escape_string($_POST['contact_number']);

    // Update patient information
    $sql = "UPDATE patients SET name='$name', concern='$concern', address='$address', contact_number='$contact_number' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: admin.php'); // Redirect back to admin page
        exit();
    } else {
        $message = "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient Information</title>
    <style>
        body {
            background-color: rgba(173, 216, 230, 0.8);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        header {
            background-color: #1a1a1a;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }
        h2 {
            color: #00bfff;
        }
        .form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form label {
            display: block;
            margin: 10px 0 5px;
        }
        .form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .submit {
            background-color: #00bfff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .submit:hover {
            background-color: #00bfff96;
        }
        .message {
            margin: 10px 0;
            color: green;
        }
    </style>
</head>
<body>
    <header>
        <h1>Edit Patient Information</h1>
        <p>Modify the details of the patient.</p>
    </header>

    <div class="container">
        <div class="form">
            <?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>
            <form method="POST">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($patient['name']); ?>" required>

                <label for="concern">Concern:</label>
                <input type="text" name="concern" value="<?php echo htmlspecialchars($patient['concern']); ?>" required>

                <label for="address">Address:</label>
                <input type="text" name="address" value="<?php echo htmlspecialchars($patient['address']); ?>" required>

                <label for="contact_number">Contact Number:</label>
                <input type="text" name="contact_number" value="<?php echo htmlspecialchars($patient['contact_number']); ?>" required>

                <button type="submit" class="submit">Update Patient</button>
            </form>
        </div>
    </div>
</body>
</html>
