<?php

include 'dbConnection.php';

// Process form data when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $address = $_POST["address_no"] . ', ' . $_POST["address_street"] . ', ' . $_POST["address_city"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate password match
    if ($password != $confirm_password) {
        die("Password and Confirm Password do not match");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Set default user role
    $user_type = "customers";

    // SQL query to insert data into the database
    $sql = "INSERT INTO users (first_name, last_name, email, username, address, gender, dob, password, user_type)
            VALUES ('$first_name', '$last_name', '$email', '$username', '$address', '$gender', '$dob', '$hashed_password', '$user_type')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, redirect to login page
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="forms.css">
    <!-- <script src="validation.js"></script> -->
</head>
<body>

    <div class="topnav">
        <a href="home.php">Home</a>
        <a href="promotions.php">Promotions</a>
        <a href="menu.php">Menu</a>
        <a href="aboutus.html">About</a>
        <a href="gallery.html">Gallery</a>
        <a class="active" href="login.php">Login</a>
    </div>


    <h2>Registartion Form</h2>

    <div class="reservationForm"> 
        <form name ="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">

            <input type="text" name="first_name"> <br>
            <label for="first_name">First Name</label>

            <input type="text" name="last_name"  id="lName"> <br>
            <label for="last_name">Last Name</label>

            <input type="email" name="email" > <br>
            <label for="email">Email Address</label>

            <input type="text" name="username" >
            <label for="username">Username</label>

            <input type="text" name="address_no" placeholder="No" > 
            <label for="address">Address No</label>
            <input type="text" name="address_street" placeholder="Street" >
            <label for="address">Address Stress</label>
            <input type="text" name="address_city" placeholder="City" > 
            <label for="address">Address City</label><br> 

            <select name="gender" >
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <label for="gender">Gender</label>
           
            <input type="date" name="dob" > <br>
            <label for="dob">Date of Birth</label>

            <input type="password" name="password" placeholder="" > <br>
            <label for="password">Password</label>

            <input type="password" name="confirm_password" > <br>
            <label for="confirm_password">Confirm Password</label>

            <input type="submit" value="Register" class="register">
            <br> <br>
            <p>Already have an account? <a href="login.php"><b>Click Here</b></a></p>
        </form>
    </div>

    <script>
        function validateForm() {
        let first_name = document.forms["myForm"]["first_name"].value;
        let last_name = document.forms["myForm"]["last_name"].value;
        let email = document.forms["myForm"]["email"].value;
        let username = document.forms["myForm"]["username"].value;
        let address_no = document.forms["myForm"]["address_no"].value;
        let address_street = document.forms["myForm"]["address_street"].value;
        let address_city = document.forms["myForm"]["address_city"].value;
        let dob = document.forms["myForm"]["dob"].value;
        let password = document.forms["myForm"]["password"].value;
        let confirm_password = document.forms["myForm"]["confirm_password"].value;

        if (first_name == "") {
            alert("Please enter your First Name.");
            return false;
        }

        if (last_name == "") {
            alert("Please enter your Last Name.");
            return false;
        }

        if (email == "") {
            alert("Please enter your Email Address.");
            return false;
        } else {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Please enter a valid Email Address.");
                return false;
            }
        }

        if (username == "") {
            alert("Please enter a Username.");
            return false;
        }

        if (address_no == "") {
            alert("Please enter your Address Number.");
            return false;
        }

        if (address_street == "") {
            alert("Please enter your Address Street.");
            return false;
        }

        if (address_city == "") {
            alert("Please enter your Address City.");
            return false;
        }

        if (dob == "") {
            alert("Please enter your Date of Birth.");
            return false;
        }

        if (password == "") {
            alert("Please enter a Password.");
            return false;
        }

        if (confirm_password == "") {
            alert("Please confirm your Password.");
            return false;
        }

        // Check if password and confirm password match
        if (password !== confirm_password) {
            alert("Password and Confirm Password do not match.");
            return false;
        }
    }

    </script>
</body>
</html>