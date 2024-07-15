<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/blog-single.css">
<?php get_header();
$imgPath = get_stylesheet_directory_uri().'/assets/img/homepage/';
$homeUrl = get_home_url();
$theTitle = "";
while (have_posts()) : the_post();
  $blog_id = get_the_ID();
  $blog_title = get_the_title();
  $blog_link = get_permalink();
  $blog_content = get_the_content();
  $blog_date = get_the_date();
  $singlePosts[] = $post->ID;
?>

<section class="blog-single">   
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="main_content">
                    <div class="header">
                        <h1><?php echo $blog_title;?></h1>
                    </div>
                    <div class="featureImage">
                        <?php echo get_the_post_thumbnail(); ?>
                        </div>
                    <div id="content-left" class="single-content">
                        <?php echo the_content(); ?>
                    </div>
                    <div class="share">
                        <span class="share">Share it on:</span>
                        <div class="soc-med-icons">
                            <a href="https://www.facebook.com/sharer.php?u=<?php echo get_home_url().get_post_field('post_name', get_the_ID()); ?>" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                <g clip-path="url(#clip0_1873_54989)">
                                    <path d="M0 0.25V25.25H25V0.25H0ZM20.1562 13.375H16.875V22.125H13.5938V13.375H11.25V10.25H13.5938V7.59375C13.5938 5.25 15 3.375 18.125 3.375C19.375 3.375 20.3125 3.53125 20.3125 3.53125V6.5H18.2812C17.1875 6.5 17.0312 6.96875 17.0312 7.90625V10.25H20.3125L20.1562 13.375Z" fill="#212121"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1873_54989">
                                    <rect width="25" height="25" fill="white" transform="translate(0 0.25)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            </a>
                            
                            <a href="https://twitter.com/share?url=<?php echo get_home_url().get_post_field('post_name', get_the_ID()); ?>" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                <g clip-path="url(#clip0_1873_54992)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M25 0H0V25H25V0ZM14.5698 10.9264L22 22H16.1285L11.3063 14.8128L5.23877 22H3L10.3161 13.3377L10.317 13.3386L3.38016 3H9.25165L13.5856 9.46L19.0431 3H21.2819L14.5825 10.9368L14.5698 10.9264ZM18.7897 20.2727L8.3646 4.72727H6.58206L17.0156 20.2727H18.7897Z" fill="#212121"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1873_54992">
                                    <rect width="25" height="25" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            </a>

                            <a href="https://www.linkedIn.com/share?url=<?php echo get_home_url().get_post_field('post_name', get_the_ID()); ?>" target="_blank" rel="noopener noreferrer">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_860_5973)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.5389 11.2279V11.1914C13.5315 11.2037 13.5211 11.2159 13.5146 11.2279H13.5389Z" fill="#212121"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0V25H25V0H0ZM7.77593 20.7693H4.06681V9.61022H7.77593V20.7693ZM5.92137 8.08714H5.89687C4.65264 8.08714 3.84615 7.22995 3.84615 6.15852C3.84615 5.06357 4.67621 4.23066 5.94566 4.23066C7.21538 4.23066 7.99566 5.06357 8.01995 6.15852C8.01995 7.22995 7.21538 8.08714 5.92137 8.08714ZM21.1538 20.7693H17.4437V14.7992C17.4437 13.2997 16.9077 12.2761 15.5649 12.2761C14.5394 12.2761 13.93 12.9653 13.6615 13.6329C13.564 13.8713 13.5385 14.2028 13.5385 14.5372V20.7694H9.82764C9.82764 20.7694 9.87736 10.6571 9.82764 9.61027H13.5385V11.1915C14.0315 10.4329 14.9113 9.3483 16.8822 9.3483C19.3238 9.3483 21.1538 10.9428 21.1538 14.3702V20.7693Z" fill="#212121"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_860_5973">
                                        <rect width="25" height="25" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>

                            <a href="https://www.external-link.com/sharer.php?u=<?php echo get_home_url().get_post_field('post_name', get_the_ID()); ?>" target="_blank" rel="noopener noreferrer">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_860_5974)">
                                        <path d="M23.2839 1.71622C20.9956 -0.572064 17.2857 -0.572064 14.9974 1.71617L10.1003 6.61334C7.73333 8.98038 7.95247 12.7519 10.1003 14.8998C10.4599 15.2594 10.8579 15.5527 11.2781 15.7936L12.1719 14.8998C12.7581 14.3134 12.5518 13.628 12.5412 13.1335C12.4126 13.0422 12.2874 12.9437 12.1719 12.8281C11.0697 11.726 11.0201 9.83668 12.1719 8.68492C12.343 8.51387 16.9652 3.89166 17.069 3.78785C18.2115 2.64532 20.0697 2.64532 21.2122 3.78785C22.3547 4.93038 22.3547 6.78853 21.2122 7.93106L17.9752 11.168C18.0688 11.6859 18.6306 12.9128 18.3416 14.9366C18.3557 14.9228 18.3726 14.9138 18.3867 14.8998L23.2839 10.0026C25.5721 7.71436 25.5721 4.0045 23.2839 1.71622Z" fill="#212121"/>
                                        <path d="M15.2792 9.72095C14.9196 9.36128 14.5216 9.06802 14.1014 8.82715L13.2076 9.72095C12.6213 10.3072 12.8277 10.9926 12.8382 11.4872C12.967 11.5784 13.0921 11.677 13.2076 11.7925C14.3098 12.8947 14.3594 14.7839 13.2076 15.9357C13.0362 16.1071 8.03113 21.1122 7.93098 21.2124C6.78845 22.3549 4.9303 22.3549 3.78777 21.2124C2.64524 20.0698 2.64524 18.2117 3.78777 17.0691L7.40432 13.4526C7.31072 12.9347 6.7489 11.7078 7.03792 9.68398C7.0238 9.69785 7.00681 9.70688 6.99275 9.7209L1.71614 14.9976C-0.572046 17.2859 -0.572046 20.9958 1.71614 23.284C4.00442 25.5722 7.71423 25.5722 10.0025 23.284L15.2792 18.0074C17.6022 15.6843 17.4753 11.917 15.2792 9.72095Z" fill="#212121"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_860_5974">
                                        <rect width="25" height="25" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="more_blogs pt-0">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <h2 class="text-uppercase text-center">Lorem ipsum dolor sit amet </h2>
                </div>
                <?php
                $args = array(
                    'post_type'        => 'post',
                    'posts_per_page'   => 3,
                    'post_status' 	   => 'publish',
                    'order' => 'ASC',
                    'paged' => $paged,
                );
                $blogs_query = new WP_Query($args);
                if ($blogs_query->have_posts()):
                    while ($blogs_query->have_posts()) : $blogs_query->the_post();
                        $id = get_the_ID();
                        $date = get_the_date();
                        $title = get_the_title();
                        $description = get_the_excerpt();
                        $link = get_permalink(); ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="content">
                                <div class="blog_image">
                                    <img src="<?php echo get_the_post_thumbnail_url($blog_id); ?>" alt="<?php echo get_the_title(); ?>" class="img-fluid w-100">
                                </div>
                                <div class="main_content">
                                    <span class="date"><?php echo $date; ?></span>
                                    <h3><?php echo wp_trim_words($title,7);?></h3>
                                    <p><?php echo wp_trim_words($description,14); ?></p>
                                    <a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer" class="read_more">Read More
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M16 12.0169C15.9981 12.2799 15.9426 12.5397 15.8369 12.7805C15.7312 13.0212 15.5776 13.2378 15.3854 13.4169L9.69722 18.7469C9.50277 18.9204 9.24835 19.0109 8.98827 18.999C8.7282 18.9871 8.48306 18.8737 8.30519 18.6832C8.12732 18.4927 8.0308 18.24 8.03624 17.9791C8.04167 17.7182 8.14864 17.4698 8.3343 17.2869L13.9626 12.0169L8.3343 6.7469C8.23488 6.6582 8.15418 6.5504 8.09695 6.43C8.03972 6.3096 8.00711 6.1789 8.00104 6.0456C7.99497 5.9123 8.01557 5.7792 8.06161 5.654C8.10766 5.5289 8.17823 5.4142 8.26917 5.3168C8.36011 5.2194 8.46957 5.1412 8.59112 5.0868C8.71266 5.0324 8.84383 5.003 8.97691 5.0002C9.10998 4.9974 9.24226 5.0214 9.36597 5.0706C9.48968 5.1198 9.6023 5.1934 9.69722 5.2869L15.3844 10.6129C15.5772 10.7924 15.7313 11.0095 15.8372 11.251C15.9431 11.4925 15.9985 11.7531 16 12.0169Z" fill="#FF0000"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php endwhile; ?>
            <?php endif; ?>    
        </div>
    </div>
</section>




<?php
    endwhile;
?>

<?php
get_footer();?>