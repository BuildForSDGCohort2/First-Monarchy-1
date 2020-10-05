//Menu Control
var MenuOpener = document.querySelector(".menuClosed");
var MenuCloser = document.querySelector(".menuOpen");
var Menu = document.querySelector(".item4");
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
