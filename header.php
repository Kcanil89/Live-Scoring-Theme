<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
    <div class="container">
        <!-- Logo -->
        <div class="site-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <?php
                if (function_exists('the_custom_logo')) {
                    the_custom_logo();
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/assets/img/logo.png" alt="' . get_bloginfo('name') . '">';
                }
                ?>
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">Menu</button>

            <?php
            if (has_nav_menu('main-menu')) {
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'menu_class' => 'menu',
                    'walker' => new Walker_Nav_Menu(),
                ));
            }
            ?>

            <!-- Search Button -->
<button class="search-toggle" aria-expanded="false" title="Search">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" viewBox="0 0 24 24">
        <path d="M10.5 2C5.8 2 2 5.8 2 10.5S5.8 19 10.5 19c2.5 0 4.7-1 6.4-2.6l4.5 4.5c.2.2.5.2.7 0s.2-.5 0-.7l-4.5-4.5C18.5 14.2 19 11.9 19 10.5 19 5.8 15.2 2 10.5 2zM10.5 17c-3.6 0-6.5-2.9-6.5-6.5S6.9 4 10.5 4 17 6.9 17 10.5 14.1 17 10.5 17z"/>
    </svg>
</button>

<!-- Search Form -->
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search" class="search-field" placeholder="Search…" value="<?php echo get_search_query(); ?>" name="s">
    <button type="submit" class="search-submit">Search</button>
</form>
        </nav>
    </div>
</header>
