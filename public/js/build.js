//SHOWING /HIDING THE CARDS

//Variable definition
var HomeButton = document.getElementById("HomeCardOpener");
var CommercialButton = document.getElementById("CommercialCardOpener");
var HomeCard = document.getElementById("HomeCard");
var CommercialCard = document.getElementById("CommercialCard");
var cards = document.querySelectorAll(".card");
var cardholder = document.querySelector(".item7");
var closelinks = document.querySelectorAll(".closelink");

//showing/hiding cards
function ShowCard(card){
	cardholder . style . display = 'none';
	//initializing display of all cards to "none"
	for(var i = 0; i < cards.length; i++){
	 cards[i] . style . display = 'none';
	}
     card . style . display = 'flex';
		 cardholder . style . display = 'flex';
}
function hideCard(){
	for(var i = 0; i < cards.length; i++){
	 cards[i] . style . display = 'none';
	}
	cardholder . style . display = 'none';
}
for (var i = 0; i < closelinks.length; i++) {
	closelinks[i] . addEventListener('click',function(){hideCard()});
}
HomeButton . addEventListener('click' , function(){ ShowCard(HomeCard) } );
CommercialButton . addEventListener('click' , function(){ ShowCard(CommercialCard) } );

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
