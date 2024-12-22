<?php
session_start();
include('connect.php');

$query1 = "SELECT * FROM ccs";
$result1 = mysqli_query($conn, $query1);

$query2 = "SELECT * FROM cba";
$result2 = mysqli_query($conn, $query2);

$query3 = "SELECT * FROM chtm";
$result3 = mysqli_query($conn, $query3);

$query4 = "SELECT * FROM shs";
$result4 = mysqli_query($conn, $query4);
?>
<html>
    <head>
        <style>
            /* Center the outer table and remove margin-top */
            body {
                justify-content: center;
                align-items: flex-start; /* Align to the top of the page */
                height: 100vh;
                margin: 0;
                font-family: Arial, sans-serif;
                background-image: url('background123.png');
                background-size: cover;
                background-position: center center;
                background-repeat: no-repeat;
            }

            table {
                width: 100%; /* Full width for the outer table */
                margin-top: 50px; /* No margin on top */
                background-color: white;
                
            }

            .players {
                justify-content: center;
            }

            .table-container {
                display: flex;
                justify-content: space-between; /* Space out the two tables */
                width: auto; /* Adjust to fit the content */
                margin-top: 0;
                background-color: white;
            }

            /* Table styles for the inner tables */
            .css, .cba, .chtm, .shs {
                margin-left: auto;
                margin-right: auto;
                width: auto; /* Make both tables have equal width */
                border-collapse: collapse;
                margin-top: 0; /* Ensure there is no top margin for these tables */
            }

            th {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
                background-color: #f2f2f2;
            }

            td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            .delete-container {
                text-align: center; /* Center the content */
                margin-top: 20px; /* Space above the button */
            }

            .button {
                padding: 12px 25px;
                background-color: #4CBB17;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                transition: background-color 0.3s ease;
            }

            .button:hover {
                background-color: rgb(4, 97, 27);
            }

            .btn {
                padding: 12px 25px; /* Add padding for a larger button */
                background-color: #e74c3c; /* Red background */
                color: white; /* White text */
                border: none;
                border-radius: 5px; /* Rounded corners */
                cursor: pointer;
                font-size: 16px;
                transition: background-color 0.3s ease; /* Smooth transition for hover effect */
            }

            /* Hover effect for the delete button */
            .btn:hover {
                background-color: #c0392b; /* Darker red on hover */
            }

            /* Optional: Add focus styles */
            .btn:focus {
                outline: none; /* Remove outline */
                box-shadow: 0 0 5px rgba(231, 76, 60, 0.6); /* Subtle red glow */
            }

            /* Logout button styling */
            .btn-logout {
                padding: 12px 25px; /* Padding for larger button */
                background-color: #f39c12; /* Orange background color */
                color: white; /* White text color */
                border: none;
                border-radius: 5px; /* Rounded corners */
                cursor: pointer;
                font-size: 16px;
                transition: background-color 0.3s ease; /* Smooth transition for hover effect */
            }

            .btn-logout:hover {
                background-color: #e67e22; /* Darker orange on hover */
            }

            /* Optional: Add focus styles for logout button */
            .btn-logout:focus {
                outline: none; /* Remove outline */
                box-shadow: 0 0 5px rgba(243, 156, 18, 0.6); /* Subtle orange glow */
            }
        </style>
    </head>
    <body>
        <!-- Logout button -->
        <a href="logout.php">
            <button class="btn-logout">Logout</button>
        </a>
        <table>
            <tr>
                <td>
                    <div class="table-container">
                        <table class="players">
                            <th colspan="2"><h2>PLAYERS</h2></th>
                            <tr>
                                <td>
                                    <!-- CSS Department Table -->
                                    <table class="css">
                                        <thead>
                                            <tr>
                                                <th colspan="4">CSS DEPARTMENT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($results1 = mysqli_fetch_assoc($result1)) {
                                                echo "<tr>";
                                                echo "<td>" . $results1['ccs_id'] . "</td>";
                                                echo "<td>" . $results1['fname'] . " " . $results1['lname'] . "</td>";
                                                echo "<td>" . $results1['student'] . "</td>";
                                                echo "<td><a href='edit.php?id=" . $results1['ccs_id'] . "'><button class='button'>Edit</button></a></td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <!-- CBA Department Table -->
                                    <td>
                                    <table class="cba">
                                        <thead>
                                            <tr>
                                                <th colspan="4">CBA DEPARTMENT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($results2 = mysqli_fetch_assoc($result2)) {
                                                echo "<tr>";
                                                echo "<td>" . $results2['cba_id'] . "</td>";
                                                echo "<td>" . $results2['fname'] . " " . $results2['lname'] . "</td>";
                                                echo "<td>" . $results2['student'] . "</td>";
                                                echo "<td><a href='edit.php?id=" . $results2['cba_id'] . "'><button class='button'>Edit</button></a></td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    </tr>
                                    <tr>
                                        <td>
                                            <!-- CHTM Department Table -->
                                            <table class="chtm">
                                                <thead>
                                                    <tr>
                                                        <th colspan="4">CHTM DEPARTMENT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($results3 = mysqli_fetch_assoc($result3)) {
                                                        echo "<tr>";
                                                        echo "<td>" . $results3['chtm_id'] . "</td>";
                                                        echo "<td>" . $results3['fname'] . " " . $results3['lname'] . "</td>";
                                                        echo "<td>" . $results3['student'] . "</td>";
                                                        echo "<td><a href='edit.php?id=" . $results3['chtm_id'] . "'><button class='button'>Edit</button></a></td>";
                                                        echo "</tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <!-- SHS Department Table -->
                                            <td>
                                            <table class="shs">
                                                <thead>
                                                    <tr>
                                                        <th colspan="4">SHS DEPARTMENT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($results4 = mysqli_fetch_assoc($result4)) {
                                                        echo "<tr>";
                                                        echo "<td>" . $results4['shs_id'] . "</td>";
                                                        echo "<td>" . $results4['fname'] . " " . $results4['lname'] . "</td>";
                                                        echo "<td>" . $results4['student'] . "</td>";
                                                        echo "<td><a href='edit.php?id=" . $results4['shs_id'] . "'><button class='button'>Edit</button></a></td>";
                                                        echo "</tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </tr>
                                    </table>
                                </div>
                                <div class="delete-container">
                                    <button class="btn" name="delete"><a href="delete.php">Delete</a></button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </body>
            </html>
