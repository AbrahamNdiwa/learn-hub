<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$fullname = $_SESSION['fullname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - LearnHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="d-flex">
        <nav class="bg-light vh-100 p-3" style="width: 250px;">
            <h4>LearnHub</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="#" class="nav-link menu-item" data-target="dashboard-content">Dashboard</a></li>
                <li class="nav-item"><a href="#" class="nav-link menu-item" data-target="my-notes-content">My Notes</a></li>
                <li class="nav-item"><a href="#" class="nav-link menu-item" data-target="bookmarks-content">Bookmarks</a></li>
                <li class="nav-item"><a href="#" class="nav-link menu-item" data-target="settings-content">Settings</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link text-danger">Logout</a></li>
            </ul>
        </nav>
        <div class="container p-4">
            <div id="dashboard-content">
                <h2>Welcome, <?php echo $fullname; ?>!</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card p-3">
                            <h5>Total Notes</h5>
                            <p>10</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-3">
                            <h5>Bookmarks</h5>
                            <p>5</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-3">
                            <h5>Total Views</h5>
                            <p>200</p>
                        </div>
                    </div>
                </div>
                <h4 class="mt-4">Recent Activity</h4>
                <ul>
                    <li>Added new note: "Chemistry Final Review" - 2 hours ago</li>
                    <li>Updated note: "Physics Equations" - 1 day ago</li>
                    <li>Bookmarked: "Math Formulas" - 3 days ago</li>
                </ul>
                <a href="#" class="btn btn-primary">Create New Note</a>
                <a href="#" class="btn btn-secondary">Browse Notes</a>
            </div>
            <div id="my-notes-content" style="display: none;">
                <h2>My Notes</h2>
                <p>Here you can manage your notes.</p>
            </div>
            <div id="bookmarks-content" style="display: none;">
                <h2>Bookmarks</h2>
                <p>Here are your bookmarked notes.</p>
            </div>
            <div id="settings-content" style="display: none;">
                <h2>Settings</h2>
                <p>Manage your account settings here.</p>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.menu-item').click(function(e) {
                e.preventDefault();
                var target = $(this).data('target');
                $('div[id$="-content"]').hide();
                $('#' + target).show();
            });
        });
    </script>
</body>
</html>