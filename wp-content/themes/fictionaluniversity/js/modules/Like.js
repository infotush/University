import $ from 'jquery';


class Like{


    constructor(){
        this.events();
    }

    events(){

        $('.like-box').on('click',this.ourClickDispatcher.bind(this));

    }


    //methods
    ourClickDispatcher(e){

        var currentLike = $(e.target).closest(".like-box");

        if(currentLike.attr('data-exists')=='yes')
        {
            this.deleteLike(currentLike);
        }
        else
        {
            this.createLike(currentLike);
        }

    }

    createLike(currentLike){

        $.ajax({

            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
              },

            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            data:{'professorId': currentLike.data('professor')},
            method: 'POST',
            success: (response)=>{
                currentLike.attr('data-exists','yes');
                var likeCount= parseInt(currentLike.find('.like-count').html(),10);
                likeCount++;
                currentLike.find('.like-count').html(likeCount);
                currentLike.attr('data-like',response);
                console.log(response);
            },
            error:(response)=>{
                console.log(response);
            }
    
        }) ;

    
    }

    deleteLike(currentLike){

            $.ajax({

            beforeSend: (xhr) => {
                    xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
                  },

            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            data:{
                'like':currentLike.attr('data-like')
            },
            method: 'DELETE',
            success: (response)=>{
                currentLike.attr('data-exists','no');
                var likeCount= parseInt(currentLike.find('.like-count').html(),10);
                likeCount--;
                currentLike.find('.like-count').html(likeCount);
                currentLike.attr('data-like','');
                console.log(response);
            },
            error:(response)=>{
                console.log(response);
            }
    
        }) ;   
    
    }

}


export default Like;