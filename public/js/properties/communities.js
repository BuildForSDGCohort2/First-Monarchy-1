 //Menu Control
 var MenuOpener = document.querySelector(".menuClosed");
 var MenuCloser = document.querySelector(".menuOpen");
 var Menu = document.querySelector(".item4");
 function ShowMenu(menu){
  menu . style . display = 'flex';
  menu . style . opacity = 1;
  MenuCloser . style . display = 'block';
 }
 function HideMenu(menu){
  menu . style . display = 'none';
  menu . style . opacity = 0;
  MenuCloser . style . display = 'none';
 }
 MenuOpener . addEventListener('click' , function(){ShowMenu(Menu) } );
 MenuCloser . addEventListener('click' , function(){HideMenu(Menu) } );

 //Initialize Swiper
 var swiper = new Swiper('.swiper-container', {
   slidesPerView: 1,
   spaceBetween: 30,
   loop: true,
   pagination: {
     el: '.swiper-pagination',
     clickable: true,
   },
   navigation: {
     nextEl: '.swiper-button-next',
     prevEl: '.swiper-button-prev',
   },
 });

//Clickable Units
function clickable(clickable) {
  var arrayOfClickables = document.querySelectorAll(clickable);

  for (var i = 0; i < arrayOfClickables.length; i++) {
    arrayOfClickables[i].addEventListener('click',function (e) {
      e.currentTarget.querySelector('.hiddenLink').click();
      console.log(arrayOfClickables[i]);
    });
  }
}
clickable('.unitContainer');
Notiflix.Notify.Init({
		useGoogleFont:false,
		fontFamily:'Nunito',
});



function updateWishlist(checkbox) {
  if (checkbox.classList.contains('loggedIn')) {
    checkbox.addEventListener('click',function(e){
      e.preventDefault();
      let url = e.currentTarget.parentElement.parentElement.action;
      let heart = e.currentTarget;
      let config = {
          baseURL:'http://127.0.0.1:8000/',
        };
      if (checkbox.checked) {
        axios.post(url,config)
        .then(function (response) {
          console.log(response);
          heart.checked = true;
          Notiflix.Notify.Success('Added To favourites');
        })
        .catch(function (error) {
          console.log(error);
          Notiflix.Notify.Failure('Something went wrong');
        })
      }
      else {
          axios.delete(url,config)
          .then(function (response) {
            console.log(response);
            heart.checked = false;
            Notiflix.Notify.Success('Removed From Favourites');
          })
          .catch(function (error) {
            console.log(error);
            Notiflix.Notify.Failure('Something went wrong');
          });
      }
    });
  }
  else {
    checkbox.addEventListener('click',function (e) {
      e.preventDefault();
      e.currentTarget.parentElement.parentElement.submit();
    });
  }
}
var checkboxes = document.querySelectorAll('.checkbox');

checkboxes.forEach(function (checkbox) {
  updateWishlist(checkbox);
});


document.querySelector('.backlink').addEventListener('click',function (e) {
  e.currentTarget.href = window.history.back();
});
