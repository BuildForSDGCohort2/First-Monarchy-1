//Notiflix Init
Notiflix.Notify.Init({
		useGoogleFont:false,
		fontFamily:'Nunito',
});
Notiflix.Report.Init({
		plainText:false,
		fontFamily:'Nunito',
		messageMaxLength:300000,
});
Notiflix.Confirm.Init({
	borderRadius:'5px',
	titleColor:'#000',
	height:'1000px',
	okButtonBackground:'#750000',
	cancelButtonBackground:'#5c5c5c',
	useGoogleFont:false,
	fontFamily:'Nunito',
});
Notiflix.Loading.Init({
	useGoogleFont:false,
	fontFamily:'Nunito',
});

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
		 tabButton.querySelector('.tab_icon').src = tabButton.querySelector('.tab_icon').src.replace('blue','dark');
	});

	//Makes corresponding tab visible when its button is clicked
	document . getElementById(tabID) . style . display = 'flex';
	button.classList.add('activeTab');
	button.querySelector('.tab_icon').src = button.querySelector('.tab_icon').src.replace('dark','blue');
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
	document . getElementById(tabID) . style . display = 'flex';
	button.classList.add('activeInnerTab');
}


var overlay = document.querySelector('.overlay');
var currentlyOpenModal;
//Showing modals for property addition,editing
 function showModal(button,callback) {
	let id = button.dataset.id;
	let modal = document.getElementById(id);
	if (currentlyOpenModal) {
		closeModal(currentlyOpenModal);
	}
	overlay.style.display = 'block';
 	modal.style.display = 'flex';
	document.body.style.overflow = 'hidden';
	currentlyOpenModal = button;
}
//Hiding the property addition,editing
function closeModal(button) {
	console.log(button);
	let id = button.dataset.id;
	console.log(id);
	document.getElementById(id).style.display = 'none';
	overlay.style.display = 'none';
	document.body.style.overflow = 'auto';
	currentlyOpenModal = null;
}
function addImage(data,last,container) {
	let frag = document.createElement('template');
	frag.innerHTML = data;
	frag = frag.content;
	container.insertBefore(frag,last);
}
//Adding Property Images
function addPropertyImage(input) {
		removeValidationErrors(document.querySelector(`.${input.dataset.errors}`));
		let parent = input.closest('.imageViewBox');
		let last = input.closest('.additionContainer');
		console.log(parent);
		let formDataObject = new FormData();
		formDataObject.append(input.name,input.files[0]);
		formDataObject.append('_method','PATCH');
		let url = input.dataset.url;
		let config = {
			baseURL:'http://127.0.0.1:8000/',
		}
		Notiflix.Loading.Pulse('Adding Image...');
		axios.post(url,formDataObject,config)
    .then(function (response) {
			Notiflix.Loading.Remove();
    	console.log(response);
			let imageURL = window.URL.createObjectURL(input.files[0]);
			addImage(response.data,last,parent);
			Notiflix.Notify.Success('Image Added');
    })
		.catch(function (error) {
		if (error.response) {
			let propertyPhotoErrors = error.response.data.errors.propertyPhoto;
			if (propertyPhotoErrors) {
			  showValidationErrors(propertyPhotoErrors,document.querySelector(`.${input.dataset.errors}`),input);
				console.log(propertyPhotoErrors);
			}
		}
			Notiflix.Loading.Remove();
			console.log(error);
			Notiflix.Report.Failure(
				'Image was not Added',
				'something went wrong',
				'close'
			);
		});
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
				let coverPhotoErrors = error.response.data.errors.propertyCoverPhoto;
				let propertyPhotoErrors = error.response.data.errors.propertyPhoto;
				let logoErrors = error.response.data.errors.logo;
				if (coverPhotoErrors) {
				  showValidationErrors(coverPhotoErrors,document.querySelector(`.${errorList}`),input);
					console.log(coverPhotoErrors);
				}
				if (propertyPhotoErrors) {
					showValidationErrors(propertyPhotoErrors,document.querySelector(`.${errorList}`),input);
					console.log(propertyPhotoErrors);
				}
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

//Deleting Property Images
function deletePropertyImage(button) {
    var imageDeleteUrl  = button.dataset.url;
		let parent = button.parentElement.parentElement;

		Notiflix.Confirm.Show(
			'Confirm Image Deletion',
			"Are you sure you want to delete this Image? This action is permanent",
			'Delete',
			'Cancel',
			function () {
				Notiflix.Loading.Pulse('Deleting Image...');
				axios.delete(imageDeleteUrl,{
						baseURL:'http://127.0.0.1:8000/',
					})
			    .then(function (response) {
						parent.remove();
						Notiflix.Loading.Remove();
			    	console.log(response);
						Notiflix.Notify.Success('Image Deleted');
			    })
					.catch(function (error) {
						Notiflix.Loading.Remove();
						console.log(error);
						Notiflix.Report.Failure(
							'Image was not deleted',
							'something went wrong',
							'close'
						);
					});
				},
			function () {
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

function refresh(data,tab,button) {
	let frag = document.createElement('template');
	frag.innerHTML = data;
	frag = frag.content;
	console.log(frag.content);
	let cont = frag.querySelector('.dataContainer');
	let ed = frag.querySelector('.editForm');
	console.log(ed);
	document.getElementById(tab).replaceChild(cont,button.closest('.editForm').previousElementSibling);
	console.log(button.closest('.editForm').previousElementSibling);
	document.getElementById(tab).replaceChild(ed,button.closest('.editForm'));
}

Dropzone.autoDiscover = false;

var token = document.querySelector('input[name="_token"]').value;

var rentalDropzone;
function attachRentalDropzone() {
	let form = document.getElementById('rentalCreateForm');
	let errorList = form.querySelector('.errorList');
  rentalDropzone = new Dropzone("#rentalDropzone",{
		url:"/rentals",
		headers:{'X-CSRF-TOKEN' : token},
		paramName:'propertyPhotos',
		uploadMultiple:true,
		addRemoveLinks:true,
		acceptedFiles:'image/jpeg,image/png',
		autoProcessQueue:false,
		parallelUploads:15,
		maxFiles:15,
		dictFileTooBig:'This file is larger than 10mb',
		dictInvalidFileType:'Files should be of png,jpg or jpeg type',
		dictResponseError:'Invalid data was submitted',
		dictMaxFilesExceeded:'You cannot upload more than 15 images',
		maxFilesize:1,
		dictDefaultMessage:'<img src="/images/download.svg"><br>Click or drag to add  images of your property',
		});
		rentalDropzone.on('successmultiple',function (file,response) {
			document.querySelector('#closeRentalCreateForm').click();
			Notiflix.Notify.Success('Rental added sucessfully');
			rentalDropzone.removeAllFiles(true);
			document.getElementById('rentalsTab').insertAdjacentHTML('beforeend',response);
		});
		rentalDropzone.on('error',function(file,errorMessage,xhr) {
			if(xhr) {
				errorMessage = errorMessage.message;
				if (JSON.parse(xhr.responseText).errors) {
					let nameErrors = JSON.parse(xhr.responseText).errors.name;
					let coverPhotoErrors = JSON.parse(xhr.responseText).errors.propertyCoverPhoto;
					let locationErrors = JSON.parse(xhr.responseText).errors.location;
					let bedroomErrors = JSON.parse(xhr.responseText).errors.bedrooms;
					let bathroomErrors = JSON.parse(xhr.responseText).errors.bathrooms;
					let parkingErrors = JSON.parse(xhr.responseText).errors.parking_slots;
					let unitErrors = JSON.parse(xhr.responseText).errors.units_available;
					let rentErrors = JSON.parse(xhr.responseText).errors.rent;
					let descriptionErrors = JSON.parse(xhr.responseText).errors.description;
					let imageErrors = JSON.parse(xhr.responseText).errors.propertyPhotos;

					if (nameErrors) {
					  showValidationErrors(nameErrors,errorList,form.querySelector('input[name="name"]'));
					}
					if (locationErrors) {
					  showValidationErrors(locationErrors,errorList,form.querySelector('input[name="location"]'));
					}
					if (coverPhotoErrors) {
					  showValidationErrors(coverPhotoErrors,errorList,form.querySelector('input[name="propertyCoverPhoto"]'));
					}
					if (bedroomErrors) {
					  showValidationErrors(bedroomErrors,errorList,form.querySelector('input[name="bedrooms"]'));
					}
					if (bathroomErrors) {
					  showValidationErrors(bathroomErrors,errorList,form.querySelector('input[name="bathrooms"]'));
					}
					if (parkingErrors) {
					  showValidationErrors(parkingErrors,errorList,form.querySelector('input[name="parking_slots"]'));
					}
					if (unitErrors) {
					  showValidationErrors(unitErrors,errorList,form.querySelector('input[name="units_available"]'));
					}
					if (rentErrors) {
					  showValidationErrors(rentErrors,errorList,form.querySelector('input[name="rent"]'));
					}
					if (descriptionErrors) {
						showValidationErrors(descriptionErrors,errorList,form.querySelector('textarea[name="description"]'));
					}
					if (imageErrors) {
						showValidationErrors('One of your images was invalid',errorList,form.querySelector('.dropzone'));
					}
				}
		}
		this.removeFile(file);
			Notiflix.Report.Failure(
				'Rental was not created',
				errorMessage,
				'close',
			);
		});

	rentalDropzone.on('sendingmultiple',function(data,xhr,formData) {
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
	return rentalDropzone;
}
attachRentalDropzone();

//Ajax Rental Editing
function editRental(button) {
    let url  = button.dataset.url;
    let form = button.closest('.editForm');
		let errorList = form.querySelector('.errorList');

		Notiflix.Confirm.Show(
			'Confirm Property Edit',
			'Are you sure you want to edit this rental ?',
			'Edit',
			'Cancel',
			function () {
				removeValidationErrors(form.querySelector('.errorList'));
				let formDataObject = new FormData(form);
				formDataObject.delete('propertyCoverPhoto');
				form.querySelectorAll('input[name="propertyPhoto"]').forEach(function (photo) {
					formDataObject.delete(photo.name);
				});
				let config = {baseURL:'http://127.0.0.1:8000/'};
//Used post request with a hidden input( name="_method" ,value="PATCH" because laravel seems not to respond correctly to axios patch and put requests
      Notiflix.Loading.Pulse('Editing...');
				axios.post(url,formDataObject)
			    .then(function (response) {
						form.querySelector('.closeEditForm').click();
						Notiflix.Loading.Remove();
						Notiflix.Notify.Success('Edit Successful');
						refresh(response.data,'rentalsTab',button);
			    })
					.catch(function (error) {
						console.log(error);
							if (error.response) {
								let nameErrors = error.response.data.errors.name;
								let locationErrors = error.response.data.errors.location;
								let bedroomErrors = error.response.data.errors.bedrooms;
								let bathroomErrors = error.response.data.errors.bathrooms;
								let parkingErrors = error.response.data.errors.parking_slots;
								let unitErrors = error.response.data.errors.units_available;
								let rentErrors = error.response.data.errors.rent;
								let descriptionErrors = error.response.data.errors.description;

								if (nameErrors) {
								  showValidationErrors(nameErrors,errorList,form.querySelector('input[name="name"]'));
									console.log(nameErrors);
								}
								if (locationErrors) {
								  showValidationErrors(locationErrors,errorList,form.querySelector('input[name="location"]'));
									console.log(locationErrors);
								}
								if (bedroomErrors) {
								  showValidationErrors(bedroomErrors,errorList,form.querySelector('input[name="bedrooms"]'));
									console.log(bedroomErrors);
								}
								if (bathroomErrors) {
								  showValidationErrors(bathroomErrors,errorList,form.querySelector('input[name="bathrooms"]'));
									console.log(bathroomErrors);
								}
								if (parkingErrors) {
								  showValidationErrors(parkingErrors,errorList,form.querySelector('input[name="parking_slots"]'));
									console.log(parkingErrors);
								}
								if (unitErrors) {
								  showValidationErrors(unitErrors,errorList,form.querySelector('input[name="units_available"]'));
									console.log(unitErrors);
								}
								if (rentErrors) {
								  showValidationErrors(rentErrors,errorList,form.querySelector('input[name="rent"]'));
									console.log(rentErrors);
								}
								if (descriptionErrors) {
									showValidationErrors(descriptionErrors,errorList,form.querySelector('textarea[name="description"]'));
									console.log(descriptionErrors);
								}
							}
					  Notiflix.Loading.Remove();
						Notiflix.Report.Failure(
							'Rental edit was unsuccessful',
							'something went wrong',
							'close'
						);
						console.log(error);
					});
				},
			function () {
			});
}

//Ajax Hostel creation
var hostelDropzone;
function attachHostelDropzone() {
	let form = document.getElementById('hostelCreateForm');
	let errorList = form.querySelector('.errorList');
  hostelDropzone = new Dropzone("#hostelDropzone",{
		url:"/hostels",
		headers:{'X-CSRF-TOKEN' : token},
		paramName:'propertyPhotos',
		uploadMultiple:true,
		addRemoveLinks:true,
		acceptedFiles:'image/jpeg,image/png',
		autoProcessQueue:false,
		parallelUploads:15,
		maxFiles:1,
		dictFileTooBig:'This file is larger than 10mb',
		dictInvalidFileType:'Files should be of png,jpg or jpeg type',
		dictResponseError:'Invalid data was submitted',
		dictMaxFilesExceeded:'You cannot upload more than 15 images',
		maxFilesize:10,
		dictDefaultMessage:'<img src="/images/add.svg"><br>Click or drag to add  images of your property',
	});
		hostelDropzone.on('successmultiple',function (data,response) {
			document.querySelector('#closeHostelCreateForm').click();
			Notiflix.Notify.Success('Hostel added sucessfully');
			hostelDropzone.removeAllFiles(true);
			document.getElementById('hostelsTab').insertAdjacentHTML('beforeend',response);
		});
		hostelDropzone.on('error',function(file,errorMessage,xhr) {
			if (xhr) {
				errorMessage = errorMessage.message;
				console.log(JSON.parse(xhr.responseText).errors);
				if (JSON.parse(xhr.responseText).errors) {
					let nameErrors = JSON.parse(xhr.responseText).errors.name;
					let coverPhotoErrors = JSON.parse(xhr.responseText).errors.propertyCoverPhoto;
					let locationErrors = JSON.parse(xhr.responseText).errors.location;
					let bedErrors = JSON.parse(xhr.responseText).errors.beds;
					let genderErrors = JSON.parse(xhr.responseText).errors.gender;
					let unitErrors = JSON.parse(xhr.responseText).errors.units_available;
					let rentErrors = JSON.parse(xhr.responseText).errors.rent;
					let descriptionErrors = JSON.parse(xhr.responseText).errors.description;
					let imageErrors = JSON.parse(xhr.responseText).errors.propertyPhotos;

					if (nameErrors) {
					  showValidationErrors(nameErrors,errorList,form.querySelector('input[name="name"]'));
						console.log(nameErrors);
					}
					if (locationErrors) {
					  showValidationErrors(locationErrors,errorList,form.querySelector('input[name="location"]'));
						console.log(locationErrors);
					}
					if (coverPhotoErrors) {
					  showValidationErrors(coverPhotoErrors,errorList,form.querySelector('input[name="propertyCoverPhoto"]'));
						console.log(coverPhotoErrors);
					}
					if (bedErrors) {
					  showValidationErrors(bedErrors,errorList,form.querySelector('input[name="beds"]'));
						console.log(bedErrors);
					}
					if (genderErrors) {
					  showValidationErrors(genderErrors,errorList,form.querySelector('select[name = "gender"]'));
						console.log(genderErrors);
					}
					if (unitErrors) {
					  showValidationErrors(unitErrors,errorList,form.querySelector('input[name="units_available"]'));
						console.log(unitErrors);
					}
					if (rentErrors) {
					  showValidationErrors(rentErrors,errorList,form.querySelector('input[name="rent"]'));
						console.log(rentErrors);
					}
					if (descriptionErrors) {
						showValidationErrors(descriptionErrors,errorList,form.querySelector('textarea[name="description"]'));
						console.log(descriptionErrors);
					}
					if (imageErrors) {
						showValidationErrors('One of your images was invalid',errorList,form.querySelector('.dropzone'));
						console.log(imageErrors);
					}
				}
			}
			this.removeFile(file);
			Notiflix.Report.Failure(
				'Hostel was not created',
				errorMessage,
				'close'
			);
		});
		hostelDropzone.on('sendingmultiple',function(data,xhr,formData) {
			removeValidationErrors(errorList);
			form.querySelectorAll('input').forEach(function (field) {
				if (field.type != 'file') {
					formData.append(field.name,field.value);
				}
				else {
					formData.append(field.name,field.files[0]);
				}
			});
				formData.append(form.querySelector('select[name="gender"]').name,form.querySelector('select[name="gender"]').value);
			formData.append(form.querySelector('textarea[name="description"]').name,form.querySelector('textarea[name="description"]').value);
		});
}
attachHostelDropzone();


function editHostel(button) {
    let url  = button.dataset.url;
    let form = button.closest('.editForm');
		let errorList = form.querySelector('.errorList');

		Notiflix.Confirm.Show(
			'Confirm Property Edit',
			'Are you sure you want to edit this hostel ?',
			'Edit',
			'Cancel',
			function () {
				removeValidationErrors(form.querySelector('.errorList'));
				let formDataObject = new FormData(form);
				formDataObject.delete('propertyCoverPhoto');
				form.querySelectorAll('input[name="propertyPhoto"]').forEach(function (photo) {
					formDataObject.delete(photo.name);
				});
				let config = {baseURL:'http://127.0.0.1:8000/'};
//Used post request with a hidden input( name="_method" ,value="PATCH" because laravel seems not to respond correctly to patch and put requests
      Notiflix.Loading.Pulse('Editing...');
				axios.post(url,formDataObject)
			    .then(function (response) {
						form.querySelector('.closeEditForm').click();
						Notiflix.Loading.Remove();
						Notiflix.Notify.Success('Edit Successful');
						refresh(response.data,'hostelsTab',button);
			    })
					.catch(function (error) {
						console.log(error);
							if (error.response) {
								let nameErrors = error.response.data.errors.name;
								let locationErrors = error.response.data.errors.location;
								let bedErrors = error.response.data.errors.beds;
								let genderErrors = error.response.data.errors.gender;
								let unitErrors = error.response.data.errors.units_available;
								let rentErrors = error.response.data.errors.rent;
								let descriptionErrors = error.response.data.errors.description;

								if (nameErrors) {
								  showValidationErrors(nameErrors,errorList,form.querySelector('input[name="name"]'));
									console.log(nameErrors);
								}
								if (locationErrors) {
								  showValidationErrors(locationErrors,errorList,form.querySelector('input[name="location"]'));
									console.log(locationErrors);
								}
								if (bedErrors) {
								  showValidationErrors(bedErrors,errorList,form.querySelector('input[name="beds"]'));
									console.log(bedErrors);
								}
								if (genderErrors) {
								  showValidationErrors(genderErrors,errorList,form.querySelector('select[name="gender"]'));
									console.log(genderErrors);
								}
								if (unitErrors) {
								  showValidationErrors(unitErrors,errorList,form.querySelector('input[name="units_available"]'));
									console.log(unitErrors);
								}
								if (rentErrors) {
								  showValidationErrors(rentErrors,errorList,form.querySelector('input[name="rent"]'));
									console.log(rentErrors);
								}
								if (descriptionErrors) {
									showValidationErrors(descriptionErrors,errorList,form.querySelector('textarea[name="description"]'));
									console.log(descriptionErrors);
								}
							}
					  Notiflix.Loading.Remove();
						Notiflix.Report.Failure(
							'Hostel edit was unsuccessful',
							'something went wrong',
							'close'
						);
					});
				},
			function () {
			});
}


//Ajax Standalone Creation
var standaloneDropzone;
function attachStandaloneDropzone() {
	let form = document.querySelector('#standaloneCreateForm');
	let errorList = form.querySelector('.errorList');
	 standaloneDropzone = new Dropzone("#standaloneDropzone",{
		url:"/standalones",
		headers:{'X-CSRF-TOKEN' : token},
		paramName:'propertyPhotos',
		uploadMultiple:true,
		addRemoveLinks:true,
		acceptedFiles:'image/jpeg,image/png',
		autoProcessQueue:false,
		parallelUploads:15,
		maxFiles:15,
		dictFileTooBig:'This file is larger than 10mb',
		dictInvalidFileType:'Files should be of png,jpg or jpeg type',
		dictResponseError:'Invalid data was submitted',
		dictMaxFilesExceeded:'You cannot upload more than 15 images',
		maxFilesize:10,
		dictDefaultMessage:'<img src="/images/add.svg"><br>Click or drag to add  images of your property',
	 });
		standaloneDropzone.on('successmultiple',function (file,response) {
			document.querySelector('#closeStandaloneCreateForm').click();
			Notiflix.Notify.Success('Standalone added sucessfully');
			standaloneDropzone.removeAllFiles(true);
			document.getElementById('standalonesTab').insertAdjacentHTML('beforeend',response);
		});
		standaloneDropzone.on('error',function(file,errorMessage,xhr) {
			if (xhr) {
				errorMessage = errorMessage.message;
				console.log(JSON.parse(xhr.responseText).errors);
				if (JSON.parse(xhr.responseText).errors) {
					let nameErrors = JSON.parse(xhr.responseText).errors.name;
					let coverPhotoErrors = JSON.parse(xhr.responseText).errors.propertyCoverPhoto;
					let locationErrors = JSON.parse(xhr.responseText).errors.location;
					let bedroomErrors = JSON.parse(xhr.responseText).errors.bedrooms;
					let bathroomErrors = JSON.parse(xhr.responseText).errors.bathrooms;
					let parkingErrors = JSON.parse(xhr.responseText).errors.parking_slots;
					let selling_priceErrors = JSON.parse(xhr.responseText).errors.selling_price;
					let areaErrors = JSON.parse(xhr.responseText).errors.area;
					let plotSizeErrors = JSON.parse(xhr.responseText).errors.plot_size;
					let descriptionErrors = JSON.parse(xhr.responseText).errors.description;
					let imageErrors = JSON.parse(xhr.responseText).errors.propertyPhotos/.0;

					if (nameErrors) {
					  showValidationErrors(nameErrors,errorList,form.querySelector('input[name="name"]'));
					}
					if (locationErrors) {
					  showValidationErrors(locationErrors,errorList,form.querySelector('input[name="location"]'));
					}
					if (coverPhotoErrors) {
					  showValidationErrors(coverPhotoErrors,errorList,form.querySelector('input[name="propertyCoverPhoto"]'));
					}
					if (bedroomErrors) {
					  showValidationErrors(bedroomErrors,errorList,form.querySelector('input[name="bedrooms"]'));
					}
					if (bathroomErrors) {
					  showValidationErrors(bathroomErrors,errorList,form.querySelector('input[name="bathrooms"]'));
					}
					if (plotSizeErrors) {
					  showValidationErrors(plotSizeErrors,errorList,form.querySelector('input[name="plot_size"]'));
					}
					if (selling_priceErrors) {
					  showValidationErrors(selling_priceErrors,errorList,form.querySelector('input[name="selling_price"]'));
					}
					if (parkingErrors) {
					  showValidationErrors(parkingErrors,errorList,form.querySelector('input[name="parking_slots"]'));
					}
					if (areaErrors) {
					  showValidationErrors(areaErrors,errorList,form.querySelector('input[name="area"]'));
					}
					if (descriptionErrors) {
						showValidationErrors(descriptionErrors,errorList,form.querySelector('textarea[name="description"]'));
					}
					if (imageErrors) {
						showValidationErrors('One of your images was invalid',errorList,form.querySelector('.dropzone'));
					}
				}
			}
			this.removeFile(file);
			Notiflix.Report.Failure(
				'Standalone was not created',
				errorMessage,
				'close',
			);
		});

	standaloneDropzone.on('sendingmultiple',function(data,xhr,formData) {
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
	return standaloneDropzone;
}
attachStandaloneDropzone();

//Ajax standalone edit
function editStandalone(button) {
    let url  = button.dataset.url;
    let form = button.closest('.editForm');
		let errorList = form.querySelector('.errorList');

		Notiflix.Confirm.Show(
			'Confirm Property Edit',
			'Are you sure you want to edit this Standalone ?',
			'Update',
			'Cancel',
			function () {
        removeValidationErrors(form.querySelector('.errorList'));
				let formDataObject = new FormData(form);
				formDataObject.delete('propertyCoverPhoto');
				form.querySelectorAll('input[name="propertyPhoto"]').forEach(function (photo) {
					formDataObject.delete(photo.name);
				});
				let config = {baseURL:'http://127.0.0.1:8000/'};
//Used post request with a hidden input( name="_method" ,value="PATCH" because laravel seems not to respons correctly to patch and put requests
      Notiflix.Loading.Pulse('Editing...');
				axios.post(url,formDataObject)
			    .then(function (response) {
						form.querySelector('.closeEditForm').click();
						Notiflix.Loading.Remove();
						Notiflix.Notify.Success('Edit Successful');
						refresh(response.data,'standalonesTab',button);
			    })
					.catch(function (error) {
							console.log(error);
							if (error.response) {
								let nameErrors = error.response.data.errors.name;
								let locationErrors = error.response.data.errors.location;
								let bedroomErrors = error.response.data.errors.bedrooms;
								let bathroomErrors = error.response.data.errors.bathrooms;
								let parkingErrors = error.response.data.errors.parking_slots;
								let plotErrors = error.response.data.errors.plot_size;
								let selling_priceErrors = error.response.data.errors.selling_price;
								let areaErrors = error.response.data.errors.area;
								let descriptionErrors = error.response.data.errors.description;

								if (nameErrors) {
								  showValidationErrors(nameErrors,errorList,form.querySelector('input[name="name"]'));
									console.log(nameErrors);
								}
								if (locationErrors) {
								  showValidationErrors(locationErrors,errorList,form.querySelector('input[name="location"]'));
									console.log(locationErrors);
								}
								if (bedroomErrors) {
								  showValidationErrors(bedroomErrors,errorList,form.querySelector('input[name="bedrooms"]'));
									console.log(bedroomErrors);
								}
								if (bathroomErrors) {
								  showValidationErrors(bathroomErrors,errorList,form.querySelector('input[name="bathrooms"]'));
									console.log(bathroomErrors);
								}
								if (parkingErrors) {
								  showValidationErrors(parkingErrors,errorList,form.querySelector('input[name="parking_slots"]'));
									console.log(parkingErrors);
								}
								if (plotErrors) {
								  showValidationErrors(plotErrors,errorList,form.querySelector('input[name="plot_size"]'));
									console.log(plotErrors);
								}
								if (selling_priceErrors) {
								  showValidationErrors(selling_priceErrors,errorList,form.querySelector('input[name="selling_price"]'));
									console.log(selling_priceErrors);
								}
								if (areaErrors) {
								  showValidationErrors(areaErrors,errorList,form.querySelector('input[name="area"]'));
									console.log(areaErrors);
								}
								if (descriptionErrors) {
									showValidationErrors(descriptionErrors,errorList,form.querySelector('textarea[name="description"]'));
									console.log(descriptionErrors);
								}
							}
					  Notiflix.Loading.Remove();
						Notiflix.Report.Failure(
							'Standalone edit was unsuccessful',
							'something went wrong',
							'close'
						);
					});
				},
			function () {
			});
}

//Ajax Workspace Creation
var workspaceDropzone;
function attachWorkspaceDropzone() {
	let form = document.getElementById('workspaceCreateForm');
	let errorList = form.querySelector('.errorList');
	 workspaceDropzone = new Dropzone("#workspaceDropzone",{
		url:"/workspaces",
		headers:{'X-CSRF-TOKEN' : token},
		paramName:'propertyPhotos',
		uploadMultiple:true,
		addRemoveLinks:true,
		acceptedFiles:'image/jpeg,image/png',
		autoProcessQueue:false,
		parallelUploads:15,
		maxFiles:15,
		dictFileTooBig:'This file is larger than 10mb',
		dictInvalidFileType:'Files should be of png,jpg or jpeg type',
		dictResponseError:'Invalid data was submitted',
		dictMaxFilesExceeded:'You cannot upload more than 15 images',
		maxFilesize:1,
		dictDefaultMessage:'<img src="/images/add.svg"><br>Click or drag to add  images of your property',
	 });
		workspaceDropzone.on('successmultiple',function (file,response) {
			document.querySelector('#closeWorkspaceCreateForm').click();
			Notiflix.Notify.Success('Workspace added sucessfully');
			workspaceDropzone.removeAllFiles(true);
			document.getElementById('workspacesTab').insertAdjacentHTML('beforeend',response);
		});
		workspaceDropzone.on('error',function(file,errorMessage,xhr) {
			if (xhr) {
				if (JSON.parse(xhr.responseText).errors) {
					let nameErrors = JSON.parse(xhr.responseText).errors.name;
					let coverPhotoErrors = JSON.parse(xhr.responseText).errors.propertyCoverPhoto;
					let locationErrors = JSON.parse(xhr.responseText).errors.location;
					let rentErrors = JSON.parse(xhr.responseText).errors.rent;
					let unitErrors = JSON.parse(xhr.responseText).errors.units_available;
					let areaErrors = JSON.parse(xhr.responseText).errors.area;
					let descriptionErrors = JSON.parse(xhr.responseText).errors.description;
					let imageErrors = JSON.parse(xhr.responseText).errors.propertyPhotos;

					if (nameErrors) {
					  showValidationErrors(nameErrors,errorList,form.querySelector('input[name="name"]'));
						console.log(nameErrors);
					}
					if (locationErrors) {
					  showValidationErrors(locationErrors,errorList,form.querySelector('input[name="location"]'));
						console.log(locationErrors);
					}
					if (coverPhotoErrors) {
					  showValidationErrors(coverPhotoErrors,errorList,form.querySelector('input[name="propertyCoverPhoto"]'));
						console.log(coverPhotoErrors);
					}
					if (rentErrors) {
					  showValidationErrors(rentErrors,errorList,form.querySelector('input[name="rent"]'));
						console.log(rentErrors);
					}
					if (unitErrors) {
					  showValidationErrors(unitErrors,errorList,form.querySelector('input[name="units_available"]'));
						console.log(unitErrors);
					}
					if (areaErrors) {
					  showValidationErrors(areaErrors,errorList,form.querySelector('input[name="area"]'));
						console.log(areaErrors);
					}
					if (descriptionErrors) {
						showValidationErrors(descriptionErrors,errorList,form.querySelector('textarea[name="description"]'));
						console.log(descriptionErrors);
					}
					if (imageErrors) {
						showValidationErrors('One of your images was invalid',errorList,form.querySelector('.dropzone'));
						console.log(imageErrors);
					}
				}
			}
			this.removeFile(file);
			Notiflix.Report.Failure(
				'Workspace was not created',
				errorMessage,
				'close'
			);
		});

	workspaceDropzone.on('sendingmultiple',function(file,xhr,formData) {
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
}
attachWorkspaceDropzone();

//Ajax Workspace edit
function editWorkspace(button) {
		let url  = button.dataset.url;
    let form = button.closest('.editForm');
		let errorList = form.querySelector('.errorList');

		Notiflix.Confirm.Show(
			'Confirm Property Edit',
			'Are you sure you want to edit this Workspace?',
			'Edit',
			'Cancel',
			function () {
				removeValidationErrors(form.querySelector('.errorList'));
				let formDataObject = new FormData(form);
				formDataObject.delete('propertyCoverPhoto');
				form.querySelectorAll('input[name="propertyPhoto"]').forEach(function (photo) {
					formDataObject.delete(photo.name);
				});
				let config = {baseURL:'http://127.0.0.1:8000/'};
//Used post request with a hidden input( name="_method" ,value="PATCH" because laravel seems not to respons correctly to patch and put requests
      Notiflix.Loading.Pulse('Editing...');
				axios.post(url,formDataObject)
			    .then(function (response) {
						form.querySelector('.closeEditForm').click();
						Notiflix.Loading.Remove();
						Notiflix.Notify.Success('Edit Successful');
						refresh(response.data,'workspacesTab',button);
			    })
					.catch(function (error) {
							if (error.response) {
								let nameErrors = error.response.data.errors.name;
								let locationErrors = error.response.data.errors.location;
								let unitErrors = error.response.data.errors.units_available;
								let rentErrors = error.response.data.errors.rent;
								let areaErrors = error.response.data.errors.area;
								let descriptionErrors = error.response.data.errors.description;

								if (nameErrors) {
								  showValidationErrors(nameErrors,errorList,form.querySelector('input[name="name"]'));
									console.log(nameErrors);
								}
								if (locationErrors) {
								  showValidationErrors(locationErrorserrorList,form.querySelector('input[name="location"]'));
									console.log(locationErrors);
								}
								if (unitErrors) {
								  showValidationErrors(unitErrors,errorList,form.querySelector('input[name="units_available"]'));
									console.log(unitErrors);
								}
								if (rentErrors) {
								  showValidationErrors(rentErrors,errorList,form.querySelector('input[name="rent"]'));
									console.log(rentErrors);
								}
								if (areaErrors) {
								  showValidationErrors(areaErrors,errorList,form.querySelector('input[name="area"]'));
									console.log(areaErrors);
								}
								if (descriptionErrors) {
									showValidationErrors(descriptionErrors,errorList,form.querySelector('textarea[name="description"]'));
									console.log(descriptionErrors);
								}
							}
					  Notiflix.Loading.Remove();
						Notiflix.Report.Failure(
							'Workspace edit was unsuccessful',
							'something went wrong',
							'close'
						);
					});
				},
			function () {
			});
}
//Ajax Community Creation
var communityDropzone;
function attachCommunityDropzone() {
	let form = document.querySelector('#communityCreateForm');
	let errorList = form.querySelector('.errorList');
	communityDropzone = new Dropzone("#communityDropzone",{
		url:"/communities",
		headers:{'X-CSRF-TOKEN' : token},
		paramName:'propertyPhotos',
		uploadMultiple:true,
		addRemoveLinks:true,
		acceptedFiles:'image/jpeg,image/png',
		autoProcessQueue:false,
		parallelUploads:15,
		maxFiles:15,
		dictFileTooBig:'This file is larger than 10mb',
		dictInvalidFileType:'Files should be of png,jpg or jpeg type',
		dictResponseError:'Invalid data was submitted',
		dictMaxFilesExceeded:'You cannot upload more than 15 images',
		maxFilesize:10,
		dictDefaultMessage:'<img src="/images/add.svg"><br>Click or drag to add  images of your property',
	 });
	communityDropzone.on('successmultiple',function (file,response) {
		document.querySelector('#closeCommunityCreateForm').click();
		Notiflix.Notify.Success('Community added sucessfully');
		communityDropzone.removeAllFiles(true);
		document.getElementById('communitiesTab').insertAdjacentHTML('beforeend',response);
	}),
	communityDropzone.on('error',function(file,errorMessage,xhr) {
		if (xhr) {
			errorMessage = errorMessage.message;
			if (JSON.parse(xhr.responseText).errors) {
				let nameErrors = JSON.parse(xhr.responseText).errors.name;
				let locationErrors = JSON.parse(xhr.responseText).errors.location;
				let coverPhotoErrors = JSON.parse(xhr.responseText).errors.propertyCoverPhoto;
				let descriptionErrors = JSON.parse(xhr.responseText).errors.description;
				let imageErrors = JSON.parse(xhr.responseText).errors.propertyPhotos;

				if (nameErrors) {
					showValidationErrors(nameErrors,errorList,form.querySelector('input[name="name"]'));
					console.log(nameErrors);
				}
				if (locationErrors) {
					showValidationErrors(locationErrors,errorList,form.querySelector('input[name="location"]'));
					console.log(locationErrors);
				}
				if (coverPhotoErrors) {
					showValidationErrors(coverPhotoErrors,errorList,form.querySelector('input[name="propertyCoverPhoto"]'));
					console.log(coverPhotoErrors);
				}

				if (descriptionErrors) {
					showValidationErrors(descriptionErrors,errorList,form.querySelector('textarea[name="description"]'));
					console.log(descriptionErrors);
				}
				if (imageErrors) {
					showValidationErrors('One of your images was invalid',errorList,form.querySelector('.dropzone'));
					console.log(imageErrors);
				}
			}
		}
		this.removeFile(file);
		Notiflix.Report.Failure(
			'Community was not created',
			errorMessage,
			'close'
		);
	});
communityDropzone.on('sendingmultiple',function(data,xhr,formData) {
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
	return communityDropzone;
}
attachCommunityDropzone();


//Ajax Community edit
function editCommunity(button) {
	let url  = button.dataset.url;
	let form = button.closest('.editForm');
	let errorList = form.querySelector('.errorList');

		Notiflix.Confirm.Show(
			'Confirm Property Edit',
			'Are you sure you want to edit this Community?',
			'Edit',
			'Cancel',
			function () {
				removeValidationErrors(errorList);
				let formDataObject = new FormData(form);
				formDataObject.delete('propertyCoverPhoto');
				form.querySelectorAll('input[name="propertyPhoto"]').forEach(function (photo) {
					formDataObject.delete(photo.name);
				});
				let config = {baseURL:'http://127.0.0.1:8000/'};
//Use post request with a hidden input( name="_method" ,value="PATCH" because laravel seems not to respons correctly to patch and put requests
      Notiflix.Loading.Pulse('Editing...');
				axios.post(url,formDataObject)
			    .then(function (response) {
						form.querySelector('.closeEditForm').click();
						Notiflix.Loading.Remove();
						Notiflix.Notify.Success('Edit Successful');
						refresh(response.data,'rentalsTab',button);
			    })
					.catch(function (error) {
							if (error.response) {
								let nameErrors = error.response.data.errors.name;
								let locationErrors = error.response.data.errors.location;
								let descriptionErrors = error.response.data.errors.description;
								let coverErrors = error.response.data.errors.propertyCoverPhoto;

								if (nameErrors) {
								  showValidationErrors(nameErrors,errorList,form.querySelector('input[name="name"]'));
									console.log(nameErrors);
								}
								if (locationErrors) {
								  showValidationErrors(locationErrors,errorList,form.querySelector('input[name="location"]'));
									console.log(locationErrors);
								}
								if (descriptionErrors) {
									showValidationErrors(descriptionErrors,errorList,form.querySelector('textarea[name="description"]'));
									console.log(descriptionErrors);
								}
								if (coverErrors) {
									showValidationErrors(descriptionErrors,errorList,form.querySelector('input[name="propertyCoverPhoto"]'));
									console.log(coverErrors);
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
//Ajax property Delete
function deleteProperty(button) {
    let url  = button.dataset.url;
		let name = button.dataset.name;
		let parent = button.closest('.dataContainer');

		Notiflix.Confirm.Show(
			'Confirm Property Deletion',
			"Are you sure you want to delete this property ?<br>This action is permanent",
			'Delete',
			'Cancel',
			function () {
				Notiflix.Loading.Pulse(`Deleting ${name}`);
				let config = {
						baseURL:'http://127.0.0.1:8000/',
					};
				axios.delete(url)
			    .then(function (response) {
						Notiflix.Loading.Remove();
						parent.remove();
						Notiflix.Notify.Success(`${name} Deleted`);
			    })
					.catch(function (error) {
						Notiflix.Loading.Remove();
						console.log(error);
						Notiflix.Report.Failure(
							`${name} was not deleted`,
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

								if (nameErrors) {
								  showValidationErrors(nameErrors,errorList,form.querySelector('input[name="name"]'));
									console.log(nameErrors);
								}
								if (descriptionErrors) {
									showValidationErrors(bioErrors,errorList,form.querySelector('textarea[name="bio"]'));
									console.log(bioErrors);
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

//Showing the list of communities
function show_communities(button) {
	let community = button.dataset.community;
	if (button.classList.contains('InCommunity')) {
		Notiflix.Report.Info(
			'Already In a Community',
			`This property already belongs to <strong>${community}</strong>.Remove it from <strong>${community}</strong> if you want to add it to another community`,
			'close'
		);
		return;
	}
	else {
		let property = button.dataset.property;
		let type = button.dataset.type;
		let modal = document.querySelector('.modalContent');
			Notiflix.Loading.Pulse('Loading Communities...');
			let config = {
				baseURL:'http://127.0.0.1:8000/',
			}
			axios.get('/community_list',config)
			.then(function (response) {
				let list = [];
				response.data.forEach(function (community) {
						let name = [community.name,community.id];
						list.push(name);
				});
			 let	list2 = list.map(function (item) {
					let li = '<li class="item">'.concat(item[0]);
					let button = `<button class="button community_addition" data-url="/communities/${item[1]}/${type}/${property}">Add</button>`;
					li = li.concat(button,'</li>');
					return li;
				});
				let element =
				`<button type="button" data-id="modal" class="close closeModal"><img src =" ../images/close1.svg"></button>
				<h3>Choose Community</h3>
				<ul class = "list"> ${list2}  </ul>`;
				Notiflix.Loading.Remove();
				modal.innerHTML = "";
				modal.insertAdjacentHTML('beforeend',element);
				showModal(button);
			})
			.catch(function (error) {
				Notiflix.Loading.Remove();
				Notiflix.Report.Failure(
					'Unable to fetch communities',
					'something went wrong',
					'close'
				);
			})
	}
}

function add_to_community(button) {
		let url = button.dataset.url;
		Notiflix.Loading.Pulse('Adding to Community...');
		axios.post(url)
		.then(function (response) {
			document.querySelector('.modal .close').click();
			Notiflix.Loading.Remove();
			Notiflix.Notify.Success('Successfully Added To Community');
		})
		.catch(function (error) {
			console.log(error);
			Notiflix.Loading.Remove();
			Notiflix.Notify.Failure('Something went wrong');
		});
}

function remove_from_community(button) {
	Notiflix.Confirm.Show(
		'Confirm Property Deletion',
		"Are you sure you want to remove this property from this community ?",
		'Remove',
		'Cancel',
		function () {
			let parent = button.closest('.dataContainer');
			Notiflix.Loading.Pulse('Removing...');
			let url = button.dataset.url;
			axios.delete(url)
			.then(function (response) {
				parent.remove();
				Notiflix.Loading.Remove();
				Notiflix.Notify.Success('Succesfully removed from community');
			})
			.catch(function (error) {
				console.log(error);
				Notiflix.Loading.Remove();
				Notiflix.Report.Failure(
					'Not removed from community',
					'Something went wrong',
					'close',
				);
	  });
	},
	function () {
	});
}

function show_data(button) {
	let name = button.dataset.data;
	if (button.classList.contains('empty')) {
		Notiflix.Report.Info(
			'Nothing to show',
		  `This property has 0 ${name}`,
			'close',
		);
		return;
	}
	else {
		let tab = button.dataset.tab;
		let tabButton = button.dataset.tabbutton;
		Notiflix.Loading.Pulse('Getting data...');
		axios.get(button.dataset.url)
		.then(function (response) {
			document.getElementById(tab).innerHTML="";
			document.getElementById(tab).insertAdjacentHTML('beforeend',response.data);
			if (currentlyOpenModal) {
				closeModal(currentlyOpenModal);
			}
			document.getElementById(tabButton).click();
			Notiflix.Loading.Remove();
		})
		.catch(function (error) {
			console.log(error);
			Notiflix.Loading.Remove();
			Notiflix.Report.Failure(
				'Something went wrong',
				'Failed to get data',
				'close'
			);
		})
	}
}
document.addEventListener('DOMContentLoaded',function () {
  let calendarEl = document.getElementById('calendar');
  let date = new Date();
  let calendar = new FullCalendar.Calendar(calendarEl,{
    plugins:['dayGrid','timeGrid','interaction'],
    // dateClick:function (dateClickInfo) {
    //   console.log(dateClickInfo);
    // },
    selectable:true,
    selectOverlap:false,
  //   selectConstraint:[
  //     {
  //     startTime:'08:00',
  //     endTime:'17:00',
  //   }
  // ],
    select:function (selectionInfo) {
      console.log(selectionInfo);
      Notiflix.Confirm.Show(
        'Confirm Selected Time',
        `${selectionInfo.start} to ${selectionInfo.end}`,
        'Confirm',
        'Cancel',
        function () {
          schedule_visit(document.querySelector('.scheduleButton'),selectionInfo);
        },
        function () {

        }
       );
    },
    header:{
			left:'dayGridMonth,timeGridWeek,timeGridDay',
      center:'title',
      right:'prev,today,next',
    },
    views:{
      timeGrid:{
				allDaySlot:false,
        // weekends:false,
        hiddenDays:[1],
        nowIndicator:true,
        slotDuration:'00:30:00',
        minTime:'8:00:00',
        maxTime:'17:00:00',
      },
    },
    height:'parent',
    defaultView:'dayGridMonth',
    validRange:function (nowDate,nowTime) {
      return{
        start:nowDate,
      };
    },
    events:'/visits',
  });
  calendar.render();
});
function attach_listeners() {
	document.addEventListener('click',function (e) {
		//This button is on a modal
		if (e.target.closest('.closeModal')) {
			closeModal(e.target.closest('.closeModal'));
		}
		//This button too is on a modal
			if (e.target.closest('.community_addition')) {
				add_to_community(e.target.closest('.community_addition'));
			}
			if (e.target.closest('.remove_from_community')) {
				remove_from_community(e.target.closest('.remove_from_community'));
			}
	});
	document.querySelectorAll('.tabcontent').forEach(function (tab) {
		tab.addEventListener('change',function (e) {
			if (e.target.closest('.coverImageInput')) {
				submitImage(e.target.closest('.coverImageInput'));
			}
			if (e.target.closest('.imageInput')) {
				submitImage(e.target.closest('.imageInput'));
			}
			if (e.target.closest('.addedImage')) {
				addPropertyImage(e.target.closest('.addedImage'));
			}
		});
		tab.addEventListener('click',function (e) {
			if (e.target.closest('.innerTabButton')) {
				openInnerTab(e.target.closest('.innerTabButton'));
			}
			if (e.target.closest('.showModal')) {
				showModal(e.target.closest('.showModal'));
			}
			if (e.target.closest('.closeModal')) {
				closeModal(e.target.closest('.closeModal'));
			}
			if (e.target.closest('.editRental')) {
				editRental(e.target.closest('.editRental'));
			}
			if (e.target.closest('.editStandalone')) {
				editStandalone(e.target.closest('.editStandalone'));
			}
			if (e.target.closest('.editHostel')) {
				editHostel(e.target.closest('.editHostel'));
			}
			if (e.target.closest('.editWorkspace')) {
				editWorkspace(e.target.closest('.editWorkspace'));
			}
			if (e.target.closest('.editCommunity')) {
				editCommunity(e.target.closest('.editCommunity'));
			}
			if (e.target.closest('.editProfile')) {
				editProfile(e.target.closest('.editProfile'));
			}
			if (e.target.closest('.createRentalButton')) {
				rentalDropzone.processQueue();
			}
			if (e.target.closest('.createStandaloneButton')) {
				standaloneDropzone.processQueue();
			}
			if (e.target.closest('.createWorkspaceButton')) {
				workspaceDropzone.processQueue();
			}
			if (e.target.closest('.createHostelButton')) {
				hostelDropzone.processQueue();
			}
			if (e.target.closest('.createCommunityButton')) {
				communityDropzone.processQueue();
			}
			if (e.target.closest('#back')) {
				let bton = e.target.closest('#back').dataset.previoustab;
				console.log(bton);
				document.querySelector(bton).click();
			}
			if (e.target.closest('.choose_community')) {
				show_communities(e.target.closest('.choose_community'));
			}
			if (e.target.closest('.show_bookings')) {
				show_data(e.target.closest('.show_bookings'));
			}
			if (e.target.closest('.show_units')) {
				show_data(e.target.closest('.show_units'));
			}
			if (e.target.closest('.changeImage')) {
				chooseImage(e.target.closest('.changeImage'));
			}
			if (e.target.closest('.addImage')) {
				chooseImage(e.target.closest('.addImage'));
			}
			if (e.target.closest('.imageDeleteButton')) {
				deletePropertyImage(e.target.closest('.imageDeleteButton'));
			}
			if (e.target.closest('.propertyDeleteButton')) {
				deleteProperty(e.target.closest('.propertyDeleteButton'));
			}
			if (e.target.closest('a.page-link')) {
				e.preventDefault();
				ajaxPagination(e.target.closest('a.page-link'));
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
document.getElementById('rentalsTabButton').click();


// const observer = lozad('.lozad',{
// 	threshold:0.5
// });
// observer.observe();
