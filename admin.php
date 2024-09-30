<?php
session_start();

// Database connection (replace with your database credentials)
$servername = "localhost";
$username = "root"; // change as necessary
$password = ""; // change as necessary
$dbname = "library"; // change as necessary

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve borrowed books
$sql = "SELECT name, membership_number, phone, book_title, borrow_date FROM borrowed_books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
    <title>Admin - Borrowed Books</title>
</head>

<body>
    <nav id="nav">
        <h1>Borrowed Books Admin</h1>
        <a href="index.html">Back to Home</a>
    </nav>

    <div class="adminSection">
        <h1 class="adminTitle">Borrowed Books</h1>
        <?php
        // Display success or error message
        if (isset($_SESSION['success_message'])) {
            echo '<div class="message success">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }
        if (isset($_SESSION['error_message'])) {
            echo '<div class="message error">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>

        <table class="borrowedBooksTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Membership Number</th>
                    <th>Phone Number</th>
                    <th>Book Title</th>
                    <th>Borrow Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['name']}</td>
                                <td>{$row['membership_number']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['book_title']}</td>
                                <td>{$row['borrow_date']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No borrowed books found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <footer>
        <span>@library. All rights reserved. 2024.</span>
    </footer>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
