<?php get_header();
/*Template Name: Blogs*/
?>
<section class="blogs">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <div class="header_content">
                        <h1 class="text-white text-lg-center text-uppercase">Blogs</h1>
                        <p class="text-lg-center text-white">Light the fuse on your next celebration! Uncover dazzling ideas, spark creativity, and become a fireworks fiesta master. Let's get explosive!</p>
                    </div>
                </div>
                <div class="main_content">
                    <?php
                        global $paged;
                        $curpage = $paged ? $paged : 1;
                        $args = array(
                            'post_type'        => 'post',
                            'posts_per_page'   => 3,
                            'post_status' 	   => 'publish',
                            'order' => 'ASC',
                            'paged' => $paged,
                        );
                        $large_content = true;
                        $blogs_query = new WP_Query($args);
                        if ($blogs_query->have_posts()):
                            while ($blogs_query->have_posts()) : $blogs_query->the_post();
                                $id = get_the_ID();
                                $date = get_the_date();
                                $title = get_the_title();
                                $description = get_the_excerpt();
                                $link = get_permalink(); 
                                $excluded_posts[] = $id;
                                if($large_content == true):?>
                                    <div class="large_content d-flex flex-column" onclick="window.open('<?php echo $link; ?>', '_blank')">
                                        <div class="blog_image">
                                            <img src="<?php echo get_the_post_thumbnail_url($blog_id); ?>" alt="<?php echo get_the_title(); ?>" class="img-fluid w-100">
                                        </div>
                                        <div class="content">
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
                                <?php else: ?>
                                    <div class="small_content d-flex" onclick="window.open('<?php echo $link; ?>', '_blank')">
                                        <div class="blog_image">
                                            <img src="<?php echo get_the_post_thumbnail_url($blog_id); ?>" alt="<?php echo get_the_title(); ?>" class="img-fluid">
                                        </div>
                                        <div class="content">
                                            <span class="date"><?php echo $date; ?></span>
                                            <h3><?php echo wp_trim_words($title,6);?></h3>
                                            <p><?php echo wp_trim_words($description,14); ?></p>
                                            <a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer" class="read_more">Read More
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M16 12.0169C15.9981 12.2799 15.9426 12.5397 15.8369 12.7805C15.7312 13.0212 15.5776 13.2378 15.3854 13.4169L9.69722 18.7469C9.50277 18.9204 9.24835 19.0109 8.98827 18.999C8.7282 18.9871 8.48306 18.8737 8.30519 18.6832C8.12732 18.4927 8.0308 18.24 8.03624 17.9791C8.04167 17.7182 8.14864 17.4698 8.3343 17.2869L13.9626 12.0169L8.3343 6.7469C8.23488 6.6582 8.15418 6.5504 8.09695 6.43C8.03972 6.3096 8.00711 6.1789 8.00104 6.0456C7.99497 5.9123 8.01557 5.7792 8.06161 5.654C8.10766 5.5289 8.17823 5.4142 8.26917 5.3168C8.36011 5.2194 8.46957 5.1412 8.59112 5.0868C8.71266 5.0324 8.84383 5.003 8.97691 5.0002C9.10998 4.9974 9.24226 5.0214 9.36597 5.0706C9.48968 5.1198 9.6023 5.1934 9.69722 5.2869L15.3844 10.6129C15.5772 10.7924 15.7313 11.0095 15.8372 11.251C15.9431 11.4925 15.9985 11.7531 16 12.0169Z" fill="#FF0000"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif;?>
                            <?php $large_content = false; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>     
                </div>
            </div>
        </div>
    </div>
</section>

<section class="other_blogs bg-white">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <h2 class="text-uppercase">Spark even more ideas!</h2>
                </div>
                <?php
                    global $paged;
                    $curpage = $paged ? $paged : 1;
                    $args = array(
                        'post_type'        => 'post',
                        'posts_per_page'   => 9,
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
            <div class="paging d-flex justify-content-center align-items-center">
                <?php
                $totalPages = $blogs_query->max_num_pages;
                echo paginate_links(array(
                    'total' => $totalPages,
                    'mid_size' => 2
                ));
                ?>
            </div>
        </div>
    </div>
</section>


<?php get_footer();?>
