<?php get_header(); 

pageBanner(array(
  'title'=>" Past Events",
  'subtitle'=>"A recap of our past Events"
));


?>


  <div class="container container--narrow page-section">
  
  <?php 

  $pastEvent= new WP_QUERY(array(
    'paged'=>get_query_var('paged',1),
    'post_type'=>'event',
    'meta_key'=>'event_date',
    'orderby'=>'meta_value_num',
    'order'=>'DESC',
    'meta_query'=>array(
        array(
          'key'=>'event_date',
          'compare'=>'<',
          'value'=>date('Ymd'),
          'type'=>'numeric'
        )
      )
  ));
  
  while($pastEvent->have_posts()){
    $pastEvent->the_post();


    get_template_part('/template-parts/content-event');



  }

  echo paginate_links(array(
      'total'=> $pastEvent->max_num_pages
  ));
  
  ?>


  </div>



<?php get_footer(); ?>
