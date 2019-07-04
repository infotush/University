<?php 


function universityRegisterRoute(){
    
    
    register_rest_route('university/v1','search',array(
        
        'methods'=> WP_REST_SERVER::READABLE,
        'callback'=> 'universityApiResults',
        
    ));
    
    
}



function universityApiResults($data){
    
    $mainQuery= new WP_Query(array(
        'post_type'=>array('post','page','professor','event','campus','program'),
        's'=>sanitize_text_field($data['term'])
    ));
    
    $results= array(
        'generalInfo'=>array(),
        'professors'=>array(),
        'campuses'=>array(),
        'events'=>array(),
        'programs'=>array()
    );
    
    while($mainQuery->have_posts()){
        $mainQuery->the_post();
        
        if(get_post_type()=='post' || get_post_type()=='page'){

            $description= null;
            
            if(has_excerpt()){
                $description = get_the_excerpt();
            }else{
                $description = wp_trim_words(get_the_content(),10);
            } 
            
            array_push($results['generalInfo'],array(
                'title'=> get_the_title(),
                'permalink'=> get_the_permalink(),
                'post_type'=> get_post_type(),
                'author_name'=>get_author_name(),
                'description'=>$description
            ));
            
            
        }
        
        if(get_post_type() =='professor')
        {
            
            
            
            array_push($results['professors'],array(
                'title'=> get_the_title(),
                'permalink'=> get_the_permalink(),
                'image'=>get_the_post_thumbnail_url(0,'professorlandscape'),
                
            ));
            
            
        }
        
        if(get_post_type()=='campus')
        {
            
            array_push($results['campuses'],array(
                'title'=> get_the_title(),
                'permalink'=> get_the_permalink(),
                
            ));
            
            
        }
        
        if(get_post_type()=='program')
        {

            $relatedCampuses= get_field('related_campus');

            if($relatedCampuses){
    
                foreach($relatedCampuses as $campus){
    
                    array_push($results['campuses'],array(
                        'title'=> get_the_title($campus),
                        'permalink'=> get_the_permalink($campus),
                        
                    ));
                    
                }
    
            }
            
            array_push($results['programs'],array(
                'title'=> get_the_title(),
                'permalink'=> get_the_permalink(),
                'id'=>get_the_id()
            ));
            
            
        }
        
        if(get_post_type()=='event')
        {
            
            $description= null;
            
            if(has_excerpt()){
                $description = get_the_excerpt();
            }else{
                $description = wp_trim_words(get_the_content(),10);
            } 
            
            $eventdate= new DateTime(get_field('event_date'));
            
            array_push($results['events'],array(
                'title'=> get_the_title(),
                'permalink'=> get_the_permalink(),
                'month'=>$eventdate->format('M'),
                'date'=>$eventdate->format('d'),
                'description' => $description
            ));
            
            
        }
        
        
    }
    
    if($results['programs']){
        
        $programMetaQuery = array('relation'=> 'OR');
        
        foreach($results['programs'] as $item){
            
            array_push($programMetaQuery, array(
                'key'=>'related_program',
                'compare'=>'LIKE',
                'value'=> '"'. $item['id']. '"'
                
            ));
            
        }
        
       
      
        
        $programRelationshipQuery= new WP_QUERY(array(
            
            'post_type'=>array('professor','event'),
            'meta_query'=> $programMetaQuery
            
        ));
        
        while($programRelationshipQuery->have_posts()){
            
            $programRelationshipQuery->the_post();
            
            if(get_post_type() =='professor')
            {
                
                array_push($results['professors'],array(
                    'title'=> get_the_title(),
                    'permalink'=> get_the_permalink(),
                    'image'=>get_the_post_thumbnail_url(0,'professorlandscape'),
                    
                ));
                
            }

            if(get_post_type()=='event')
        {
            
            $description= null;
            
            if(has_excerpt()){
                $description = get_the_excerpt();
            }else{
                $description = wp_trim_words(get_the_content(),10);
            } 
            
            $eventdate= new DateTime(get_field('event_date'));
            
            array_push($results['events'],array(
                'title'=> get_the_title(),
                'permalink'=> get_the_permalink(),
                'month'=>$eventdate->format('M'),
                'date'=>$eventdate->format('d'),
                'description' => $description
            ));
            
            
        }
            
        }
        
        $results['professors']= array_values(array_unique($results['professors'],SORT_REGULAR));
        $results['events']= array_values(array_unique($results['events'],SORT_REGULAR));

        
    }
    

    return $results;
    
}


add_action("rest_api_init","universityRegisterRoute");


?>