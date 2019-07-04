<?php get_header(); 

pageBanner(array(
  'title'=>"Our Campuses",
  'subtitle'=>"Please take a tour to all of our campuses"
));

?>


  <div class="container container--narrow page-section">
  

  <!--Map container starts  -->
<div class="acf-map">
  <?php 
  
  while(have_posts()){
    the_post();

    $mapLocation= get_field('map_location');
  ?>

  <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" 
  data-lng="<?php echo $mapLocation['lng']; ?>">
  <a href="<?php echo the_permalink(); ?>">
  <h3>
  <?php 
  echo the_title();
  ?>
  
  </h3>
  </a>
  <?php echo $mapLocation['address']; ?>
  </div>

 <?php  } ?>

  </div>

<!-- Map container ends -->

  </div>

  
  

 <?php get_footer(); ?>
