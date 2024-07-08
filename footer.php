<?php
/**
 * The footer for our theme
 *
 * This is the template that displays the footer section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package YourThemeName
 */
?>

<footer class="footer container py-4 mt-5 bg-light text-center rounded">
    <div class="row">
        <div class="col-md-4 mb-3 mb-md-0">
            <h5>About Us</h5>
            <p>Learn more about our mission and the team behind <strong>TYPO SPRINT</strong>.</p>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
            <h5>Contact</h5>
            <p>Email: info@TYPO SPRINT.com</p>
            <p>Phone: +1 234 567 890</p>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
            <h5>Follow Us</h5>
            <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.twitter.com" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
    </div>
    <div class="mt-4">
        <p>&copy; <?php echo date('Y'); ?> <strong>TYPO SPRINT</strong>. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
