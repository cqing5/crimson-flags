const showHideButton = document.querySelector(".showHideMobile");
const leftMenu = document.querySelector(".leftChatPage");

showHideButton.addEventListener("click", function () {
  this.classList.toggle("isON");
  leftMenu.classList.toggle("isON");
});

const viewImageButton = document.querySelector('.view-image');
const modalPopup = document.querySelector('.modal-popup');

viewImageButton.addEventListener("click", function () {
  console.log('isworking');
  modalPopup.classList.add('active');
});

modalPopup.addEventListener("click", function () {
  modalPopup.classList.remove('active');
});