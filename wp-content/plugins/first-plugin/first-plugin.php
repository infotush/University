<?php 

/***

plugin name: My first plugin
description: this plugin will change your life

 * * */

add_filter('the_content','addingCustomParagram');

function addingCustomParagram($content){

$content=$content."<p>All posts belong to Fictional University</p><br>
<p>Currently we have [programCount] Programs</p>";

return $content;

}

add_shortcode('programCount','programCountFunction');

function programCountFunction(){
    ob_start();
    $programCount= new WP_QUERY(array(
        'post_type'=>'program'
    ));

    while($programCount->have_posts()){
        $programCount->the_post();

       
           return $programCount->found_posts;
     
        
    }

    return $programCount=ob_get_clean();

}


?>