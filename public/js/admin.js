var overlay = document.querySelector('.overlay');


Notiflix.Notify.Init({
		useGoogleFont:false,
		fontFamily:'Nunito',
});
Notiflix.Confirm.Init({
	borderRadius:'5px',
	titleColor:'#000',
	height:'1000px',
	okButtonBackground:'#750000',
	cancelButtonBackground:'#5c5c5c',
	useGoogleFont:false,
});
Notiflix.Loading.Init({
	useGoogleFont:false,
	fontFamily:'Nunito',
});
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
//INNER TABS
function openInnerTab(button) {
	let tabID = button.dataset.tab;
	let tab = button.closest('.tabcontent');

	//Hides all the tabs
	tab.querySelectorAll('.innertabcontent').forEach(function (tab) {
		   tab.style.display = 'none';
	});
	let tabButtons = tab.querySelectorAll('.innerTabButton');

	// Sets the background color of all the buttons
	tabButtons.forEach(function (tabButton) {
	   tabButton.classList.remove('activeInnerTab');
	});

	//Makes corresponding tab visible when its button is clicked
	document. getElementById(tabID) . style . display = 'flex';
	button.classList.add('activeInnerTab');
}

function showModal(button) {
 let id = button.dataset.id;
 let modal = document.getElementById(id);
 console.log(modal);
 overlay.style.display = 'block';
 modal.style.display = 'flex';
 document.body.style.overflow = 'hidden';
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
// Image selection In Edit Form
function chooseImage(button) {
	let input = document.querySelector(`input[data-button = "${button.dataset.input}"]`);
	console.log(input);
	input.click();
}

//Image Submission to server for validation and storage
function submitImage(input) {
	let errorList = input.dataset.errors;
		removeValidationErrors(document.querySelector(`.${errorList}`));8
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
				let coverPhotoErrors = error.response.data.errors.categoryCoverPhoto;
				let avatarErrors = error.response.data.errors.avatar;
				if (coverPhotoErrors) {
				  showValidationErrors(coverPhotoErrors,document.querySelector(`.${errorList}`),input);
					console.log(coverPhotoErrors);
				}
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

Dropzone.autoDiscover = false;

var token = document.querySelector('input[name="_token"]').value;
var categoryDropzone;
function attachCategoryDropzone() {
	let form = document.getElementById('categoryCreateForm');
	let errorList = form.querySelector('.errorList');
	categoryDropzone = new Dropzone("#categoryImageDropzone",{
		url:"/categories",
		headers:{'X-CSRF-TOKEN' : token},
		paramName:'categoryCoverPhoto',
		addRemoveLinks:true,
		autoProcessQueue:false,
		acceptedFiles:'image/png,image/jpeg',
		maxFilesize:10,
		dictInvalidFileType:'Files should be of png,jpg or jpeg type',
		dictResponseError:'Invalid data was submitted',
		dictDefaultMessage:'<img src="/images/download.svg"><br>Click or drag to add  image',
	});
		categoryDropzone.on('success',function (file,response) {
			document.querySelector('#closeCategoryCreateForm').click();
			Notiflix.Notify.Success('Category made sucessfully');
			categoryDropzone.removeAllFiles(true);
		});
		categoryDropzone.on('error',function(file,errorMessage,xhr) {
			if (xhr) {
				errorMessage = errorMessage.message;
				if (JSON.parse(xhr.responseText).errors) {
					let nameErrors = JSON.parse(xhr.responseText).errors.name;
					let descriptionErrors = JSON.parse(xhr.responseText).errors.description;
					let imageErrors = JSON.parse(xhr.responseText).errors.categoryCoverPhoto;

					if (nameErrors) {
					  showValidationErrors(nameErrors,errorList,document.querySelector('.name input'));
						console.log(nameErrors);
					}
					if (descriptionErrors) {
						showValidationErrors(descriptionErrors,errorList,document.querySelector('.description textarea'));
						console.log(descriptionErrors);
					}
					if (imageErrors) {
						showValidationErrors(imageErrors,errorList,document.querySelector('.dropzone'));
						console.log(imageErrors);
					}
				}
			}
			this.removeFile(file);
				Notiflix.Report.Failure(
					'Category was not created',
					errorMessage,
					'close',
				);
		});
	categoryDropzone.on('sending',function(data,xhr,formData) {
		removeValidationErrors(errorList);
		form.querySelectorAll('input').forEach(function (field) {
			if (field.type != 'file') {
				formData.append(field.name,field.value);
			}
			else {
				formData.append(field.name,field.files[0]);
			}
		});
		formData.append(form.querySelector('textarea[name="description"]').name,form.querySelector('textarea[name="description"]').value);
	});
	return categoryDropzone;
}
attachCategoryDropzone();


function editCategory(button) {
	let url = button.dataset.url;
	let form = button.closest('.editForm');
	let errorList = form.querySelector('.errorList');

		Notiflix.Confirm.Show(
			'Confirm Category Edit',
			'Are you sure you want to edit this category ?',
			'Edit',
			'Cancel',
			function () {
				removeValidationErrors(form.querySelector('.errorList'));
				let formDataObject = new FormData(form);
				let config = {baseURL:'http://127.0.0.1:8000/'};
//Used post request with a hidden input( name="_method" ,value="PATCH" because laravel seems not to respond correctly to patch and put requests
      Notiflix.Loading.Pulse('Editing...');
				axios.post(url,formDataObject,config)
			    .then(function (response) {
						Notiflix.Loading.Remove();
						form.querySelector('.closeModal').click();
						Notiflix.Notify.Success('Edit Successful');
			    })
					.catch(function (error) {
						Notiflix.Loading.Remove();
						if (error.response) {
							let nameErrors = error.response.data.errors.name;
							let descriptionErrors = error.response.data.errors.description;

							if (nameErrors) {
							  showValidationErrors(nameErrors,errorList,form.querySelector('input[name="name"]'));
								console.log(nameErrors);
							}
							if (descriptionErrors) {
								showValidationErrors(descriptionErrors,errorList,form.querySelector('textarea[name="description"]'));
								console.log(descriptionErrors);
							}
					}
						Notiflix.Report.Failure(
							'Category edit was unsuccessful',
							'something went wrong',
							'close'
						);
					});
				},
			function () {
			});
}



//Ajax  delete
function deleteData(button) {
	let url = button.dataset.url;
	let parent = button.closest('.dataContainer');
		Notiflix.Confirm.Show(
			'Confirm Deletion',
			"Are you sure?<br>This action is permanent",
			'Delete',
			'Cancel',
			function () {
				Notiflix.Loading.Pulse('Deleting...');
				let config = {
						baseURL:'http://127.0.0.1:8000/',
					};
				axios.delete(url)
			    .then(function (response) {
						Notiflix.Loading.Remove();
			    	console.log(response);
						Notiflix.Notify.Success('Successfully Deleted');
						parent.remove();
			    })
					.catch(function (error) {
						Notiflix.Loading.Remove();
						console.log(error);
						Notiflix.Report.Failure(
							'Deletion unsuccessful',
							'something went wrong',
							'close'
						);
					});
				},
			function () {
			});
}
//Ajax Tag creation
function createTag(button) {
	let url = button.dataset.url;
	let errorList = button.closest('form').querySelector('.errorList');
	let formDataObject = new FormData(document.querySelector('#tagCreateForm'));

		let config = {baseURL:'http://127.0.0.1:8000/'};
		Notiflix.Loading.Pulse('Creating Tag....');
		axios.post(url,formDataObject)
	    .then(function (response) {
				Notiflix.Loading.Remove();
	    	console.log(response);
				button.closest('form').querySelector('.closeModal').click();
				Notiflix.Notify.Success('Tag Created Successfully');
	    })
			.catch(function (error) {
				Notiflix.Loading.Remove();
				console.log(error);
				if (error.response) {
					let nameErrors = error.response.data.errors.name;
					if (nameErrors) {
					  showValidationErrors(nameErrors,errorList,document.querySelector('#createTagForm input[name="name"]'));
						console.log(nameErrors);
					}
			}
				Notiflix.Report.Failure(
					'Tag was not created',
					'something went wrong',
					'close'
				);
			});
}

function editTag(button) {
    let url = button.dataset.url;
		let form = button.closest('.editForm');
		let errorList = form.querySelector('.errorList');


		Notiflix.Confirm.Show(
			'Confirm Tag Edit',
			'Are you sure you want to edit this Tag ?',
			'Edit',
			'Cancel',
			function () {
				removeValidationErrors(errorList);
				let formDataObject = new FormData(form);
				let config = {baseURL:'http://127.0.0.1:8000/'};
//Used post request with a hidden input( name="_method" ,value="PATCH" because laravel seems not to respons correctly to patch and put requests
      Notiflix.Loading.Pulse('Editing...');
				axios.post(url,formDataObject,config)
			    .then(function (response) {
						Notiflix.Loading.Remove();
						form.querySelector('.closeModal').click();
						Notiflix.Notify.Success('Tag Edit Successful');
			    })
					.catch(function (error) {
						Notiflix.Loading.Remove();
						if (error.response) {
							let nameErrors = error.response.data.errors.name;
							if (nameErrors) {
							  showValidationErrors(nameErrors,errorList,form.querySelector('input[name="name"]'));
								console.log(nameErrors);
							}
					}
						Notiflix.Report.Failure(
							'Tag edit was unsuccessful',
							'something went wrong',
							'close'
						);
					});
				},
			function () {
			});
}
//Ajax Admin Creation
function createAdmin(button) {
	let form = document.getElementById('adminCreateForm');
	let errorList = form.querySelector('.errorList');
	let url = button.dataset.url;
		let formDataObject = new FormData(form);
		let config = {baseURL:'http://127.0.0.1:8000/'};
		removeValidationErrors(errorList);
		Notiflix.Loading.Pulse('Creating Admin....');
		axios.post(url,formDataObject)
	    .then(function (response) {
				Notiflix.Loading.Remove();
				form.querySelector('.closeModal').click();
				Notiflix.Notify.Success('Admin Created Successfully');
				console.log(response);
	    })
			.catch(function (error) {
				Notiflix.Loading.Remove();
				console.log(error);
				if (error.response) {
					let firstNameErrors = error.response.data.errors.first_name;
					let lastNameErrors = error.response.data.errors.last_name;
					let emailErrors = error.response.data.errors.email;
					let passwordErrors = error.response.data.errors.password;

					if (firstNameErrors) {
					  showValidationErrors(firstNameErrors,errorList,document.querySelector('#createAdminForm input[name="first_name"]'));
						console.log(firstNameErrors);
					}
					if (lastNameErrors) {
					  showValidationErrors(lastNameErrors,errorList,document.querySelector('#createAdminForm input[name="last_name"]'));
						console.log(lastNameErrors);
					}
					if (emailErrors) {
					  showValidationErrors(emailErrors,errorList,document.querySelector('#createAdminForm input[name="email"]'));
						console.log(emailErrors);
					}
					if (passwordErrors) {
					  showValidationErrors(passwordErrors,errorList,document.querySelector('#createAdminForm input[name="password"]'));
						console.log(passwordErrors);
					}
			}
				Notiflix.Report.Failure(
					'Admin user was not created',
					'something went wrong',
					'close'
				);
			});
}

function editProfile(button) {
	let url  = button.dataset.url;
	let form = button.closest('.profileEditForm');
	let errorList = form.querySelector('.errorList');

		Notiflix.Confirm.Show(
			'Confirm Profile Edit',
			'Are you sure you want to make changes to your profile ?',
			'Edit',
			'Cancel',
			function () {
				removeValidationErrors(errorList);
				let formDataObject = new FormData(form);
				let config = {baseURL:'http://127.0.0.1:8000/'};
//Used post request with a hidden input( name="_method" ,value="PATCH" because laravel seems not to respons correctly to patch and put requests
      Notiflix.Loading.Pulse('Editing...');
				axios.post(url,formDataObject)
			    .then(function (response) {
						console.log(response.data);
						Notiflix.Loading.Remove();
						Notiflix.Notify.Success('Edit Successful');
			    })
					.catch(function (error) {
						Notiflix.Loading.Remove();
						if (error.response) {
							let firstNameErrors = error.response.data.errors.first_name;
							let lastNameErrors = error.response.data.errors.last_name;
							let emailErrors = error.response.data.errors.email;
							let avatarErrors = error.response.data.errors.avatar;

							if (firstNameErrors) {
							  showValidationErrors(firstNameErrors,errorList,form.querySelector('input[name="first_name"]'));
								console.log(firstNameErrors);
							}
							if (lastNameErrors) {
							  showValidationErrors(lastNameErrors,errorList,form.querySelector('input[name="last_name"]'));
								console.log(lastNameErrors);
							}
							if (emailErrors) {
							  showValidationErrors(emailErrors,errorList,form.querySelector('input[name="email"]'));
								console.log(emailErrors);
							}
							if (avatarErrors) {
								showValidationErrors(avatarErrors,errorList,form.querySelector('input[name="avatar"]'));
								console.log(avatarErrors);
							}
					}
						Notiflix.Report.Failure(
							'Profile edit was unsuccessful',
							'something went wrong',
							'close'
						);
					});
				},
			function () {
			});
}

//Ajax Pagination
function ajaxPagination(link) {
		let tab = link.closest('.innertabcontent');
		console.log(tab);
		let tabID = tab.id;
		Notiflix.Loading.Pulse();
		let config = {responseType: 'document'};
		axios.get(link.href,config)
		.then(function (response) {
			Notiflix.Loading.Remove();
			console.log(response.data);
			let newPage = response.data.getElementById(tabID);
			console.log(newPage);
			tab.insertAdjacentElement('beforebegin',newPage);
			tab.remove();
		})
		.catch(function (error) {
			Notiflix.Loading.Remove();
			console.log(error);
		})
}

function attach_listeners() {
	document.querySelectorAll('.tabcontent').forEach(function (tab) {
		tab.addEventListener('change',function (e) {
			if (e.target.closest('.imageInput')) {
				submitImage(e.target.closest('.imageInput'));
			}
		});
		tab.addEventListener('click',function (e) {
			if (e.target.closest('a.page-link')) {
				e.preventDefault();
				ajaxPagination(e.target.closest('a.page-link'));
			}
			if (e.target.closest('.innerTabButton')) {
				openInnerTab(e.target.closest('.innerTabButton'));
			}
			if (e.target.closest('.showModal')) {
				showModal(e.target.closest('.showModal'));
			}
			if (e.target.closest('.closeModal')) {
				closeModal(e.target.closest('.closeModal'));
			}
			if (e.target.closest('.createCategoryButton')) {
				categoryDropzone.processQueue();
			}
			if (e.target.closest('.createTagButton')) {
				createTag(e.target.closest('.createTagButton'));
			}
			if (e.target.closest('.createAdminButton')) {
				createAdmin(e.target.closest('.createAdminButton'));
			}
			if (e.target.closest('.editCategoryButton')) {
				editCategory(e.target.closest('.editCategoryButton'));
			}
			if (e.target.closest('.editTagButton')) {
				editTag(e.target.closest('.editTagButton'));
			}
			if (e.target.closest('.changeImage')) {
				chooseImage(e.target.closest('.changeImage'));
			}
			if (e.target.closest('.delete')) {
				deleteData(e.target.closest('.delete'));
			}
		});
	});
	document.querySelector('.navlinks').addEventListener('click',function (e) {
		if (e.target.closest('.tabButton')) {
			openTab(e.target.closest('.tabButton'));
		}
	});
}
attach_listeners();
document.getElementById('dashboardTabButton').click();
document.getElementById('categoriesTabButton').click();
document.getElementById('regularUsersTabButton').click();
