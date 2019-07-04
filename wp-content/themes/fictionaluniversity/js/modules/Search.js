import $ from 'jquery';

class Search{
    
    // 1 descibe our object
    constructor(){
        this.addOverlayHtml();
        this.searchResult=$('#search-overlay__results');
        this.searchField=$('#search-term')
        this.openButton=$('.js-search-trigger');
        this.closeButton= $('.search-overlay__close');
        this.searchOverlay=$('.search-overlay');
        this.events();
        this.isOverlayOpen=false;
        this.timer;
        this.isSpinningWheelRunning=false;
        this.previousValue;
    }
    
    //2 listing events
    
    events(){
        
        this.openButton.on('click',this.openOverlay.bind(this));
        this.closeButton.on('click',this.closeOverlay.bind(this));
        $(document).on('keydown',this.keyPress.bind(this));
        this.searchField.on('keyup',this.typeLogic.bind(this));
    }
    
    //3 methods will live here
    
    typeLogic(){
        
        if(this.searchField.val() !== this.previousValue){
            clearTimeout(this.timer);

            if(this.searchField.val())
            {
                if(!this.isSpinningWheelRunning)
                {
            
                    this.searchResult.html("<div class='spinner-loader'></div>");
                    this.isSpinningWheelRunning=true;
                   
                }

                this.timer=setTimeout(this.getResults.bind(this),500);
            }
            else
            {

                this.searchResult.html("");
                this.isSpinningWheelRunning=false;

            }
    
        }

        this.previousValue=this.searchField.val();
        
    }


    getResults(){

        $.getJSON(universityData.root_url + "/wp-json/university/v1/search?term=" + this.searchField.val(),results=>{

            this.searchResult.html(`
            
            <div class="row">
            <div class="one-third">
            <h2 class="search-overlay__section-title">General Information</h2>
            ${results.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No General Information Matches the term</p>' }

             ${results.generalInfo.map ( x=>`<li><a href="${x.permalink}">${x.title}
            </a>${x.post_type=="post"? `by ${x.author_name}`: ''} </li>
            `).join(" ")}
                    
             ${results.generalInfo.length ? '</ul>' : '' }
            </div>
            <div class="one-third">
            <h2 class="search-overlay__section-title">Programs</h2>

            ${results.programs.length ? '<ul class="link-list min-list">' : `<p>No program Matches the term 
            <a href='${universityData.root_url}/programs'>View All programs</a></p>` }

            ${results.programs.map ( x=>`<li><a href="${x.permalink}">${x.title}
           </a> </li>`).join(" ")}
                   
            ${results.programs.length ? '</ul>' : '' }

            <h2 class="search-overlay__section-title">Professors</h2>

            ${results.professors.length ? '<ul class="professor-cards">' : `<p>No Professors Matches the term</p>` }

            ${results.professors.map ( x=>`
            
            <li class="professor-card__list-item">
                <a href="${x.permalink}" class="professor-card">
                <img src="${x.image}" alt="professor">
                <span class="professor-card__name">${x.title}</span>
                </a>
            </li>
            
            `).join(" ")}
                   
            ${results.professors.length ? '</ul>' : '' }


            </div>
            <div class="one-third">

            <h2 class="search-overlay__section-title"> Campuses </h2>

            ${results.campuses.length ? '<ul class="link-list min-list">' : `<p>No Campus Matches the term 
            <a href='${universityData.root_url}/campuses'>View All Campus</a></p>` }

            ${results.campuses.map ( x=>`<li><a href="${x.permalink}">${x.title}
           </a> </li>`).join(" ")}
                   
            ${results.campuses.length ? '</ul>' : '' }

            <h2 class="search-overlay__section-title">Events</h2>

            ${results.events.length ? '' : `<p>No Events Matches the term 
            <a href='${universityData.root_url}/events'>View All Events</a></p>` }

            ${results.events.map ( x=>`
            
            <div class="event-summary">
          <a class="event-summary__date t-center" 
          href="${x.permalink}">
            <span class="event-summary__month">${x.month}</span>
            <span class="event-summary__day">${x.date}</span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny">
            <a href="${x.permalink}">${x.title}</a></h5>
            <p>${x.description}<a href="${x.permalink}" class="nu gray">..Read more</a></p>
          </div>
        </div>

            `).join(" ")}
                   

            </div>
            </div>
            
            `);

            this.isSpinningWheelRunning= false;

        });
        

        /*** Below code is to achieve chaining of API call using  Jquery when and then***/

        // $.when(

        // $.getJSON(universityData.root_url + "/wp-json/wp/v2/posts/?search=" + this.searchField.val()),
        // $.getJSON(universityData.root_url + "/wp-json/wp/v2/pages/?search=" + this.searchField.val())
        // ).then((posts,pages)=>{

        //     var combinedResult = posts[0].concat(pages[0]);

        //     this.searchResult.html(`

        //     <h2 class='search-overlay__section-title'>General Information</h2>
           
        //     ${combinedResult.length ? '<ul class="link-list min-list">' : '<p>No General Information Matches the term</p>' }

        //     ${combinedResult.map ( x=>`<li><a href="${x.link}">${x.title.rendered}
        //     </a>${x.type=="post"? `by ${x.authorName}`: ''} </li>`).join(" ")}
                
        //     ${combinedResult.length ? '</ul>' : '' }

        //     `);

        //     this.isSpinningWheelRunning= false;


        // },()=>{
        //     this.searchResult.html("<p>Currently down please try again after sometime</p>");
        // });
            

    }
    
    

    keyPress(e){
 
        
        if(e.which==83 &&  !this.isOverlayOpen && !$('input,textarea').is(':focus')){
            this.openOverlay();
        }
        
        if(e.which==27 &&  this.isOverlayOpen){
            this.closeOverlay();
        }
        
    }
    
    
    
    openOverlay(){
        
        this.searchOverlay.addClass('search-overlay--active');
        $('body').addClass('body-no-scroll');
        this.isOverlayOpen=true;
        this.searchField.val("");
        setTimeout(()=>this.searchField.focus(),300);
        return false;
    }
    
    
    closeOverlay(){
        
        this.searchOverlay.removeClass('search-overlay--active');
        $('body').removeClass('body-no-scroll');
        this.isOverlayOpen=false;
           
    }
    
    addOverlayHtml(){

        $("body").append(`
        
        <div class="search-overlay">
  
  <div class="search-overlay__top">
  <div class="container">
  <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
  <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>

  <input type="text" class="search-term" 
  placeholder="what are you looking for?" id="search-term">

  </div>

  </div>

  <div class="container">
    <div id="search-overlay__results"></div>
  </div>

  </div>

        
        `);

    }
  
    
}


export default Search;