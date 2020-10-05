function clickable(clickable) {
  var arrayOfClickables = document.querySelectorAll(clickable);

  for (var i = 0; i < arrayOfClickables.length; i++) {
    arrayOfClickables[i].addEventListener('click',function (e) {
      e.currentTarget.querySelector('.hiddenLink').click();
    });
  }
}
clickable('.category');
