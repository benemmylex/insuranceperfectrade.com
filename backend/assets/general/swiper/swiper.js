var swiper = new Swiper(".mySwiper", {
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    loop: true,
    on: {
              init: () => {
                  animationInit()
              },
              slideChangeTransitionStart: function () {
                  animationInit()
              }
          }
  });

//   const swiper = new Swiper('.swiper',{
            
//     // If we need pagination
//     pagination: {
//         el: '.swiper-pagination',
//     },
//     loop: true,

//     // Navigation arrows
//     navigation: {
//         nextEl: '.swiper-button-next',
//         prevEl: '.swiper-button-prev',
//     },
//     on: {
//         init: () => {
//             animationInit()
//         },
//         slideChangeTransitionStart: function () {
//             animationInit()
//         }
//     }
// })