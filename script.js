document.addEventListener("DOMContentLoaded", function () {
    // Filter Articles
    document.getElementById("article-filter").addEventListener("input", function () {
        const searchTerm = this.value.toLowerCase();
        const articles = document.querySelectorAll("#articles-container div");
        articles.forEach(article => {
            const text = article.textContent.toLowerCase();
            article.style.display = text.includes(searchTerm) ? "block" : "none";
        });
    });

    // Filter Videos
    document.getElementById("video-filter").addEventListener("input", function () {
        const searchTerm = this.value.toLowerCase();
        const videos = document.querySelectorAll("#videos-container div");
        videos.forEach(video => {
            const text = video.textContent.toLowerCase();
            video.style.display = text.includes(searchTerm) ? "block" : "none";
        });
    });

    // Add New Comment
    document.getElementById("add-comment").addEventListener("click", function () {
        const newComment = document.getElementById("new-comment").value.trim();
        if (newComment) {
            const commentContainer = document.getElementById("discussion-container");
            const newCommentDiv = document.createElement("div");
            newCommentDiv.textContent = newComment;
            commentContainer.appendChild(newCommentDiv);
            document.getElementById("new-comment").value = ""; // Clear input field
        } else {
            alert("Please enter a comment before posting!");
        }
    });
});
