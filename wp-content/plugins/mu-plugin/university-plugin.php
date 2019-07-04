function university_post_type(){

register_post_type("Events",array(
    'public'=>true,
    'labels'=>array(
        'name'=> 'Events',
        'add_new_item'=>'add_new_Event',
        'edit_item'=>'edit_event',
        'all_items'=>'All_Events'
    ),

    'menu_icon'=> 'dashicons-welcome-write-blog'

));

}


add_action('init','university_post_type');