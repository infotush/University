<?php 
function university_post_type(){

//event post type

register_post_type("event",array(
    'show_in_rest'=>true,
    'supports'=>array('title','editor','excerpt'),
    'capability_type'=>'event',
    'map_meta_cap'=> true,
    'rewrite'=> array(
        'slug'=>'events'
    ),
    'has_archive'=> true,
    'public'=> true,
    'labels'=>array(
        'name'=> 'Events',
        'add_new_item'=>'add_new_Event',
        'edit_item'=>'edit_event',
        'all_items'=>'All_Events'
    ),

    'menu_icon'=> 'dashicons-welcome-write-blog'

)

);

//program post type


register_post_type("program",array(
    'show_in_rest'=>true,
    'supports'=>array('title'),
    'rewrite'=> array(
        'slug'=>'programs'
    ),
    'has_archive'=> true,
    'public'=> true,
    'labels'=>array(
        'name'=> 'Programs',
        'add_new_item'=>'add_new_Program',
        'edit_item'=>'edit_Program',
        'all_items'=>'All_Programs'
    ),

    'menu_icon'=> 'dashicons-awards'

)

);

//professor post types

register_post_type("professor",array(
    
    'show_in_rest'=>true,
    'supports'=>array('title','editor','thumbnail'), 
    'public'=> true,
    'labels'=>array(
        'name'=> 'Professors',
        'add_new_item'=>'add_new_professor',
        'edit_item'=>'edit_professor',
        'all_items'=>'All_professor'
    ),

    'menu_icon'=> 'dashicons-businessperson'

)

);

// Note Post Type
register_post_type('note', array(
    'show_in_rest' => true,
    'capability_type'=>'note',
    'map_meta_cap'=>true,
    'supports' => array('title','editor'),
    'public' => false,
    'show_ui' => true,
    'labels' => array(
      'name' => 'Notes',
      'add_new_item' => 'Add New Note',
      'edit_item' => 'Edit Note',
      'all_items' => 'All Notes',
      'singular_name' => 'Note'
    ),
    'menu_icon' => 'dashicons-welcome-write-blog'
  )

);




//register campus 

register_post_type("campus",array(
    'show_in_rest'=>true,
    'supports'=>array('title','editor','excerpt'),
    'rewrite'=> array(
        'slug'=>'campuses'
    ),
    'has_archive'=> true,
    'public'=> true,
    'labels'=>array(
        'name'=> 'Campuses',
        'add_new_item'=>'add_new_campus',
        'edit_item'=>'edit_campus',
        'all_items'=>'All_Campuses'
    ),

    'menu_icon'=> 'dashicons-location-alt'

)

);


//like post type 


register_post_type('like', array(
    
    'supports' => array('title'),
    'public' => false,
    'show_ui' => true,
    'labels' => array(
      'name' => 'Likes',
      'add_new_item' => 'Add New Like',
      'edit_item' => 'Edit Like',
      'all_items' => 'All Likes',
      'singular_name' => 'Like'
    ),
    'menu_icon' => 'dashicons-heart'
  )

);


//dynamic slider 


register_post_type('homepageslider', array(
    
    'supports' => array('title'),
    'public' => false,
    'show_ui' => true,
    'labels' => array(
        'name' => 'Home Page Sliders',
        'add_new_item' => 'Add New Home Page Slider',
        'edit_item' => 'Edit Home Page Slider',
        'all_items' => 'All Home Page Sliders',
        'singular_name' => 'Home Page Slider'
      ),
    'menu_icon' => 'dashicons-format-image'
  )

);



}


add_action('init','university_post_type');

?>