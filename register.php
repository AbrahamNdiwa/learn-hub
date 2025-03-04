<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $fullname = clean_input($_POST['fullname']);
    $email = clean_input($_POST['email']);
    $password = password_hash(clean_input($_POST['password']), PASSWORD_BCRYPT);
    
    $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";
    $conn->query($sql);
    header("Location: auth.php");
}
?>