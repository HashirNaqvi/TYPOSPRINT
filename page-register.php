<?php
/* Template Name: Register */
get_header();
?>
<div class="register-form">
    <?php if (isset($_GET['error'])): ?>
        <p class="error-message"><?php echo esc_html($_GET['error']); ?></p>
    <?php endif; ?>
    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
        <input type="hidden" name="action" value="custom_register">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="university_name" placeholder="University Name" required>
        <input type="url" name="linkedin_url" placeholder="LinkedIn URL" required>
        <button type="submit">Register</button>
    </form>
</div>
<?php
get_footer();
?>
