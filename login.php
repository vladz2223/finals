<?php 
    session_start();
    include('connect.php');

    // Initialize error message variable
    $error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Escape special characters for security
        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);

        // Query to check if email exists
        $sql = "SELECT * FROM admin WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1){
            $row = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $row['password'])){
                // Redirect to dashboard if login is successful
                header("Location: dashboard.php");
                exit();
            } else {
                // Invalid password
                $error = "Invalid email or password.";
            }
        } else {
            // Email not found
            $error = "Invalid email or password.";
        }
    }

    // Close the database connection
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
       * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f2f2f2;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
    font-size: 24px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin: 8px 0;
    font-size: 14px;
    color: #555;
}

input[type="email"],
input[type="password"] {
    padding: 12px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    width: 100%;
    background-color: #f9f9f9;
    transition: border 0.3s ease;
}

input[type="email"]:focus,
input[type="password"]:focus {
    border-color: #4CAF50;
    outline: none;
}

button {
    padding: 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 10px;
}

button:hover {
    background-color: #45a049;
}

button:focus {
    outline: none;
}

.form-footer {
    text-align: center;
    margin-top: 20px;
}

.form-footer a {
    color: #4CAF50;
    text-decoration: none;
    font-size: 14px;
}

.form-footer a:hover {
    text-decoration: underline;
}

.error-message {
    color: red;
    text-align: center;
    font-size: 14px;
    margin-top: 10px;
}


    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="">
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" required><br>
            
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" required><br>
            
            <button type="submit" name="login">Login</button>
        </form>

        <?php
            // Check if an error is set, and display it
            if (!empty($error)) {
                echo '<p class="error-message">' . $error . '</p>';
            }
        ?>

        <p class="form-footer">Don't have an account? Sign up <a href="signup.php">here</a></p>
    </div>
</body>
</html>
