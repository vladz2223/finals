<?php
session_start();
include('connect.php');

// Initialize variables and fetch player data
$id = $_GET['id'];
$department = ''; 

$query1 = "SELECT * FROM ccs WHERE ccs_id = '$id'";
$result1 = mysqli_query($conn, $query1);
if (mysqli_num_rows($result1) > 0) {
    $department = 'ccs';
    $row = mysqli_fetch_assoc($result1);
}

// Check if the ID exists for other departments
$query2 = "SELECT * FROM cba WHERE cba_id = '$id'";
$result2 = mysqli_query($conn, $query2);
if (mysqli_num_rows($result2) > 0) {
    $department = 'cba';
    $row = mysqli_fetch_assoc($result2);
}

$query3 = "SELECT * FROM chtm WHERE chtm_id = '$id'";
$result3 = mysqli_query($conn, $query3);
if (mysqli_num_rows($result3) > 0) {
    $department = 'chtm';
    $row = mysqli_fetch_assoc($result3);
}

$query4 = "SELECT * FROM shs WHERE shs_id = '$id'";
$result4 = mysqli_query($conn, $query4);
if (mysqli_num_rows($result4) > 0) {
    $department = 'shs';
    $row = mysqli_fetch_assoc($result4);
}

// Handle form submission for updating the record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $student = $_POST['student'];

    // Update query based on the department
    if ($department == 'ccs') {
        $query = "UPDATE ccs SET fname = '$fname', lname = '$lname', student = '$student' WHERE ccs_id = '$id'";
    } elseif ($department == 'cba') {
        $query = "UPDATE cba SET fname = '$fname', lname = '$lname', student = '$student' WHERE cba_id = '$id'";
    } elseif ($department == 'chtm') {
        $query = "UPDATE chtm SET fname = '$fname', lname = '$lname', student = '$student' WHERE chtm_id = '$id'";
    } elseif ($department == 'shs') {
        $query = "UPDATE shs SET fname = '$fname', lname = '$lname', student = '$student' WHERE shs_id = '$id'";
    }

    if (mysqli_query($conn, $query)) {
        echo "Record updated successfully!";
        header("Location: dashboard.php"); // Redirect to the main page
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Player</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .container {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
        }
        
        .container h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="dashboard.php" class="back-link">Back to Table</a>
        <h2>Edit Player</h2>
        <form method="POST">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" value="<?php echo $row['fname']; ?>" required>

            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" value="<?php echo $row['lname']; ?>" required>

            <label for="student">Student ID:</label>
            <input type="text" id="student" name="student" value="<?php echo $row['student']; ?>" required>

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
