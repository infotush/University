      <?php get_header(); ?>
      
      <?php 
      
      while(have_posts()){
        the_post();
        pageBanner();
        ?>
        
        
        
        <div class="container container--narrow page-section">
        
        <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>">
        <i class="fa fa-home" aria-hidden="true"></i> 
        All Programs</a>
        <?php the_title(); ?>
        </div>
        
        <div class="generic-content">
        <p><?php the_field('main_body_content'); ?></p>
        
        <hr class="section-break">
        
        
        
        <?php 
        
        $relatedProfessor= new WP_QUERY(array(
          'posts_per_page'=>-1,
          'post_type'=>'professor',
          'orderby'=>'title',
          'order'=>'ASC',
          'meta_query'=>array(
            
            array(
              'key'=>'related_program',
              'compare'=>'LIKE',
              'value'=> '"'. get_the_ID(). '"'
              
              )
              )
              
            ));
            
            ?>
            
            
            
            
            <h4><?php echo get_the_title(); ?> Professors</h4>
            <?php 
            if($relatedProfessor->have_posts()){
              
              ?>
              <ul class='link-list min-list'>
              <?php 
              
              echo "<ul class='professor-cards'>";
              while($relatedProfessor->have_posts()){
                $relatedProfessor->the_post();
                ?>
                
                <li class="professor-card__list-item">
                <a href="<?php the_permalink(); ?>" class="professor-card">
                <img src="<?php the_post_thumbnail_url('professorlandscape'); ?>" alt="profssor">
                <span class="professor-card__name"><?php the_title(); ?></span>
                </a>
                </li>
                
                
                <?php   } 
                echo "</ul>";
                ?>
                
                <?php 
              }else{
                
                echo "<p>No Professors are assigned yet</p>";
                
                
              } ?>
              
              
              
              <?php wp_reset_postdata(); ?>
              
              <hr class="section-break">
              <?php 
              
              $homePageEvents= new WP_QUERY(array(
                
                'posts_per_page'=> 3,
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
                    'key'=>'related_program',
                    'compare'=>'LIKE',
                    'value'=> '"'. get_the_ID(). '"'
                    
                    )
                    )
                    
                  ));
                  
                  if($homePageEvents->have_posts()){
                    $homePageEvents->the_post();
                    ?>
                    
                    <h4><?php echo "Upcoming"." ". ucwords(get_post_type()).'s' ; ?> </h4>
                               
                    <?php
                    
                    get_template_part('/template-parts/content-event');
                  }else{
                    echo "<h4>No Events Right Now</h4>";
                  }
                  
                  ?>
                  
                 <?php wp_reset_postdata(); 
                 
                 $relatedCampus= get_field('related_campus');

                 if($relatedCampus){

                  echo "<hr class='section-break'>";

                  echo "<h4>This Program is available at below Campus(es)</h4>";


                  foreach($relatedCampus as $campus){

                    ?>

                    <ul class="link-list min-list">
                    <li>
                    <a href="<?php the_permalink($campus); ?>"><?php echo get_the_title($campus); ?></a>
                    </li>
                    
                    </ul>
                    
                    <?php 
                  }                 
                  
             }
                 
                 
                 ?>

                
                  
                  </div>           
                  
                 
                  </div>
                  <?php }
                  
                  ?>
                  
                  
                  
                  
                  
                  
                  <?php get_footer(); ?>
                  