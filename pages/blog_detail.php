<?php
require('/laragon/www/dulich/connection.php');
require("/laragon/www/dulich/include/nav.php");

// Lấy id từ URL
$blog_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$blog_id) {
    die("Blog ID là bắt buộc.");
}

// Tăng số lượt xem của bài viết
$update_views_query = "UPDATE blog SET views = views + 1 WHERE id = ?";
$stmt = $con->prepare($update_views_query);
$stmt->bind_param('i', $blog_id);

if (!$stmt->execute()) {
    die("Lỗi khi cập nhật lượt xem: " . $stmt->error);
}

$stmt->close();

// Lấy danh sách 4 bài viết được xem nhiều nhất
$most_viewed_posts_query = "SELECT id, title, image_url, views, date FROM blog ORDER BY views DESC LIMIT 4";
$most_viewed_posts_result = mysqli_query($con, $most_viewed_posts_query);

$most_viewed_posts = [];
if ($most_viewed_posts_result) {
    while ($row = mysqli_fetch_assoc($most_viewed_posts_result)) {
        $most_viewed_posts[] = $row;
    }
}

// Lấy thông tin chi tiết bài viết
$query = "SELECT * FROM blog WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $blog_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $blog_data = $result->fetch_assoc();
} else {
    die("Không tìm thấy bài viết.");
}
$stmt->close();

// Lấy location_id của bài viết hiện tại
$location_query = "
    SELECT location_id FROM location_blog 
    WHERE blog_id = ?
    LIMIT 1";
$stmt = $con->prepare($location_query);
$stmt->bind_param('i', $blog_id);
$stmt->execute();
$location_result = $stmt->get_result();

if ($location_result->num_rows > 0) {
    $location_data = $location_result->fetch_assoc();
    $current_location_id = $location_data['location_id'];
} else {
    die("Không tìm thấy địa điểm của bài viết.");
}
$stmt->close();

// Lấy danh sách 4 bài viết được xem nhiều nhất
$popular_posts_query = "SELECT id, title, image_url, date FROM blog ORDER BY views DESC LIMIT 4";
$popular_posts_result = mysqli_query($con, $popular_posts_query);

$popular_posts = [];
if ($popular_posts_result) {
    while ($row = mysqli_fetch_assoc($popular_posts_result)) {
        $popular_posts[] = $row;
    }
}


// Xác định danh mục hiện tại của bài viết
$category_query = "
    SELECT c.name FROM category c
    JOIN blog_cate bc ON c.id = bc.cate_id
    WHERE bc.blog_id = ?
    LIMIT 1";
$stmt = $con->prepare($category_query);
$stmt->bind_param('i', $blog_id);
$stmt->execute();
$category_result = $stmt->get_result();

if ($category_result->num_rows > 0) {
    $category_data = $category_result->fetch_assoc();
    $current_category = $category_data['name'];
} else {
    die("Không tìm thấy danh mục của bài viết.");
}
$stmt->close();

// Lấy các bài viết liên quan theo địa điểm và danh mục hiện tại
$related_query = "
    SELECT DISTINCT b.* FROM blog b
    JOIN location_blog lb ON b.id = lb.blog_id
    JOIN blog_cate bc ON b.id = bc.blog_id
    JOIN category c ON bc.cate_id = c.id
    WHERE lb.location_id = ? 
      AND c.name = ? 
      AND b.id != ?
    LIMIT 5";
$stmt = $con->prepare($related_query);
$stmt->bind_param('isi', $current_location_id, $current_category, $blog_id);
$stmt->execute();
$related_result = $stmt->get_result();
$related_blogs = [];
while ($related_blog = $related_result->fetch_assoc()) {
    $related_blogs[] = $related_blog;
}
$stmt->close();

// Lấy danh sách các bài viết xem nhiều nhất
$popular_posts_query = "SELECT id, title, image_url, date FROM blog ORDER BY date DESC LIMIT 5";
$popular_posts_result = mysqli_query($con, $popular_posts_query);

$popular_posts = [];
if ($popular_posts_result) {
    while ($row = mysqli_fetch_assoc($popular_posts_result)) {
        $popular_posts[] = $row;
    }
}

// Lấy bình luận và phản hồi
function get_comments($blog_id, $parent_id = null, $depth = 0)
{
    global $con;
    $query = "SELECT c.*, u.username, u.img 
              FROM comments c 
              JOIN user_form u ON c.user_id = u.id 
              WHERE c.blog_id = ? AND c.parent_id " . ($parent_id ? "= ?" : "IS NULL") . " 
              ORDER BY c.created_at DESC";
    $stmt = $con->prepare($query);
    if ($parent_id) {
        $stmt->bind_param('ii', $blog_id, $parent_id);
    } else {
        $stmt->bind_param('i', $blog_id);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $comments = [];
    while ($comment = $result->fetch_assoc()) {
        $comment['depth'] = $depth;
        $comment['replies'] = get_comments($blog_id, $comment['id'], $depth + 1);
        $comments[] = $comment;
    }
    $stmt->close();
    return $comments;
}

$comments = get_comments($blog_id);
$total_comments = count($comments);
?>

<?php require("/laragon/www/dulich/include/Hblog_detail.php") ?>
<div style="width: 70%; margin-left: 100px">
    <div class="row" style="margin-block-start: 35px;">
        <!-- Main Content -->
        <div class="col-md-8 shadow-box">
            <h1 class="blog-title"><?php echo htmlspecialchars($blog_data['title']); ?></h1>
            <div class="blog-meta">
                <p style="margin-left: -630px;"><span>TripBoss</span> <?php echo htmlspecialchars($blog_data['date']); ?></p>
            </div>
            <img src="/admin/anh/<?php echo htmlspecialchars($blog_data['image_url']); ?>" alt="Blog Image" class="blog-image">
            <div class="blog-content">
                <?php echo nl2br(($blog_data['content'])); ?>
            </div>

            <div class="comment-section">
                <h5 class="mt-4 mb-3">Comments (<?php echo $total_comments; ?>)</h5>
                <form method="POST" action="add_comment.php">
                    <div class="form-group">
                        <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">
                        <textarea class="form-control" name="comment" rows="3" placeholder="Viết bình luận..." required></textarea>
                    </div>
                    <button type="submit" class="btn5">Submit comments</button>
                </form>
                <?php if (!empty($comments)) : ?>
                    <?php foreach ($comments as $comment) : ?>
                        <?php render_comment($comment); ?>
                    <?php endforeach; ?>
                <?php else : ?>
                <?php endif; ?>
            </div>



        </div>
        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="sidebar" style="padding: 20px; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px;">
                <h2 class="sidebar-title">Bài Viết Xem Nhiều Nhất</h2>
                <div class="popular-posts">
                    <?php foreach ($most_viewed_posts as $post) : ?>
                        <div class="post-item">
                            <img src="/admin/anh/<?php echo htmlspecialchars($post['image_url']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                            <div class="post-details">
                                <h6><a href="blog_detail.php?id=<?php echo $post['id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a></h6>
                                <!-- Hiển thị ngày tháng mà không có giờ -->
                                <div class="post-date"><?php echo htmlspecialchars(date('d/m/Y', strtotime($post['date']))); ?></div>
                                <div class="post-views" style="font-size: 12px; color:#e55a4f"><?php echo htmlspecialchars($post['views']); ?> lượt xem</div> <!-- Hiển thị số lượt xem -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Tags Section -->
            <div class="tags mt-4">
                <h5>Tags</h5>
                <?php
                // Lấy tất cả danh mục từ bảng category
                $tags_query = "SELECT id, name FROM category";
                $tags_result = mysqli_query($con, $tags_query);

                if ($tags_result && mysqli_num_rows($tags_result) > 0) {
                    while ($tag = mysqli_fetch_assoc($tags_result)) {
                        // Hiển thị mỗi danh mục dưới dạng một tag với link dẫn đến trang category.php
                        echo '<a href="category.php?id=' . htmlspecialchars($tag['id']) . '" class="tag-item">' . htmlspecialchars($tag['name']) . '</a>';
                    }
                } else {
                    echo '<p>No tags found.</p>';
                }
                ?>
            </div>
        </div>

        <div class="related-posts">
            <h3 class="mb-3">Xem thêm các trải nghiệm khác</h3>
            <div class="row">
                <?php foreach ($related_blogs as $related_blog) : ?>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="blog_detail.php?id=<?php echo $related_blog['id']; ?>">
                                <img src="/admin/anh/<?php echo htmlspecialchars($related_blog['image_url']); ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($related_blog['title']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($related_blog['summary']); ?></p>
                                    <a href="blog_detail.php?id=<?php echo $related_blog['id']; ?>" class="btn1 btn-danger btn-sm" style="margin-left: 100px; margin-top: 500px; background-color: orange !important">Learn More</a>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <script>
            function showReplyForm(commentId) {
                var replyForm = document.getElementById('reply-form-' + commentId);
                replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
            }

            function toggleReplies(commentId) {
                var replies = document.getElementById('replies-' + commentId);
                var toggleButton = document.getElementById('toggle-replies-button-' + commentId);

                if (replies.style.display === 'none') {
                    replies.style.display = 'block';
                    toggleButton.innerText = 'Ẩn phản hồi';
                } else {
                    replies.style.display = 'none';
                    toggleButton.innerText = 'Hiển thị (' + replies.childElementCount + ')';
                }
            }

            function toggleLike(commentId) {
                var likeButton = document.getElementById('like-button-' + commentId);
                var isLiked = likeButton.querySelector('i').classList.contains('liked');
                var action = isLiked ? 'unlike' : 'like';

                // Gửi yêu cầu AJAX để thích hoặc bỏ thích bình luận
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'like_unlike_comment.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            likeButton.querySelector('i').classList.toggle('liked');
                            likeButton.querySelector('i').classList.toggle('unliked');
                        } else {
                            alert(response.message);
                        }
                    }
                };
                xhr.send('comment_id=' + commentId + '&action=' + action);
            }
        </script>


        <?php
        function render_comment($comment)
        { ?>
            <div class="comment-item" style="margin-left: <?php echo $comment['depth'] * 20; ?>px;">
                <div class="comment-header">
                    <img src="/assets/img/profile/<?php echo htmlspecialchars($comment['img']); ?>" alt="User Image" class="user-img">
                    <div>
                        <div class="username"><?php echo htmlspecialchars($comment['username']); ?></div>
                        <div class="created-at"><?php echo htmlspecialchars($comment['created_at']); ?></div>
                    </div>
                </div>
                <div class="comment-text" id="comment-text-<?php echo $comment['id']; ?>">
                    <?php echo htmlspecialchars($comment['comment']); ?>
                </div>
                <div class="button-group">
                    <button class="reply-button" onclick="showReplyForm(<?php echo $comment['id']; ?>)">Phản hồi</button>
                    <button class="like-button" id="like-button-<?php echo $comment['id']; ?>" onclick="toggleLike(<?php echo $comment['id']; ?>)">
                        <i class="fas fa-heart <?php echo $comment['likes'] == 1 ? 'liked' : 'unliked'; ?>"></i>
                    </button>
                    <button class="toggle-button" id="toggle-replies-button-<?php echo $comment['id']; ?>" onclick="toggleReplies(<?php echo $comment['id']; ?>)">Hiển thị (<?php echo count($comment['replies']); ?>)</button>
                </div>
                <div class="reply-form" id="reply-form-<?php echo $comment['id']; ?>" style="display: none;">
                    <form method="POST" action="add_comment.php">
                        <div class="form-group">
                            <input type="hidden" name="blog_id" value="<?php echo $comment['blog_id']; ?>">
                            <input type="hidden" name="parent_id" value="<?php echo $comment['id']; ?>">
                            <textarea class="form-control" name="comment" rows="2" placeholder="Viết phản hồi..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Sent</button>
                    </form>
                </div>
                <?php if (!empty($comment['replies'])) : ?>
                    <div class="replies" id="replies-<?php echo $comment['id']; ?>">
                        <?php foreach ($comment['replies'] as $reply) : ?>
                            <?php render_comment($reply); ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        <?php } ?>
    </div>
    </body>
</div>
    </html>
    <div style="width: 100%;">
        <?php require("/laragon/www/dulich/include/footer.php"); ?>
    </div>