<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$fullname = $_SESSION['fullname'];
$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_profile'])) {
        $new_name = mysqli_real_escape_string($conn, strip_tags($_POST['fullname']) );
        $new_email = mysqli_real_escape_string($conn, strip_tags($_POST['email']));
        
        $update_query = "UPDATE users SET fullname='$new_name', email='$new_email' WHERE id='$user_id'";
        if (mysqli_query($conn, $update_query)) {
            $_SESSION['fullname'] = $new_name;
            $_SESSION['email'] = $new_email;
            echo "<script>alert('Profile updated successfully'); window.location.href = 'dashboard.php';</script>";
        } else {
            echo "<script>alert('Error updating profile'); window.location.href = 'dashboard.php';</script>";
        }
    }
    
    if (isset($_POST['change_password'])) {
        $current_password = mysqli_real_escape_string($conn, strip_tags($_POST['current_password']) );
        $new_password = mysqli_real_escape_string($conn, strip_tags($_POST['new_password']));
        $confirm_password = mysqli_real_escape_string($conn, strip_tags($_POST['confirm_password']) );
        
        $query = "SELECT password FROM users WHERE id='$user_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($current_password, $row['password'])) {
            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_pass_query = "UPDATE users SET password='$hashed_password' WHERE id='$user_id'";
                if (mysqli_query($conn, $update_pass_query)) {
                    echo "<script>alert('Password updated successfully'); window.location.href = 'dashboard.php';</script>";
                } else {
                    echo "<script>alert('Error updating password'); window.location.href = 'dashboard.php';</script>";
                }
            } else {
                echo "<script>alert('New passwords do not match'); window.location.href = 'dashboard.php';</script>";
            }
        } else {
            echo "<script>alert('Incorrect current password'); window.location.href = 'dashboard.php';</script>";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - LearnHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container p-4">
        <h3>Account Settings</h3>
        <form method="POST" action="settings.php">
            <div class="mb-2">
                <label class="form-label">Full Name</label>
                <input type="text" name="fullname" class="form-control" value="<?php echo htmlspecialchars($fullname); ?>" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
        </form>
        <hr>
        <h4>Change Password</h4>
        <form method="POST" action="settings.php">
            <div class="mb-2">
                <label class="form-label">Current Password</label>
                <input type="password" name="current_password" class="form-control" required>
            </div>
            <div class="mb-2">
                <label class="form-label">New Password</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" name="change_password" class="btn btn-warning">Change Password</button>
        </form>
        <hr>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
