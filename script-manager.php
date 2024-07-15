<script src="<?php echo get_stylesheet_directory_uri(); ?>/inc/js/jquery.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/inc/js/functions.js"></script>
<?php $js_path = get_stylesheet_directory_uri() . '/inc/js/' ?>

<?php if (is_archive()) : ?>
    <script>

    </script>
<?php elseif (is_shop()) : ?>
    <script>
        
    </script>
<?php endif; ?>