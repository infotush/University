import $ from 'jquery';

class MyNotes{

    constructor(){
        // this.deleteButton = $('.delete-note');
        // this.editButton= $('.edit-note');
        // this.updateButton=$('.update-note');
        this.createButton=$('.submit-note');
        this.events();
    }

    //events
    events(){

        $('#my-notes').on('click','.delete-note',this.onDelete.bind(this));
        $('#my-notes').on('click','.edit-note',this.onEdit.bind(this));
        $('#my-notes').on('click','.update-note',this.onUpdate.bind(this));
        this.createButton.on('click',this.createNote.bind(this));

    }



    //custom methods

    onDelete(e){

      var thisNote= $(e.target).parent("li");

        $.ajax({
            
            beforeSend: (xhr) => {
              xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/' +  thisNote.data('id'),
            method: 'DELETE',
            success: (response) => {

              thisNote.slideUp();
              console.log("Congrats");
              console.log(response);
            },
            error: (response) => {
              console.log("Sorry");
              console.log(response);
            }
          });       

    }



    onUpdate(e){

      var thisNote= $(e.target).parent("li");

      var updatedPost={
        'title': thisNote.find('.note-title-field').val(),
        'content':thisNote.find('.note-body-field').val()
      };

        $.ajax({
            
            beforeSend: (xhr) => {
              xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/' +  thisNote.data('id'),
            method: 'POST',
            data: updatedPost,
            success: (response) => {

              this.makeNoteReadOnly(thisNote);
              console.log("Congrats");
              console.log(response);
            },
            error: (response) => {
              console.log("Sorry");
              console.log(response);
            }
          });       

    }


    createNote(e){


      var ourNewNote={
        'title': $('.new-note-title').val(),
        'content':$('.new-note-body').val(),
        'status':'private'
      };

        $.ajax({
            
            beforeSend: (xhr) => {
              xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/',
            method: 'POST',
            data: ourNewNote,
            success: (response) => {

              $('.new-note-title, .new-note-body').val('');
              $(`
              
              <li data-id="${response.id}">
        <input readonly value="${response.title.raw}" class="note-title-field" />
        <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</span>
        <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</span>
        <textarea readonly class="note-body-field" name="" id="" cols="30" rows="10">
        ${response.content.raw}
        </textarea>
        <span class="update-note btn btn--blue btn--small">
          <i class="fa fa-arrow-right" aria-hidden="true"></i>Save</span>

        
        </li>
              
              `).prependTo('#my-notes').hide().slideDown();             
              console.log("Congrats");
              console.log(response);
            },
            error: (response) => {
              if(response.responseText == "you have reached your post limit"){
                $('.note-limit-message').addClass('active');
              }
              console.log("Sorry");
              console.log(response);
            }
          });       

    }




    onEdit(e){

      var thisNote= $(e.target).parent("li");

    if(thisNote.data('state')=='editable'){

      this.makeNoteReadOnly(thisNote);

    }
    else
    {
      this.makeNoteEditable(thisNote);

    }


    }


    makeNoteEditable(thisNote){

      thisNote.find('.edit-note').html("<i class='fa fa-times' aria-hidden='true'></i> Cancel");
      thisNote.find('.note-title-field, .note-body-field').removeAttr('readonly').addClass('note-active-field');
      thisNote.find('.update-note').addClass('update-note--visible');
      thisNote.data('state','editable');

    }

    makeNoteReadOnly(thisNote){

      thisNote.find('.edit-note').html("<i class='fa fa-pencil' aria-hidden='true'></i> Edit");
      thisNote.find('.note-title-field, .note-body-field').attr('readonly','readonly')
      .removeClass('note-active-field');
      thisNote.find('.update-note').removeClass('update-note--visible');
      thisNote.data('state','cancel');

    }


}


export default MyNotes;