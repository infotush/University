<?php get_header(); ?>

<?php

while(have_posts()){
    the_post();

    pageBanner();
  
    
    ?>


  <div class="container container--narrow page-section">

  <div class="create-note">

  <h2 class="headline headline--medium">Create New Note</h2>
  <input type="text" name="" id="" Placeholder ='title' class="new-note-title">
  <textarea name="" id="" cols="30" rows="10" Placeholder='your note here..' 
  class="new-note-body">

  </textarea>

  <span class="submit-note">Create Note</span>
  <span class="note-limit-message"> Notice: you have reached your note limit, please
    delete an existing note to add a new one </span>
  </div>

  <ul class='link-list min-list' id="my-notes">
  <?php 
    
    $userNotes= new WP_QUERY(array(
        'post_type' => 'note',
        'post_per_page'=> -1,
        'author' => get_current_user_id()
    ));


    while($userNotes->have_posts()){
        $userNotes->the_post();
        ?>

        <li data-id="<?php the_Id(); ?>">
        <input readonly value="<?php echo str_replace('Private: ','', esc_attr(get_the_title())); ?>" class="note-title-field" />
        <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</span>
        <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</span>
        <textarea readonly class="note-body-field" name="" id="" cols="30" rows="10">
        <?php echo esc_textarea(get_the_content()); ?>
        </textarea>
        <span class="update-note btn btn--blue btn--small">
          <i class="fa fa-arrow-right" aria-hidden="true"></i>Save</span>


        
        </li>


        <?php

    }  

?>
  
  </ul>
    
  </div>


<?php }



?>


<?php get_footer(); ?>
