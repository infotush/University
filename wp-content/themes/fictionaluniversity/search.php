<?php get_header(); 

pageBanner(array(
  'title'=>"Search Results",
  'subtitle'=>'You Gave Searched for &ldquo;'. esc_html(get_search_query(false)) .'&rdquo;'
));

?>



  <div class="container container--narrow page-section">
  
  <?php 

  if(have_posts()){
  
  while(have_posts()){
    the_post();

   get_template_part('/template-parts/content', get_post_type());

   ?> 
  
<?php
  }
}else{
    ?>
    <p>No Information is Available</p>

<?php }
  echo paginate_links();
  
  ?>

<?php get_search_form(); ?>


  </div>



<?php get_footer(); ?>
