<?php include 'include/header.php'; ?>
<style>
    .small-image {
        width: 100px; /* Adjust the size as needed */
        height: auto;
    }

    /* Style for large image */
    .large-image {
        width: 100%; /* Enlarge the image to fill the container */
        height: auto;
    }
</style>
<section id="page-header" class="blog-header">
    <h2>#readmore</h2>
    <p>Read all case studies about our project!</p>
</section>

<section id="blog">
    <?php
    // Query to retrieve blog posts
    $sql = "SELECT * FROM allblogs";
    $result = $conn->query($sql);

    // Check if there are results
    if ($result->num_rows > 0) {
        $postIndex = 1;
        while ($row = $result->fetch_assoc()) {
            // Extract data from the current row
            $title = $row['blog_title'];
            $content = $row['blog_content'];
            $date = $row['time'];

            // Construct the image URL based on the blog post title
            $imageFileName = 'b' . $postIndex . '.jpg';

            // Generate HTML for the blog post
            echo '<div class="blog-box">';
            echo '    <div class="blog-img">';
            echo '        <img src="img/blog/' . $imageFileName . '" alt="blog" class="small-image">';
            echo '    </div>';
            echo '    <div class="blog-details">';
            echo '        <h4>' . $title . '</h4>';
            echo '        <div class="content-wrapper">';
            if (strlen($content) > 100) {
                echo '        <p>' . substr($content, 0, 100) . '... <a href="#" class="read-more">CONTINUE READING</a></p>';
                echo '        <p class="full-content" style="display: none;">' . $content . ' <a href="#" class="read-less">READ LESS</a></p>';
            } else {
                echo '        <p>' . $content . '</p>';
            }
            echo '        </div>';
            echo '    </div>';
            echo '    <h1>' . $date . '</h1>';
            echo '</div>';
        }
    } else {
        echo 'No blog posts available.';
    }
    // Close the database connection
    $conn->close();
    ?>
</section>

<script>
    // JavaScript to handle "Continue Reading" and "Read Less" links
    const readMoreLinks = document.querySelectorAll('.read-more');
    const readLessLinks = document.querySelectorAll('.read-less');
    readMoreLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            this.parentElement.style.display = 'none';
            this.parentElement.nextElementSibling.style.display = 'block';
        });
    });
    readLessLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            this.parentElement.style.display = 'none';
            this.parentElement.previousElementSibling.style.display = 'block';
        });
    });
</script>

    <section id="pagination" class="section-p1">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#"><i class="fal fa-long-arrow-alt-right"></i></a>

    </section>

<?php include 'include/footer.php'; ?>