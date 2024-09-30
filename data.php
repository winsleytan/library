<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $name = htmlspecialchars($_POST['name']);
    $membership_number = htmlspecialchars($_POST['membership_number']);
    $phone = htmlspecialchars($_POST['phone']);
    $book_title = htmlspecialchars($_POST['book_title']);
    $borrow_date = date("Y-m-d H:i:s");

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

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO borrowed_books (name, membership_number, phone, book_title, borrow_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $membership_number, $phone, $book_title, $borrow_date);

    // Execute the statement
    if ($stmt->execute()) {
        // Set session variables to display later on the admin page
        $_SESSION['success_message'] = "Book borrowed successfully!";
        $_SESSION['borrowed_book'] = [
            'name' => $name,
            'membership_number' => $membership_number,
            'phone' => $phone,
            'book_title' => $book_title,
            'borrow_date' => $borrow_date
        ];
    } else {
        $_SESSION['error_message'] = "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();

    // Redirect to admin page or the same page to display borrowed book info
    header("Location: admin.php");
    exit();
} else {
    // Redirect to index if accessed directly
    header("Location: index.html");
    exit();
}
?>
