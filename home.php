<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Clinic Home</title>
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
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            color: #1a1a1a;
        }
        .services, .contact {
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #1a1a1a;
            color: #fff;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .logout-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #00bfff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    border: none;
    font-size: 16px;
    transition: background-color 0.3s;
}

.logout-button:hover {
    background-color: #00bfff96; /* Slightly transparent on hover */
}

    </style>
</head>
<body>
<header>
    <h1>Welcome to Our Dental Clinic</h1>
    <p>Your smile is our priority!</p> 
     <center>
    <div class="logout" style="float: right; margin: 10px;"> <a href="signin.php" class="logout-button">Logout</a></div>
    
</center>
</header>


    <div class="container">
        <div class="section about">
            <h2>About Us</h2>
            <p>At our dental clinic, we are committed to providing top-notch dental care in a comfortable and friendly environment. Our experienced team of dentists and hygienists are dedicated to ensuring your oral health and helping you achieve the smile you deserve.</p>
        </div>

        <div class="section services">
            <h2>Our Services</h2>
            <ul>
                <li>General Dentistry</li>
                <li>Cosmetic Dentistry</li>
                <li>Orthodontics</li>
                <li>Teeth Whitening</li>
                <li>Dental Implants</li>
                <li>Pediatric Dentistry</li>
            </ul>
        </div>

        <div class="section contact">
            <h2>Contact Us</h2>
            <p>If you have any questions or would like to schedule an appointment, please contact us:</p>
            <p>Email: info@dentalclinic.com</p>
            <p>Phone: (123) 456-7890</p>
            <p>Address: 123 Dental St, Smile City, SC 12345</p>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Dental Clinic. All Rights Reserved.</p> 
        <div data-role="footer" align="center">
        <small>Programmed by: Roniel Marco Bayaua
      </div>     
        
    </footer>
</body>
</html>
