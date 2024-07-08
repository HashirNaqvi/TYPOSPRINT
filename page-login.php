<?php
/* Template Name: Login */
get_header();
?>
<div class="login-form">
    <form action="<?php echo esc_url(home_url('/test')); ?>" method="POST">
        <input type="hidden" name="action" value="custom_login">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>
<?php
get_footer();
?>