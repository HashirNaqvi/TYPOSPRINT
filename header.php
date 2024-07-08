<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo esc_url(get_stylesheet_uri()); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body <?php body_class(); ?>>
<header class="header container py-4">
    <div class="d-flex justify-content-between align-items-center">
        <div class="logo">
            <img src="<?php echo esc_url(get_template_directory_uri()) . '/logo.jpg'; ?>" alt="Logo" class="img-fluid logo-size">
        </div>
        <nav class="nav mx-auto">
            <a href="/Home" class="btn btn-outline-primary mx-2">Home</a>
            <a href="/test" class="btn btn-outline-primary mx-2">Typing Test</a>
            <a href="<?php echo esc_url(home_url('/demo')); ?>" class="btn btn-outline-primary mx-2">Take Demo</a>
        </nav>
        <div class="d-flex">
            <a href="<?php echo esc_url(home_url('/login')); ?>" class="btn btn-primary mx-2">
                Hey! Log in
            </a>
            <a href="<?php echo esc_url(home_url('/register')); ?>" class="btn btn-secondary mx-2">
                Register
            </a>
        </div>
    </div>
</header>
<main>
