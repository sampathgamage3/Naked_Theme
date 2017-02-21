<?php get_header(); ?>

<?php 

$post_id = get_the_ID();

/* Page Content */

$image = wp_get_attachment_url(get_post_thumbnail_id($post_id));

$title = get_post_field('post_title',$post_id);

$content = get_post_field('post_content',$post_id);
 

/* Meta Value */

$meta = get_post_meta( $post_id, 'your_fields', true ); 

$contact_no = (isset($meta['contact_no'])?$meta['contact_no']:'');

$show_public = (isset($meta['show_public'])?$meta['show_public']:'');

$full_name = (isset($meta['full_name'])?$meta['full_name']:'');

$contact = "Private";
if ( $show_public === 'yes' ) {
	$contact = $contact_no ;
}
?>
<!-- Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $title; ?> 
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
                <img class="img-responsive" src="<?php echo $image; ?>" alt="">
            </div>

            <div class="col-md-4">
                
                <?php echo $content; ?>

                <h3>Project ID : <?php echo do_shortcode('[getPostID]'); ?></h3>

                <h3>Contact Details</h3>

                <ul>
                    <li>Full Name : <?php echo $full_name; ?></li> 
                    <li>Phone Number : <?php echo $contact; ?></li> 
                </ul>

            </div>

        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header">Related Projects</h3>
            </div>

            <?php 

                   
                $args = array(
                  "post_type" => "portfolio", 
                  "posts_per_page" => 4, 
                );
              ?>
        
            <?php $the_query = new WP_Query( $args );    ?>

            <?php

             if ( $the_query->have_posts() ) :

                    while ($the_query->have_posts() ) :  
                    
                    $the_query->the_post();  
                    $get_id = get_the_ID(); 
                    $image = wp_get_attachment_url(get_post_thumbnail_id($get_id));

                    ?>

                        <div class="col-sm-3 col-xs-6">
                            <a href="<?php echo get_permalink($get_id); ?>">
                                <img src="<?php echo $image; ?>" class="img-responsive" alt="">
                            </a>
                        </div>

                     <?php

                    endwhile;

            endif;

            ?>

        </div>
        <!-- /.row -->

        <hr>

<?php get_footer(); ?>