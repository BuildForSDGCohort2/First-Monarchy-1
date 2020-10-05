//Menu Control
var MenuOpener = document.querySelector(".menuClosed");
var MenuCloser = document.querySelector(".menuOpen");
var Menu = document.querySelector(".item7");
function ShowMenu(menu){
 menu . style . display = 'flex';
 menu . style . opacity = 1;
 MenuCloser . style . display = 'flex';
}
function HideMenu(menu){
 menu . style . display = 'none';
 menu . style . opacity = 0;
 MenuCloser . style . display = 'none';
}

MenuOpener . addEventListener('click' , function(){ShowMenu(Menu) } );
MenuCloser . addEventListener('click' , function(){HideMenu(Menu) } );



//swiper Slideshows
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 5,
      spaceBetween: 4,
      slidesPerGroup: 5,
			keyboard: {
        enabled: true,
      },
		 scrollbar: {
        el: '.swiper-scrollbar',
        hide: true,
      },
      loop: true,
      loopFillGroupWithBlank: false,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        320: {
          slidesPerView: 1.5,
          slidesPerGroup:1.5,
        },
        600:{
          slidesPerView: 2.5,
          slidesPerGroup:2.5,
        },
        991:{
          slidesPerView: 3.5,
          slidesPerGroup:3.5,
        },
        1200:{
          slidesPerView: 5,
          slidesPerGroup: 5,
        }
      }
    });

// //Star Ratings Controls
// //getting all stars
//     var stars = document.querySelectorAll('.ratingcheckbox');
//
// //Adding event listeners to each star
//     for (var i = 0; i < stars.length; i++) {
//
//       stars[i].addEventListener('change',function (e) {
//
//         var starLabel = e.currentTarget.parentNode;
//
//         //checking all stars appearing before the clicked one
//         if (e.currentTarget.checked) {
//               var markedPrevStar;
//               while (starLabel.previousElementSibling) {
//                 function markPrevStars() {
//                 markedPrevStar = starLabel.previousElementSibling;
//                 markedPrevStar.children[0].checked = true;
//                 starLabel = markedPrevStar;
//                 return starLabel;
//                }
//                markPrevStars();
//             }
//         }
//           if (!e.currentTarget.checked) {
//             e.currentTarget.checked = true;
//             while (starLabel.nextElementSibling) {
//             function unmarkNextStars() {
//               unmarkedPrevStar = starLabel.nextElementSibling;
//               unmarkedPrevStar.children[0].checked = false;
//               starLabel = unmarkedPrevStar;
//               return starLabel;
//             }
//               unmarkNextStars();
//             }
//           }
//       });
//     }




function clickable(clickable) {
  var arrayOfClickables = document.querySelectorAll(clickable);

  for (var i = 0; i < arrayOfClickables.length; i++) {
    arrayOfClickables[i].addEventListener('click',function (e) {
      e.currentTarget.querySelector('.hiddenLink').click();
    });
  }
}

clickable('.category');
clickable('.popular');
clickable('.recommended');
