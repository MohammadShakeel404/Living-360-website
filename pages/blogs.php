<div class="page-header">
    <div class="container">
        <h1 class="text-gradient">Our Blog</h1>
        <p>Stay up to date with the latest trends and tips in interior design.</p>
    </div>
</div>

<div class="section blogs-list-section">
    <div class="container">
        <?php
        if (isset($_GET['slug'])) {
            $slug = $_GET['slug'];
            $blog = getBlogBySlug($slug);
            
            if ($blog) {
                echo '
                <div class="blog-detail">
                    <div class="blog-header">
                        <h1>' . $blog['title'] . '</h1>
                        <div class="blog-meta">
                            <p><i class="fas fa-user"></i> ' . $blog['author'] . '</p>
                            <p><i class="fas fa-calendar"></i> ' . date('F d, Y', strtotime($blog['created_at'])) . '</p>
                        </div>
                    </div>
                    
                    <div class="blog-image">
                        <img src="assets/images/uploads/' . $blog['featured_image'] . '" alt="' . $blog['title'] . '">
                    </div>
                    
                    <div class="blog-content">
                        ' . $blog['content'] . '
                    </div>
                    
                    <div class="blog-cta">
                        <a href="index.php?page=blogs" class="btn btn-outline">Back to Blog</a>
                    </div>
                </div>
                ';
            }
        } else {
            echo '<div class="blogs-grid">';
            
            $blogs = getActiveBlogs();
            foreach ($blogs as $blog) {
                echo '
                <div class="blog-card animate-on-scroll">
                    <div class="blog-image">
                        <img src="assets/images/uploads/' . $blog['featured_image'] . '" alt="' . $blog['title'] . '">
                    </div>
                    <div class="blog-content">
                        <h3>' . $blog['title'] . '</h3>
                        <div class="blog-meta">
                            <p><i class="fas fa-user"></i> ' . $blog['author'] . '</p>
                            <p><i class="fas fa-calendar"></i> ' . date('F d, Y', strtotime($blog['created_at'])) . '</p>
                        </div>
                        <p>' . $blog['excerpt'] . '</p>
                        <a href="index.php?page=blogs&slug=' . $blog['slug'] . '" class="read-btn">Read Article&nbsp;&rarr;</a>
                    </div>
                </div>
                ';
            }
            
            echo '</div>';
        }
        ?>
    </div>
</div>

<div class="section newsletter-section">
    <div class="container">
        <div class="newsletter-content">
            <h2 class="text-gradient">Subscribe to Our Newsletter</h2>
            <p>Get the latest interior design tips and trends delivered to your inbox.</p>
            
            <form class="newsletter-form">
                <input type="email" placeholder="Your email address" required>
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
        </div>
    </div>
</div>