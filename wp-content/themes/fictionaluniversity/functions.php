<?php 

require get_theme_file_path('/includes/like-route.php');

require get_theme_file_path('/includes/search-route.php');


add_filter('use_block_editor_for_post','__return_false');


function pageBanner($args=NULL){
    //php logic will live here

    if(!$args['title']){

        $args['title']= get_the_title();

    }
    
    if(!$args['subtitle']){

        $args['subtitle']=get_field("page_banner_subtitle");

    }
    if(!$args['image']){

        if(get_field('page_banner_image')){
        $args['image']=get_field('page_banner_image')['sizes']['pageBanner'];
    }else{
        $args['image']=get_theme_file_uri('/images/bus.jpg');
    }
    }



?>
    <div class="page-banner">
    <div class="page-banner__bg-image" 
    style="background-image: url(<?php echo $args['image']; ?>);"></div>
    <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title"><?php echo $args['title']; ?> </h1>
    <div class="page-banner__intro">
    <p><?php echo $args['subtitle']; ?></p>
    </div>
    </div>  
    </div>
    
    </div>

<?php
}




function university_files(){

    
    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyBK8-6Wnwbj7GeDUQ6fQ5MIJatrfWC8i7U', NULL, '1.0', true);
    wp_enqueue_script("university_main_js",get_theme_file_uri("/js/scripts-bundled.js"),
    NULL,microtime(),true);
    wp_enqueue_style("custom-googlefonts", "//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i");
    wp_enqueue_style("font-awesome", "//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
    wp_enqueue_style("fictional_university",get_stylesheet_uri(),NULL,microtime());
    wp_localize_script( "university_main_js", "universityData", array(

        'root_url' => get_site_url(),
        'nonce'=> wp_create_nonce('wp_rest')

    ) );
}


add_action('wp_enqueue_scripts','university_files');


function university_features(){

    // register_nav_menu('HeaderMenuLocation','Header Menu');
    // register_nav_menu('footerMenuLocation1','Footer Menu 1');
    // register_nav_menu('footerMenuLocation2','Footer Menu 2');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorlandscape',400,260,true);
    add_image_size('professorportrait',480,650,true);
    add_image_size('pageBanner',1500,350,true);

}


add_action('after_setup_theme','university_features');


function university_custom_query($query){

    if(!is_admin() && is_post_type_archive('event') && $query->is_main_query()){

        $query->set('meta_key','event_date');
        $query->set('orderby','meta_value_num');
        $query->set('order','ASC');
        $query->set('meta_query',array(
            array(
                'key'=>'event_date',            
                'compare'=>'>=',
                'value'=>date('Ymd'),
                'type'=>'numeric'
        ))
    );

    }

    if(!is_admin() && is_post_type_archive('program') && $query->is_main_query()){

        $query->set('posts_per_page',-1);
        $query->set('orderby','title');
        $query->set('order','DESC');
        

    }

    if(!is_admin() && is_post_type_archive('campus') && $query->is_main_query()){

        $query->set('posts_per_page',-1);
    

    }


}

add_action('pre_get_posts','university_custom_query');


function universityMapKey($api){

    $api['key']="AIzaSyBK8-6Wnwbj7GeDUQ6fQ5MIJatrfWC8i7U";
    
    return $api;

}


add_filter('acf/fields/google_map/api','universityMapKey');


function universityCustomRest(){


    register_rest_field('post','authorName',array(
        'get_callback'=>function(){return get_the_author();}
    ));


}



add_action('rest_api_init','universityCustomRest');


//redirect subscriber account on to the home page

function redirectSubToFront(){

    $checkuserRole = wp_get_current_user();

    if(count($checkuserRole -> roles)==1 && $checkuserRole -> roles[0]=='subscriber'){

        wp_redirect(site_url('/'));
        exit;

    }


}

add_action("admin_init",'redirectSubToFront');


//show no admin bar to subscriber

function noAdminBar(){

    $checkuserRole = wp_get_current_user();

    if(count($checkuserRole -> roles)==1 && $checkuserRole -> roles[0]=='subscriber'){

        show_admin_bar(false);
        
    }

}

add_action("wp_loaded",'noAdminBar');


//customize login screen

add_filter('login_headerurl','ourHeaderUrl');

function ourHeaderUrl(){

    return esc_url(site_url('/'));

}

add_action('login_enqueue_scripts','ourLoginCss');

function ourLoginCss(){

    wp_enqueue_style("fictional_university",get_stylesheet_uri(),NULL,microtime());
    wp_enqueue_style("custom-googlefonts", 
    "//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i");

}

add_filter('login_headertitle','ourLoginTitle');

function ourLoginTitle(){

    return get_bloginfo('name');

}


//force wp to make notes private

add_filter('wp_insert_post_data','makeNotePrivate',10,2);

function makeNotePrivate($data,$postarr){

    if($data['post_type']=='note'){

        if(count_user_posts(get_current_user_id(),'note') > 4 && !$postarr['ID'] ){
            die("<h2>you have reached your post limit</h2>");
        }

        $data['post_content']=sanitize_textarea_field($data['post_content']);
        $data['post_title']=sanitize_text_field($data['post_title']);
    }

    if($data['post_type']=='note' && $data['post_status'] !== 'trash'){
        $data['post_status']='private';
    }

    return $data;

}


?>