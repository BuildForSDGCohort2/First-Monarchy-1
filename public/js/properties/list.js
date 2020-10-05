//Menu Control
var MenuOpener = document.querySelector(".menuClosed");
var MenuCloser = document.querySelector(".menuOpen");
var Menu = document.querySelector(".item5");
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


Notiflix.Notify.Init({
		useGoogleFont:false,
		fontFamily:'Nunito',
});

var overlay = document.querySelector('.overlay');
function clickable(clickable) {
    clickable.querySelector('.hiddenLink').click();
}
function updateWishlist(checkbox) {
  if (checkbox.classList.contains('loggedIn')) {
      let url = checkbox.dataset.url;
      let heart = checkbox;
      let config = {
          baseURL:'http://127.0.0.1:8000/',
        };
      if (checkbox.checked) {
        axios.post(url)
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
          axios.delete(url)
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
  }
  else {
      checkbox.closest('.wishform').submit();
  }
}

function showModal(button) {
    let id = button.dataset.id;
    let modal = document.getElementById(id);
    console.log(modal);
    // modal.style.visibility = 'visible';
    modal.style.height = '100vh';
    document.body.style.overflow = 'hidden';
    overlay.style.display = 'block';
}

function closeModal(button) {
  let id = button.dataset.id;
  let modal = document.getElementById(id);
  console.log(modal);
  modal.style.height = '0vh';
  document.body.style.overflow = 'auto';
  overlay.style.display = 'none';
    // modal.style.visibility = 'hidden';
}

function badge(element) {
  if (!element.children.length) {
    element.style.display = 'none';
  }
}
var badges = document.querySelectorAll('.badge');
badges.forEach(function (element) {
  badge(element);
});

function attach_listeners() {
  document.addEventListener('click',function (e) {
    if (e.target.closest('.checkbox')) {
      e.stopPropagation();
      e.preventDefault();
      updateWishlist(e.target.closest('.checkbox'))
    }
    if (e.target.closest('.listing')) {
      clickable(e.target.closest('.listing'));
    }
    if (e.target.closest('.showModal')) {
      showModal(e.target.closest('.showModal'));
    }
    if (e.target.closest('.closeModal')) {
      closeModal(e.target.closest('.closeModal'));
    }
  });
}
attach_listeners();
