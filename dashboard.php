<?php
include 'db.php';
session_start();

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Handle logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}

// Handle new forum post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['forum_post'])) {
    $user_id = $_SESSION['user_id'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO forum_posts (user_id, comment) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $user_id, $comment);

    if ($stmt->execute()) {
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Handle new article post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['article_post'])) {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO articles (user_id, title, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iss', $user_id, $title, $content);

    if ($stmt->execute()) {
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch articles from the database
$sql_articles = "SELECT title, content FROM articles";
$stmt_articles = $conn->prepare($sql_articles);
$stmt_articles->execute();
$stmt_articles->bind_result($article_title, $article_content);

$articles = [];
while ($stmt_articles->fetch()) {
    $articles[] = ['title' => $article_title, 'content' => $article_content];
}

// Fetch forum posts from the database
$sql_forum = "SELECT comment FROM forum_posts";
$stmt_forum = $conn->prepare($sql_forum);
$stmt_forum->execute();
$stmt_forum->bind_result($forum_comment);

$forum_posts = [];
while ($stmt_forum->fetch()) {
    $forum_posts[] = ['comment' => $forum_comment];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Climate Change Awareness Hub</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <header>
        <h1>Climate Change Awareness Hub</h1>
        <p>Educating and informing users about climate change.</p>
    </header>
    <main>
        <!-- Articles Section -->
        <section id="articles-section">
            <h2>Articles</h2>
            <input type="text" id="article-filter" placeholder="Search articles...">
            <div id="articles-container">
                <?php foreach ($articles as $article): ?>
                    <div>
                        <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                        <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Videos Section -->
        <section id="videos-section">
            <h2>Videos</h2>
            <input type="text" id="video-filter" placeholder="Search videos...">
            <div id="videos-container">
                <div>
                <div>
                    <h3>Understading the climate change</h3>
                    <video width="640" height="360" controls loop>
                        <source src="video/video1.mp4" type="video/mp4">
                    </video>
                </div>
                <div>
                    <h3>Solutions for a Greener Planet</h3>
                    <video width="640" height="360" controls loop>
                        <source src="video/video2.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
        </section>

        <!-- New Article Section -->
        <section id="new-article-section">
            <h2>Post New Article</h2>
            <form method="POST">
                <input type="text" name="title" placeholder="Article Title" required>
                <textarea name="content" placeholder="Article Content" required></textarea>
                <button type="submit" name="article_post">Post Article</button>
            </form>
        </section>

        <!-- Forum Discussions Section -->
        <section id="discussions-section">
            <h2>Forum Discussions</h2>
            <div id="discussion-container">
                <?php foreach ($forum_posts as $post): ?>
                    <div><?php echo nl2br(htmlspecialchars($post['comment'])); ?></div>
                <?php endforeach; ?>
            </div>

            <form method="POST">
                <textarea name="comment" placeholder="Add a comment..."></textarea>
                <button type="submit" name="forum_post">Post Comment</button>
            </form>
        </section>
    </main>

    <!-- Logout Button -->
    <footer>
        <div class="logout-container">
            <a href="?logout" class="logout-btn">Logout</a>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>





    