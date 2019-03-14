/**
 * File: scripts.js
 * 
 * Conatains miscelainous scripts used by this theme
 * 
 */

(function($) {
    let counter = 0;



    function sliderController(sliderid) {
        let img =  $("#" + sliderid + " img");
        let numElements = img.length;
        if ($("#" + sliderid + " img.current").length == 0) {
            img.eq(0).addClass("current");
            img.eq(-1).addClass("previous");
            img.eq(1).addClass("next");
        }

        counter = (counter + 1) % numElements; // This line uses the modulos operator to cycle through the images by creating a loop. 
        img.eq(counter).removeClass("next").addClass("current");
        img.eq(counter - 1).removeClass("current").addClass("previous");
        img.eq(counter - 2).removeClass("previous");
        img.eq((counter + 1) % numElements).addClass("next");
    }

    $(document).ready(function () {
        let sliderid = "familyplanner-slider";
        sliderController(sliderid);
        setInterval(() => { sliderController(sliderid); }, 3000);
    });
})( jQuery );