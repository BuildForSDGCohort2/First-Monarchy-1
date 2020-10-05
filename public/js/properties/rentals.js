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
   lazy:true,
   slidesPerView: 1,
   spaceBetween: 30,
   loop: true,
   pagination: {
     el: '.swiper-pagination',
     // dynamicBullets: true,
     clickable: true,
   },
   navigation: {
     nextEl: '.swiper-button-next',
     prevEl: '.swiper-button-prev',
   },
 });
function formatCurrency(element) {
  let price = Intl.NumberFormat('en-US',{
    style:'currency',
    currency:'Ksh',
    minimumFractionDigits:0,
  });
  console.log(price.format);
   element.textContent = price.format(element.textContent);
}
document.querySelectorAll('.price').forEach(function (el) {
  formatCurrency(el);
});

//Clickable Units
function clickable(clickable) {
    clickable.querySelector('.hiddenLink').click();
}

Notiflix.Notify.Init({
		useGoogleFont:false,
		fontFamily:'Nunito',
    messageFontSize:'16px',
});
Notiflix.Loading.Init({
  useGoogleFont:false,
  fontFamily:'Nunito',
});
Notiflix.Confirm.Init({
  useGoogleFont:false,
  fontFamily:'Nunito',
});
var overlay = document.querySelector('.overlay');
function showModal(button) {
  if (button.classList.contains('loggedIn')) {
    let id = button.dataset.id;
    let modal = document.getElementById(id);
    console.log(modal);
    // modal.style.visibility = 'visible';
    modal.style.maxHeight = '100%';
    modal.style.height = '80%';
    // document.body.style.overflow = 'hidden';
    overlay.style.display = 'flex';
  }
  else {
    document.querySelector('.dummyForm').submit();
  }
}

function closeModal(button) {
  let id = button.dataset.id;
  let modal = document.getElementById(id);
  console.log(modal);
  modal.style.height = 0;
  modal.style.maxHeight = 0;
  // document.body.style.overflow = 'auto';
  overlay.style.display = 'none';
    // modal.style.visibility = 'hidden';
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

function book(book_button) {
  if (book_button.classList.contains('booked')) {
        Notiflix.Report.Info(
          'Already Booked',
          'You have already booked a unit of this property',
          'close'
        );
  }
  else{
    if(book_button.classList.contains('loggedIn')) {
      if (book_button.classList.contains('noUnitsAvailable')) {
            Notiflix.Report.Info(
              'Fully Occupied',
              'Sorry,this property has no units available,its fully occupied.',
              'close'
            );
      }
      else{
          let url = book_button.dataset.url;
          let config = {
            baseURL:'http://127.0.0.1:8000/',
          };
          Notiflix.Loading.Pulse('Booking...');
          axios.post(url,config)
          .then(function (response) {
            Notiflix.Loading.Remove();
            Notiflix.Report.Success(
              'Booking succesful',
              'You have booked 1 unit of this property.',
              'close',
              function () {
                window.location.reload();
              }
            );
          })
          .catch(function (error) {
            Notiflix.Loading.Remove();
            Notiflix.Report.Failure(
              'Something went wrong',
              'Were sorry we could not make your booking.',
              'close'
            );
          })
      }
    }
    else{
          book_button.closest('.bookform').submit();
    }
  }
}
function schedule_visit(button,selectionInfo) {
    let url = button.dataset.url;
    axios.post(url,{
      start:selectionInfo.startStr,
      end:selectionInfo.endStr,
    })
    .then(function (response) {
      console.log(response);
      Notiflix.Report.Success(
        'Visit Scheduled',
        'Visit has been successfully scheduled',
        'close'
      );
    })
    .catch(function (error) {
      console.log(error);
      Notiflix.Report.Failure(
        'Something went wrong',
        'Visit has not been scheduled',
        'close'
      );
    });
}
document.addEventListener('DOMContentLoaded',function () {
  let calendarEl = document.getElementById('calendar');
  let schedule_button = document.querySelector('.scheduleButton');
  let calendar = new FullCalendar.Calendar(calendarEl,{
    plugins:['timeGrid','interaction'],
    // dateClick:function (dateClickInfo) {
    //   console.log(dateClickInfo);
    // },
    visibleRange:{
      start:Date.now(),
    },
    selectable:true,
    selectOverlap:false,
    selectConstraint:[
      {
      startTime:'08:00',
      endTime:'10:00',
    },
    {
      startTime:'10:00',
      endTime:'12:00',
    },
    {
      startTime:'12:00',
      endTime:'14:00',
    },
    {
      startTime:'14:00',
      endTime:'17:00',
    }
  ],
    select:function (selectionInfo) {
      console.log(selectionInfo);
      Notiflix.Confirm.Show(
        'Confirm Selected Time',
        `${selectionInfo.start} to ${selectionInfo.end}`,
        'Confirm',
        'Cancel',
        function () {
          schedule_visit(schedule_button,selectionInfo);
        },
        function () {

        }
       );
    },
    header:{
      left:'title',
      center:'today',
      right:'prev,next',
    },
    views:{
      timeGrid:{
        // weekends:false,
        hiddenDays:[0],
        allDaySlot:false,
        nowIndicator:true,
        slotDuration:'02:00:00',
        minTime:'8:00:00',
        maxTime:'17:00:00',
      },
    },
    height:'auto',
    defaultView:'timeGridWeek',
    validRange:function (nowDate) {
      return{
        start:Date.now(),
      };
    },
    events:
      {
      url:schedule_button.dataset.url,
      editable:false,
      overlap:false,
    },
    eventRender:function (info) {
      // info.el.textContent = "unavailable";
      info.el.style.color = 'red';
      info.el.style.fontWeight = 'bold';
      info.el.style.background = 'repeating-linear-gradient(20deg,#fff,#fff, 5px,#9f9f9f 5px, #9f9f9f 10px)';
    },
  });
  calendar.render();
});
function attach_listeners() {
  document.addEventListener('click',function (e) {
    if (e.target.closest('.checkbox')) {
      e.stopPropagation();
      e.preventDefault();
      updateWishlist(e.target.closest('.checkbox'))
    }
    if (e.target.closest('.unitContainer')) {
      clickable(e.target.closest('.listing'));
    }
    if (e.target.closest('.showModal')) {
      showModal(e.target.closest('.showModal'));
    }
    if (e.target.closest('.closeModal')) {
      closeModal(e.target.closest('.closeModal'));
    }
    if (e.target.closest('.book_button')) {
      e.preventDefault();
      book(e.target.closest('.book_button'));
    }
  });
}
attach_listeners();
