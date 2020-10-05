Notiflix.Notify.Init({
	useGoogleFont:false,
  fontFamily:'Nunito',
	messageFontSize:'16px',
});
Notiflix.Confirm.Init({
	useGoogleFont:false,
  fontFamily:'Nunito',
	borderRadius:'1rem',
	okButtonBackground:'#152151',
	messageFontSize:'16px',
});
Notiflix.Loading.Init({
	useGoogleFont:false,
  fontFamily:'Nunito',
});

//  MAIN TAB LAYOUT
var overlay = document.querySelector('.overlay');

function openTab(button) {
	let tabID = button.dataset.tab;

	//Hides all the tabs
	document.querySelectorAll('.tabcontent').forEach(function (tab) {
		   tab.style.display = 'none';
	});
	let tabButtons = document.querySelectorAll('.tabButton');

	// Sets the background color of all the buttons
	tabButtons.forEach(function (tabButton) {
	   tabButton.classList.remove('activeTab');
		 tabButton.querySelector('.tab_icon').src = tabButton.querySelector('.tab_icon').src.replace('dark','grey');
	});

	//Makes corresponding tab visible when its button is clicked
	document . getElementById(tabID) . style . display = 'flex';
	button.classList.add('activeTab');
	button.querySelector('.tab_icon').src = button.querySelector('.tab_icon').src.replace('grey','dark');
}



//Menu Control
var MenuOpener = document.querySelector(".menuClosed");
var MenuCloser = document.querySelector(".menuOpen");
var Menu = document.querySelector(".navigation");
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


//Avatar Change control
// Image selection In Edit Form
function chooseImage(button) {
	let input = document.querySelector(`input[data-button = "${button.dataset.input}"]`);
	console.log(input);
	input.click();
}
var details = document.querySelectorAll('.favourite_group');
function expand(summary) {
	let content = summary.dataset.content;
	if (summary.classList.contains('expand')) {
		details.forEach(function (detail) {
			if (detail.dataset.summary == content) {
				detail.style.display = 'flex';
			}
		});
		summary.querySelector('span:nth-of-type(2)').innerHTML = '&#45;';
		summary.classList.remove('expand');
		summary.classList.add('collapse');
	}
	else {
		details.forEach(function (detail) {
			if (detail.dataset.summary == content) {
				detail.style.display = 'none';
			}
		});
		summary.querySelector('span:nth-of-type(2)').innerHTML = '&#43;';
		summary.classList.remove('collapse');
		summary.classList.add('expand');
	}
}

//Image Submission to server for validation and storage
function submitImage(input) {
	let errorList = input.dataset.errors;
		removeValidationErrors(document.querySelector(`.${errorList}`));
		let formDataObject = new FormData();
		formDataObject.append(input.name,input.files[0]);
		formDataObject.append('_method','PATCH');
		let url = input.dataset.url;
		let displayedImages = document.querySelectorAll(`img[data-reference = "${input.dataset.image}"]`);
		let config = {
			baseURL:'http://127.0.0.1:8000/',
		}
		Notiflix.Loading.Pulse('Changing Image...');
		axios.post(url,formDataObject)
    .then(function (response) {
			displayedImages.forEach(function (displayedImage) {
				displayedImage.src = window.URL.createObjectURL(input.files[0]);
				displayedImage.onload = function () {
					window.URL.revokeObjectURL(this.src);
				}
			});
			Notiflix.Loading.Remove();
    	console.log(response);
			Notiflix.Notify.Success('Image Changed');
    })
		.catch(function (error) {
			if (error.response) {
				let avatarErrors = error.response.data.errors.avatar;
				if (avatarErrors) {
				  showValidationErrors(avatarErrors,document.querySelector(`.${errorList}`),input);
					console.log(avatarErrors);
				}
			}
			Notiflix.Loading.Remove();
			console.log(error);
			Notiflix.Report.Failure(
				'Image was not Changed',
				'something went wrong',
				'close'
			);
		});
}
function showValidationErrors(errors,errorList,invalidInput) {
	let fragment = document.createDocumentFragment();
		errors.forEach(function(error){
			let list = document.createElement('li');
			list.textContent = error;
			list.className = 'validationerror';
			fragment.appendChild(list);
		});
		errorList.appendChild(fragment);
		invalidInput.style.borderWidth = '2px';
		invalidInput.style.borderColor = 'red';
}

function removeValidationErrors(errorList) {
		while(errorList.firstChild != null) {
		errorList.removeChild(errorList.childNodes[0]);
		}
}
function clickable(clickable) {
  clickable.querySelector('.hiddenLink').click();
}

function updateWishlist(checkbox) {
      let url = checkbox.dataset.url;
			let parent = checkbox.closest('.listingContainer');
      let heart = checkbox;
      let config = {
          baseURL:'http://127.0.0.1:8000/',
        };
      if (checkbox.checked) {
				console.log(checkbox.checked);
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
				console.log(checkbox.checked);
          axios.delete(url)
          .then(function (response) {
            console.log(response);
            heart.checked = false;
						if (!checkbox.closest('#bookingsTab')) {
							parent.remove();
						}
            Notiflix.Notify.Success('Removed From Favourites');
          })
          .catch(function (error) {
            console.log(error);
            Notiflix.Notify.Failure('Something went wrong');
          });
      }
}
function cancel_booking(button) {
		let url = button.dataset.url;
		let parent = button.closest('.listingContainer');
		let config = {
			baseURL:'http://127.0.0.1:8000/',
		}
		Notiflix.Confirm.Show(
			'Confirm Booking Cancellation',
			'Are you sure you want to cancel this booking ?',
			"Yes, I'm sure",
			"No,i'm not sure",
			function () {
				Notiflix.Loading.Pulse('Cancelling Booking...');
				axios.delete(url)
				.then(function (response) {
					Notiflix.Loading.Remove();
					parent.remove();
					Notiflix.Report.Success(
						'Booking Successfully Cancelled',
						'We would love to help you find a home or workspace again.',
						'close'
					);
				})
				.catch(function (error) {
					Notiflix.Loading.Remove();
					Notiflix.Report.Failure(
						'Something went wrong',
						'We were unable to cancel your booking',
						'close'
					);
				})
			},
			function () {

			}
		);
}
function attach_listeners() {
	document.querySelector('.item2').addEventListener('click',function (e) {
		if (e.target.closest('.tabButton')) {
			openTab(e.target.closest('.tabButton'));
		}
	});
	document.querySelectorAll('.tabcontent').forEach(function (tab) {
		tab.addEventListener('change',function (e) {
			if (e.target.closest('.imageInput')) {
				submitImage(e.target.closest('.imageInput'));
			}
		});
		tab.addEventListener('click',function (e) {
			if (e.target.closest('.changeImage')) {
				chooseImage(e.target.closest('.changeImage'));
			}
			if (e.target.closest('.checkbox')) {
				e.stopPropagation();
				updateWishlist(e.target.closest('.checkbox'));
			}
			if (e.target.closest('.summary')) {
				expand(e.target.closest('.summary'));
			}
			if (e.target.closest('.cancel_booking')) {
				e.stopPropagation();
				cancel_booking(e.target.closest('.cancel_booking'));
			}
			if (e.target.closest('.listing')) {
				clickable(e.target.closest('.listing'));
			}
		});
	});
}
attach_listeners();
document.getElementById('bookingsTabButton').click();
