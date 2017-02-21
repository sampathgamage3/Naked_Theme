<?php
 

get_header(); ?>
  
<!-- Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header center">Welcome To Feb Meetup 2017 ! 
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-12">
                <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/home_banner.jpg" alt="">
            </div>

           

        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header">Portfolio</h3>
            </div>

            <?php 
$apiurl = 'http://localhost/meetup/wp-json/wp/v2/portfolio-api';
$response = file_get_contents($apiurl);
$response = json_decode($response); 

if ( !empty($response) ) :

    foreach ($response as $res) :  
    $image_id = $res->featured_media;
    $get_id = $res->id;

    $image_url = file_get_contents('http://localhost/meetup/wp-json/wp/v2/media/'.$image_id);
    $image_url = json_decode($image_url);
    
    $image_url = $image_url->guid->rendered;  

    ?>

        <div class="col-sm-3 col-xs-6">
            <a href="<?php echo get_permalink($get_id); ?>">
                <img src="<?php echo $image_url; ?>" class="img-responsive" alt="">
            </a>
        </div>

     <?php

    endforeach;

endif;

            ?>

        </div>
        <!-- /.row -->

        <hr>
 

<?php get_footer(); ?>
