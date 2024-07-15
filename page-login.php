<?php get_header();
/*Template Name: Login*/
?>
<section class="login">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="form">
                    <?php echo wc_get_template('woocommerce/myaccount/form-login.php'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>