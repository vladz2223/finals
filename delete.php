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

$search_query = ""; // Default search query is empty
$search_results = []; // Array to store search results

// Handle search functionality
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];

    // Sanitize input for security
    $search_query = mysqli_real_escape_string($conn, $search_query);

    // SQL to search for users by first name or last name
    $sql = "SELECT * FROM department WHERE fname LIKE '%$search_query%' OR lname LIKE '%$search_query%'";
    $search_results = $conn->query($sql); // Execute query
}

// Handle deletion
if (isset($_GET['user_id'])) {
    $delete_id = $_GET['user_id'];  // Get user_id from URL

    // Sanitize input for security
    $delete_id = mysqli_real_escape_string($conn, $delete_id);

    // Start a transaction to ensure all related records are deleted
    $conn->begin_transaction();

    try {
        // Delete from department table
        $sql = "DELETE FROM department WHERE user_id = $delete_id";
        if ($conn->query($sql) === TRUE) {
            // If user is deleted from department, related records in department-specific tables will also be deleted due to cascading
            echo "<script>alert('User and related records deleted successfully.'); window.location.href = 'dashboard.php';</script>";
        } else {
            throw new Exception("Error deleting from department table: " . $conn->error);
        }

        // Commit the transaction
        $conn->commit();
    } catch (Exception $e) {
        // Rollback the transaction if anything goes wrong
        $conn->rollback();
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <style>
        /* General Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            color: #333;
        }

        /* Container for the form and results */
        .container {
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 800px;
            margin-top: 50px;
        }

        h3 {
            text-align: center;
            color: #333;
        }

        /* Search Form Styling */
        .search-form {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-form input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 300px;
        }

        .search-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-form button:hover {
            background-color: #0056b3;
        }

        /* Results Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            color: #333;
        }

        td {
            background-color: #fff;
        }

        /* Action Link Styling */
        a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        /* No results message */
        .no-results {
            text-align: center;
            font-size: 16px;
            color: #888;
        }
    </style>
</head>
<body>

    <div class="container">
        <h3>Search and Delete User</h3>

        <!-- Search form -->
        <form method="POST" class="search-form">
            <input type="text" name="search" value="<?= htmlspecialchars($search_query) ?>" placeholder="Search by first name or last name">
            <button type="submit">Search</button>
        </form>

        <?php if ($search_query): ?>
            <h3>Search Results for: <?= htmlspecialchars($search_query) ?></h3>
            <?php if (mysqli_num_rows($search_results) > 0): ?>
                <table>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Action</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($search_results)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['fname']) ?></td>
                            <td><?= htmlspecialchars($row['lname']) ?></td>
                            <td>
                                <!-- Delete link with confirmation -->
                                <a href="?user_id=<?= $row['user_id'] ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p class="no-results">No results found.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
