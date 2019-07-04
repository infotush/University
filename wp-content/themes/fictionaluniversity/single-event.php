<?php get_header(); ?>
	
	<?php 
	
	while(have_posts()){
		the_post();
		
		pageBanner();
		
		?>
		
		

		<div class="container container--narrow page-section">

		<div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>">
			<i class="fa fa-home" aria-hidden="true"></i> 
			Events Home</a>
      <?php the_title(); ?>
    </div>
    
		<div class="generic-content">
    <p><?php the_content(); ?></p>
    
		
		<hr>

		<?php
		
		$relatedProgram= get_field("related_program");


		if($relatedProgram){

			echo "<h4>Related Program(s)</h4>";
		
		foreach($relatedProgram as $program){
			
			?>
				<ul class="link-list min-list">
				
				<li><a href="<?php echo get_the_permalink($program); ?>">
				<?php echo get_the_title($program); ?></a></li>
				
				</ul>

		<?php }
		
	}

		?>

<?php wp_reset_postdata(); 
                 
                 $relatedCampus= get_field('related_campus');

                 if($relatedCampus){

                  echo "<hr class='section-break'>";

                  echo "<h4>Venue of the Event</h4>";


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

		<?php 

?>

</div>
	<?php }

	?>






	<?php get_footer(); ?>
