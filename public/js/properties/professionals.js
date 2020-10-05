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
    var swiper2 = new Swiper('.most-popular', {
      slidesPerView: 4,
      spaceBetween: 4,
      slidesPerGroup: 4,
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
    });
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
