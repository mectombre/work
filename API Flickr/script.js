
//variable 
let text
let perpage = 20;
let page = 1;


//recupération de la valeur du nombre d'image par page
$('.btperpage').on('change', function() {
    perpage =($('input[name=perpage]:checked').val()); 
    console.log(perpage)
 });

 //input type radia : on (change) (e){perpage =(e.currenttarget).val}

//changement de page
 $("#pageUp").click(function(){
    if ($(".flickrImg").length > 0){
     page ++;
     console.log(page);
     recherche()
    }
 })

 $("#pageDown").click(function(){
    if ($(".flickrImg").length > 0){
     page--;
    console.log(page);
   recherche()
    }
 })
 


// click du boutton de recherche
$("#button").click(function () {

    //recherche  
    recherche()  
})   

let searchbar = document.getElementById("search");
// perte de focus sur la barre de recherche
searchbar.addEventListener("focusout", function(){
recherche()  
});

    




function recherche(){

    //récupération du texte dans la barre de recherche 
    text = $("#search").val();
    console.log(text);

    //si il y a déja des img (donc une autre recherche effectuer), les supprimmes
    if ($(".flickrImg").length > 0){
        $('.flickrImg').remove();
    }
    
        let url = `https://www.flickr.com/services/rest/?method=flickr.photos.search&api_key=22059fe88c4b12ab4ba97d5ff8023857&text=${text}&per_page=${perpage}&page=${page}&format=json&nojsoncallback=1`
        $.get(url, function (data) {
            const photos = data.photos.photo;

            for (let i = 0, p ; i < photos.length ; i++) {
                p = photos[i];

                $("<img>", {
                    //src: "https://live.staticflickr.com/" + imgServer + "/" + imgId + "_" + imgSecret + ".jpg"
                    src: `https://live.staticflickr.com/${p.server}/${p.id}_${p.secret}_z.jpg`,
                    class :  "flickrImg",
                    mouseenter:function(){
                        $(this).css("transform","scale(1.2)");
                        $(this).css("z-index","1");
                    },
                    mouseleave:function(){
                        $(this).css("transform","scale(1)");
                        $(this).css("z-index","0");
                    },
                    click:function(){
                        $(this).css("z-index","1");
                        $(this).css("transform","scale(1.8)");
                        $(this).css("margin","auto");
                        $("body").css("backgroundcolor","rgb(0,0,0,0.5");
                    }
                }).appendTo("body");
            }

        });
    }