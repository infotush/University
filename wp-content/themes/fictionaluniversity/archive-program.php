<?php get_header(); 

pageBanner(array(
  'title'=>"All Programs",
  'subtitle'=>"Please take a tour of all our programs"
));

?>




  <div class="container container--narrow page-section">
  
  <ul class="link-list min-list">
  <?php 
  
  while(have_posts()){
    the_post();

  ?>

    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        
        
    
  <?php 

  }?>

  </ul>
  
  <?php 
  echo paginate_links();
  
  ?>


</div>



<?php get_footer(); ?>
