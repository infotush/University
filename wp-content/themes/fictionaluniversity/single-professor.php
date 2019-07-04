<?php get_header(); ?>
	
	<?php 
	
	while(have_posts()){
    the_post();

    pageBanner();

		?>
		
		

		<div class="container container--narrow page-section">

		
    
		<div class="generic-content">
       
        <div class="row-group">

        <div class="one-third">
        <?php the_post_thumbnail('professorportrait'); ?>
        </div>

        
        <div class="two-thirds">
        <?php 
        
        $likeCounts= new WP_QUERY(array(

          'post_type'=>'like',
          'meta_query'=>array(
            array(
              'key'=>'liked_professor_id',
              'compare'=>'=',
              'value'=>get_the_ID()
            )
          )

        ));

        $existStatus="no";

        if(is_user_logged_in()){

          $existQuery= new WP_QUERY(array(

            'author'=>get_current_user_id(),
            'post_type'=>'like',
            'meta_query'=>array(
              array(
                'key'=>'liked_professor_id',
                'compare'=>'=',
                'value'=>get_the_ID()
              )
            )
  
          ));
  
          if($existQuery->found_posts){
            $existStatus="yes";
          }

        }

        
        ?>
        <span class="like-box" data-like="<?php echo $existQuery->posts[0]->ID; ?>" data-professor="<?php the_ID(); ?>" 
        data-exists="<?php echo $existStatus; ?>">
        <i class="fa fa-heart-o" aria-hidden="true"></i>
        <i class="fa fa-heart" aria-hidden="true"></i>
        <span class="like-count"><?php
        
        echo $likeCounts->found_posts;

        ?>
        </span>
        </span>
        <p><?php the_content(); ?></p>
        <hr class="section-break">

        </div>
 
        </div>


      

		<?php
		
		$relatedProgram= get_field("related_program");

        echo "<h4>Related Program(s)</h4>";
		if($relatedProgram){

             
            echo '<ul class="link-list min-list">';
            
		      foreach($relatedProgram as $program){
			
        ?>
                
				<li><a href="<?php echo get_the_permalink($program); ?>">
				<?php echo get_the_title($program); ?></a></li>
				
				

        <?php }
            

            echo "</ul>"; 
	    }

		?> 



        <?php 
          
          $homePageEvents= new WP_QUERY(array(

            'posts_per_page'=> 2,
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

		  while($homePageEvents->have_posts()){
            $homePageEvents->the_post();
          ?>

          <div class="event-summary">
          <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
            <span class="event-summary__month"><?php 
            
            $field = get_field('event_date');

            $eventDate = new DateTime($field);

            echo $eventDate->format('M');
            
            
            ?></span>
            <span class="event-summary__day"><?php echo $eventDate->format('d'); ?></span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <p><?php if(has_excerpt()){
              echo get_the_excerpt();
            }else{
              echo wp_trim_words(get_the_content(),18);
            } ?> 
            <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
          </div>
        </div>

        <?php   }
          
          ?>

</div>

</div>
	<?php }

	?>

  

	<?php get_footer(); ?>
