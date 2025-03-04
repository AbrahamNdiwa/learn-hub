<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit();
}
$fullname = $_SESSION['fullname'];

$initials = initials($fullname);

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
        <a href="#" class="btn btn-primary load-page" data-page="add_note.php">Create New Note</a>
        <a href="#" class="btn btn-secondary">Browse Notes</a>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('.menu-item').click(function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('#main-content').load(target + '.php');
        });

        $('.load-page').click(function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            $('#main-content').load(page);
        });
    });
</script>
</html>