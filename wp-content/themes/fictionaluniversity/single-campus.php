<?php get_header(); ?>
      
      <?php 
      
      while(have_posts()){
        the_post();
        pageBanner();
        ?>
        
       
        <div class="container container--narrow page-section">
        
        <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>">
        <i class="fa fa-home" aria-hidden="true"></i> 
        All Campuses</a>
        <?php the_title(); ?>
        </div>
        
        <div class="generic-content">
        <p><?php the_content(); ?></p>

        <?php 
      }
         ?>


 <!--Map container starts  -->
 <div class="acf-map">
  
<?php
    $mapLocation= get_field('map_location');
  ?>

  <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" 
  data-lng="<?php echo $mapLocation['lng']; ?>">
  
  <h3>
  <?php 
  echo the_title();
  ?>
  
  </h3>
  
  <?php echo $mapLocation['address']; ?>
  </div>


  </div>

<!-- Map container ends -->

     
        <hr class="section-break">
        
        
        
        <?php 
        
        $relatedPrograms= new WP_QUERY(array(
          'posts_per_page'=>-1,
          'post_type'=>'program',
          'orderby'=>'title',
          'order'=>'ASC',
          'meta_query'=>array(
            
            array(
              'key'=>'related_campus',
              'compare'=>'LIKE',
              'value'=> '"'. get_the_ID(). '"'
              
              )
              )
              
            ));
            
            ?>
            
                   
            
            <h4>Programs Available at this campus</h4>
            <?php 
            if($relatedPrograms->have_posts()){
              
              ?>
              <ul class='link-list min-list'>
              <?php 

              echo "<ul class='professor-cards'>";
              while($relatedPrograms->have_posts()){
                $relatedPrograms->the_post();
                ?>
                
                <li class="link-list min-list">
                <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
                </a>
                </li>
                
                
                <?php   } 
                echo "</ul>";
                ?>
                
                <?php 
              }else{
                
                echo "<p>No Programs are available at this campus</p>";
                
                
              } ?>
              
              
            
              <?php wp_reset_postdata(); ?>
              
              <hr class="section-break">
              <?php 
              
              $campusEvents= new WP_QUERY(array(
                
                'posts_per_page'=> -1,
                'post_type'=>'event',
                'meta_key'=>'event_date',
                'orderby'=>'meta_value_num',
                'order'=>'ASC',
                'meta_query'=>array(
                  array(
                    'key'=>'event_date',
                    'compare'=>'>=',
                    'value'=>date('Ymd'),
                    'type'=>'numeric'
                  ),
                  array(
                    'key'=>'related_campus',
                    'compare'=>'LIKE',
                    'value'=> '"'. get_the_ID(). '"'
                    
                    )
                    )
                    
                  ));


                  ?>
                  <h4>Upcoming Events</h4>
                
                  <?php 
                  while($campusEvents->have_posts()){
                    $campusEvents->the_post();

                    ?>
                    
                                     
                    <?php
                    
                    get_template_part('/template-parts/content-event');
                  }
                    
                    ?>
                    </div>
                    
                   
                    </div>
                    

                    
                 
                    <?php get_footer(); ?>
                    