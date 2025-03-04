<?php
include 'db.php';

if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    $searchQuery = "SELECT * FROM notes WHERE title LIKE '%$query%' OR content LIKE '%$query%' ORDER BY created_at DESC";
    $searchResult = mysqli_query($conn, $searchQuery);
} else {
    $searchResult = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>Search Results</h2>
        <form method="GET" action="search.php">
            <input type="text" name="query" class="form-control mb-3" placeholder="Search notes..." value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <?php if (isset($_GET['query'])): ?>
            <?php if (mysqli_num_rows($searchResult) > 0): ?>
                <ul class="list-group mt-3">
                    <?php while ($note = mysqli_fetch_assoc($searchResult)): ?>
                        <li class="list-group-item">
                            <a href="note.php?id=<?php echo $note['id']; ?>">
                                <?php echo htmlspecialchars($note['title']); ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p class="mt-3">No results found.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>