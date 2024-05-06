<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>

<?php
if(isset($_POST['submit'])) {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "finance";

    $conn = mysqli_connect($hostname, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO registered (FirstName, LastName, Course, Dates, Amount) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $course, $date, $amount);

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $course = $_POST['course'];
    $date = $_POST['date'];
    $amount = $_POST['amount'];

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Registered successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<form method="post" action="">
    <input type="text" name="fname" placeholder="First Name"><br>
    <input type="text" name="lname" placeholder="Last Name"><br>
    <input type="text" name="course" placeholder="Course"><br>
    <input type="date" name="date"><br>
    <input type="number" name="amount" placeholder="Amount"><br>
    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>