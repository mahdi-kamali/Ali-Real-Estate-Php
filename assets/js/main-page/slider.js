

window.onload = () => {


    $('.background-slider').slick({
        dots: false,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed: 4000,
        arrows: true,
        prevArrow:'<i class="fa-solid fa-angle-left"></i>',
        nextArrow:'<i class="fa-solid fa-angle-right"></i>'
    });


    $('.todays-estates-list').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: Math.round(window.innerWidth/400),
        slidesToScroll: Math.round(window.innerWidth/400),
        responsive: [
            {
                breakpoint: 1600,
                settings: {
                  slidesToShow: 4,
                  slidesToScroll: 4,
                  infinite: true,
                  dots: true
                }
              },
          {
            breakpoint: 1400,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 1000,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 700,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
      });
}
