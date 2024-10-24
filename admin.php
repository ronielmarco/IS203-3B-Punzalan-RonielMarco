<?php
session_start(); // Start the session

// Check if user is logged in as admin
if (!isset($_SESSION['admin'])) {
    header('Location: login.php'); // Redirect to signin page if not logged in
    exit();
}

// Database connection
$host = 'localhost';
$database = 'marco';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding or deleting a patient
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle deletion of a patient
    if (isset($_POST['delete_id'])) {
        $delete_id = $conn->real_escape_string($_POST['delete_id']);
        $sql = "DELETE FROM patients WHERE id='$delete_id'";
        
        if ($conn->query($sql) === TRUE) {
            $message = "Patient information deleted successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        // Handle adding a patient
        $name = $conn->real_escape_string($_POST['name']);
        $concern = $conn->real_escape_string($_POST['concern']);
        $address = $conn->real_escape_string($_POST['address']);
        $contact_number = $conn->real_escape_string($_POST['contact_number']);

        $sql = "INSERT INTO patients (name, concern, address, contact_number) VALUES ('$name', '$concern', '$address', '$contact_number')";

        if ($conn->query($sql) === TRUE) {
            $message = "Patient information added successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}

// Fetch patient information
$patients = [];
$result = $conn->query("SELECT * FROM patients");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $patients[] = $row;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home - Dental Clinic</title>
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
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        h1 {
            color: #00bfff;
        }
        .form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
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
        .back {
            margin: 10px 0;
        }
        .back a {
            color: #00bfff;
            text-decoration: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #00bfff;
            color: white;
        }
        .edit-btn {
            background-color: #ffc107;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .edit-btn:hover {
            background-color: #e0a800;
        }
        .delete-btn {
            background-color: #dc3545; /* Red for delete */
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #c82333; /* Darker red on hover */
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
        <p>Welcome to the Dental Clinic Admin Panel</p>
        <div class="back">
            <a href="home.php">Back to Home</a>
        </div>
    </header>

    <div class="container">
        <div class="form">
            <h2>Add Patient Information</h2>
            <?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>
            <form method="POST">
                <label for="name">Name:</label>
                <input type="text" name="name" placeholder="Enter patient's name" required>

                <label for="concern">Concern:</label>
                <input type="text" name="concern" placeholder="Enter patient's concern" required>

                <label for="address">Address:</label>
                <input type="text" name="address" placeholder="Enter patient's address" required>

                <label for="contact_number">Contact Number:</label>
                <input type="text" name="contact_number" placeholder="Enter patient's contact number" required>

                <button type="submit" class="submit">Add Patient</button>
            </form>
        </div>

        <h2>Patient Information</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Concern</th>
                    <th>Address</th>
                    <th>Contact Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($patient['name']); ?></td>
                        <td><?php echo htmlspecialchars($patient['concern']); ?></td>
                        <td><?php echo htmlspecialchars($patient['address']); ?></td>
                        <td><?php echo htmlspecialchars($patient['contact_number']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $patient['id']; ?>" class="edit-btn">Edit</a>
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="delete_id" value="<?php echo $patient['id']; ?>">
                                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this patient?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div data-role="footer" align="center">
        <small>Programmed by: Roniel Marco Bayaua
      </div>


    </div>
</body>
</html>
