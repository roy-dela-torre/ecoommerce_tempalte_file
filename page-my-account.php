<?php get_header();
/*Template Name: My Account*/
$imgPath = get_stylesheet_directory_uri().'/assets/img/homepage/'; ?>
<?php if(is_user_logged_in()):?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/my_account.css">
<section class="my_account">
  <div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="content">
            <div class="content-container">     
              <?php echo do_shortcode('[woocommerce_my_account]'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php else: ?>
  <?php echo do_shortcode('[woocommerce_my_account]'); ?>
<?php endif;?>
<?php get_footer(); ?>
<script>
  $(document).ready(function(){
    $('button.clear_message').click(function(event){
          console.log('hahahah')
          event.preventDefault()
          $('form.om-messenger-sending-form textarea').val('').change()
      })
  })
</script>