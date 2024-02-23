const showHideButton = document.querySelector(".showHideMobile");
const leftMenu = document.querySelector(".leftChatPage");

showHideButton.addEventListener("click", function () {
  this.classList.toggle("isON");
  leftMenu.classList.toggle("isON");
});
