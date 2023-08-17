$(function(){
    $(".gallery_slider").slick({
        infinite: false,
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: $(".gallery .arrow.prev"),
        nextArrow: $(".gallery .arrow.next"),
        responsive: [
            {
            breakpoint: 700,
            settings: {
                arrows:false,
                infinite: true
            }
        }]
    });

    $(".countsSlides span.max").html($(".gallery_slider").slick("getSlick").slideCount);

    $(".gallery_slider").on("afterChange", function(event, slick, currentSlide, nextSlide){
        $(".countsSlides span.current").text(currentSlide + 1);
    });
})