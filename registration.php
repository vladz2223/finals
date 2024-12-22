<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'registration';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $department = $_POST['department'];
    $birthday = $_POST["birthday"];
    $password = password_hash($_POST['birthday'], PASSWORD_DEFAULT); // Secure password
    $student = $_POST['student'];

    // Insert into department table
    $sql = "INSERT INTO department (fname, lname, birthday, department, student, password) 
            VALUES ('$fname', '$lname', '$birthday', '$department', '$student', '$password')";

    // Check if the insertion was successful
    if ($conn->query($sql) === TRUE) {
        // Get the last inserted user_id (autoincremented)
        $user_id = $conn->insert_id;

        // Insert into the department-specific table based on department
        $insert_sql = "";
        if ($department == "ccs") {
            $insert_sql = "INSERT INTO ccs (user_id, fname, lname, student) VALUES ('$user_id', '$fname', '$lname', '$student')";
        } elseif ($department == "chtm") {
            $insert_sql = "INSERT INTO chtm (user_id, fname, lname, student) VALUES ('$user_id', '$fname', '$lname', '$student')";
        } elseif ($department == "cba") {
            $insert_sql = "INSERT INTO cba (user_id, fname, lname, student) VALUES ('$user_id', '$fname', '$lname', '$student')";
        } elseif ($department == "shs") {
            $insert_sql = "INSERT INTO shs (user_id, fname, lname, student) VALUES ('$user_id', '$fname', '$lname', '$student')";
        }

        // Execute the department-specific insert query
        if ($conn->query($insert_sql) === TRUE) {
            echo "<script>alert('Student successfully added to the $department department.'); window.location.href = 'registration.php';</script>";
        } else {
            echo "ERROR inserting into $department table: " . $conn->error;
        }
    } else {
        echo "ERROR: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>body {
    font-family: Arial, sans-serif;
    
    margin: 0;
    padding: 0;
    
}
body{
    background-image: url('background123.png');
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
}

h2 {
    text-align: center;
    color: #333;
}

/* Registration Form Container */
.registration-container {
    width: 100%;
    max-width: 400px;
    margin: 50px auto;
    padding: 30px;
    background-color: rgba(255, 255, 255, 0.8); /* White with 80% opacity */
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    backdrop-filter: blur(10px); /* Optional: adds a blurred background effect */
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-size: 16px;
    margin-bottom: 5px;
    color: #333;
}

input[type="text"],
input[type="date"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="date"]:focus {
    border-color: #5b9bd5;
    outline: none;
}

button.submit-btn {
    width: 100%;
    padding: 10px;
    background-color: #5b9bd5;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button.submit-btn:hover {
    background-color: #4a89c6;
}</style>
</head>
<body>
    <div class="registration-container">
        <h2>Basketball Registration</h2>
        <form method="POST">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="fname" required placeholder="Enter your first name">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="lname" required placeholder="Enter your last name">
            </div>
            <div class="form-group">
                <label for="department">Department</label>
                <select name="department" required>
                    <option value="ccs">CCS</option>
                    <option value="chtm">CHTM</option>
                    <option value="cba">CBA</option>
                    <option value="shs">SHS</option>
                </select>
            </div>

            <div class="form-group">
                <label for="birthday">Birthday</label>
                <input type="date" name="birthday" required>
            </div>

            <div class="form-group">
                <label for="student">Student No.</label>
                <input type="text" name="student" required placeholder="Enter your student number">
            </div>

            <div class="form-group">
               <button type="submit" class="submit-btn">Register</button>
            </div>
            <div class="form-footer">
                <p>Are you an admin? Sign up <a href="signup.html">here</a></p>
            </div>
        </form>
    </div>
</body>
</html>
