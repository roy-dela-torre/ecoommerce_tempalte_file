<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <title><?php wp_title(); ?></title>
    <?php include('stylesheet-manager.php') ?>
    <?php wp_head(); ?>
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-xxl p-0">
            <div class="container-fluid">
                <a class="navbar-brand d-block d-xxl-none" href="<?php echo $home; ?>">
                    <img src="<?php echo $img; ?>/logo.png" alt="Ocfireworks">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',   // This should match the location registered in functions.php
                        'menu_class'     => 'navMenu navbar-nav me-auto mb-2 mb-lg-0',
                        'container'      => false,
                    ));
                    ?>
                    <form role="search" method="get" class="mb-0" role="search" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="search_field d-flex align-items-center">
                            <input type="search" placeholder="Search..." class="w-100" value="<?php echo get_search_query(); ?>" name="s" id="s">
                            <?php
                            // echo file_get_contents($img . '/search.svg');
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>