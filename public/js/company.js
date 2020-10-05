Notiflix.Notify.Init({
	useGoogleFont:false,
	fontFamily:'Nunito',
});
Notiflix.Confirm.Init({
	borderRadius:'5px',
	titleColor:'#000',
	okButtonBackground:'#750000',
	cancelButtonBackground:'#5c5c5c',
	useGoogleFont:false,
});
Notiflix.Loading.Init({
	useGoogleFont:false,
	fontFamily:'Nunito',
});

var overlay = document.querySelector('.overlay');
//  MAIN TAB LAYOUT
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
		 // tabButton.querySelector('.tab_icon').src = tabButton.querySelector('.tab_icon').src.replace('blue','dark');
	});

	//Makes corresponding tab visible when its button is clicked
	document . getElementById(tabID) . style . display = 'flex';
	button.classList.add('activeTab');
	// button.querySelector('.tab_icon').src = button.querySelector('.tab_icon').src.replace('dark','blue');
}
function chooseImage(button) {
	let input = document.querySelector(`input[data-button = "${button.dataset.input}"]`);
	console.log(input);
	input.click();
}
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
				// let coverPhotoErrors = error.response.data.errors.propertyCoverPhoto;
				// let propertyPhotoErrors = error.response.data.errors.propertyPhoto;
				let logoErrors = error.response.data.errors.logo;
				// if (coverPhotoErrors) {
				//   showValidationErrors(coverPhotoErrors,document.querySelector(`.${errorList}`),input);
				// 	console.log(coverPhotoErrors);
				// }
				// if (propertyPhotoErrors) {
				// 	showValidationErrors(propertyPhotoErrors,document.querySelector(`.${errorList}`),input);
				// 	console.log(propertyPhotoErrors);
				// }
				if (logoErrors) {
				  showValidationErrors(logoErrors,document.querySelector(`.${errorList}`),input);
					console.log(logoErrors);
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
function showModal(button) {
 let id = button.dataset.id;
 overlay.style.display = 'block';
 document.getElementById(id).style.display = 'flex';
 // document.body.style.overflow = 'hidden';
}
//Hiding the property addition,editing
function closeModal(button) {
 console.log(button);
 let id = button.dataset.id;
 console.log(id);
 document.getElementById(id).style.display = 'none';
 overlay.style.display = 'none';
 document.body.style.overflow = 'auto';
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



Dropzone.autoDiscover = false;
var token = document.querySelector('input[name="_token"]').value;

//Post Creation
var postDropzone;
function attachPostDropzone() {
	let form = document.getElementById('createPostForm');
	let errorList = document.querySelector('.errorList');
	 postDropzone = new Dropzone("#postDropzone",{
		url:"/posts",
		headers:{'X-CSRF-TOKEN' : token},
		paramName:'postImage',
		addRemoveLinks:true,
		acceptedFiles:'image/jpeg,image/png',
		autoProcessQueue:false,
		dictFileTooBig:'This Image is larger than 10mb',
		dictInvalidFileType:'Image should be of png,jpg or jpeg type',
		dictResponseError:'Invalid data was submitted',
		maxFilesize:10,
		dictDefaultMessage:'<img src="/images/download.svg"><br>Click or drag to add an image',
		 });
		postDropzone.on('success',function (file,response) {
			document.querySelector('.closePostCreateForm').click();
			Notiflix.Notify.Success('Post Created sucessfully');
	   });
		postDropzone.on('error',function(file,errorMessage,xhr) {
			console.log(errorMessage);
			if (xhr){
				let tagErrors = JSON.parse(xhr.responseText).errors.tags;
				let imageErrors = JSON.parse(xhr.responseText).errors.postImage;

				if (tagErrors) {
					showValidationErrors(tagErrors,errorList,form.querySelector('.tags'));
				}
				if (imageErrors) {
					showValidationErrors(imageErrors,errorList,form.querySelector('.dropzone'));
				}
			}
			this.removeFile(file);
			Notiflix.Report.Failure(
				'Post not created',
				errorMessage,
				'close'
			);
		});

	postDropzone.on('sending',function(data,xhr,formData) {
		form.querySelectorAll('input').forEach(function (field) {
			if (field.checked) {
			formData.append(field.name,field.value);
			}
		});
	});
	return postDropzone;
}
attachPostDropzone();

function deletePost(button) {
    let url  = button.dataset.url;
		let post = button.closest('.post');
		Notiflix.Confirm.Show(
			'Confirm Post Deletion',
			"Are you sure you want to delete this post ?<br>This action is permanent",
			'Delete',
			'Cancel',
			function () {
				Notiflix.Loading.Pulse('Deleting...');
				axios.delete(url)
			    .then(function (response) {
						Notiflix.Loading.Remove();
			    	console.log(response);
						Notiflix.Notify.Success('Post Deleted');
						post.remove();
			    })
					.catch(function (error) {
						Notiflix.Loading.Remove();
						console.log(error);
						Notiflix.Report.Failure(
							'Post was not deleted',
							'something went wrong',
							'close'
						);
					});
				},
			function () {
			});
}
function editProfile(button) {
	let url  = button.dataset.url;
	let form = button.closest('.profileEditForm');
	let errorList = form.querySelector('.errorList');

		Notiflix.Confirm.Show(
			'Confirm Profile Edit',
			'Are you sure you want to edit your Profile?',
			'Edit',
			'Cancel',
			function () {
				removeValidationErrors(errorList);
				let formDataObject = new FormData(form);
				formDataObject.delete('logo');
				let config = {baseURL:'http://127.0.0.1:8000/'};
//Use post request with a hidden input( name="_method" ,value="PATCH" because laravel seems not to respons correctly to patch and put requests
      Notiflix.Loading.Pulse('Editing...');
				axios.post(url,formDataObject)
			    .then(function (response) {
						Notiflix.Loading.Remove();
						Notiflix.Notify.Success('Edit Successful');
			    })
					.catch(function (error) {
							if (error.response) {
								let nameErrors = error.response.data.errors.name;
								let bioErrors = error.response.data.errors.description;
								let phoneErrors = error.response.data.errors.phone;
								let addressErrors = error.response.data.errors.address;

								if (nameErrors) {
								  showValidationErrors(nameErrors,errorList,form.querySelector('input[name="name"]'));
									console.log(nameErrors);
								}
								if (descriptionErrors) {
									showValidationErrors(bioErrors,errorList,form.querySelector('textarea[name="bio"]'));
									console.log(bioErrors);
								}
								if (phoneErrors) {
								  showValidationErrors(phoneErrors,errorList,form.querySelector('input[name="phone"]'));
									console.log(phoneErrors);
								}
								if (addressErrors) {
								  showValidationErrors(addressErrors,errorList,form.querySelector('input[name="address"]'));
									console.log(addressErrors);
								}
							}
						console.log(error);
					  Notiflix.Loading.Remove();
						Notiflix.Report.Failure(
							'Community edit was unsuccessful',
							'something went wrong',
							'close'
						);
					});
				},
			function () {
			});
}
function attach_listeners() {
	document.addEventListener('change',function (e) {
		if (e.target.closest('.imageInput')) {
			submitImage(e.target.closest('.imageInput'));
		}
	});
	document.addEventListener('click',function (e) {
		if (e.target.classList.contains('postDelete')) {
			deletePost(e.target);
		}
		if (e.target.closest('.createPostButton')) {
			postDropzone.processQueue();
		}
		if (e.target.closest('.showCreateForm')) {
			showModal(e.target.closest('.showCreateForm'));
		}
		if (e.target.closest('.closeCreateForm')) {
			closeModal(e.target.closest('.closeCreateForm'));
		}
		if (e.target.closest('.changeLogoButton')) {
			chooseImage(e.target.closest('.changeLogoButton'));
		}
		if (e.target.closest('.editProfile')) {
			editProfile(e.target.closest('.editProfile'));
		}
	});
	document.querySelector('.navlinks').addEventListener('click',function (e) {
		if (e.target.closest('.tabButton')) {
			openTab(e.target.closest('.tabButton'));
		}
	});
}
attach_listeners();
document.getElementById('dashboardTabButton').click();
