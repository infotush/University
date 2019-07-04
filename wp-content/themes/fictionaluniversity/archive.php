<?php get_header(); 

pageBanner(array(
  'title'=>get_the_archive_title(),
  'subtitle'=>get_the_archive_description()
));

?>


<!-- <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri("images/ocean.jpg"); ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">
      <?php if(is_category()){
         echo "All the posts under"; single_cat_title();
      }elseif(is_author()){
          echo "All Posts by"; the_author();
    }
     elseif(is_month()){
    echo "All Posts on" ." ".  get_the_date('M');
       }
      elseif(is_day()){
        echo "All Posts on" ." ".  get_the_date('d');
      }
      elseif(is_year()){
        echo "All Posts on" ." ".  get_the_date('Y');
           }
     
    
      ?> 
      
      <?php //the_archive_title(); ?>
      </h1>

      
      <div class="page-banner__intro">
        <p><?php //the_archive_description(); ?></p>
      </div>
    </div>  
  </div> -->

  <div class="container container--narrow page-section">
  
  <?php 
  
  while(have_posts()){
    the_post();

  ?>

    <div class="post-item">
    
    <h2 class="headline headline--medium headline--post-title ">
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    
    <div class="metabox">
    Posted by <?php the_author_posts_link();  ?> on <?php the_time('n.j.y'); ?> in 
    <?php echo get_the_category_list(', '); ?>
    </div>
    
    <div class="generic-content">
    <?php the_excerpt(); ?>
    <a href="<?php the_permalink(); ?>" class="btn btn--blue">Continue reading &raquo;</a>
    </div>
    
    </div>
  
  <?php 
  

  }

  echo paginate_links();
  
  ?>


  </div>



<?php get_footer(); ?>
