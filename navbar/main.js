const hamburger = document.querySelector(".hamburger");
const mobileMenu = document.querySelector(".mobile-menu");
const notificationClose = document.querySelector(".notificationClose");
const notificationOpen = document.querySelector(".notification-icon");
const notification = document.querySelector(".notificationDropdown");
const notificationDropdownTriangle = document.querySelector(
  ".notificationDropdownTriangle"
);

hamburger.addEventListener("click", function () {
  this.classList.toggle("is-active");
  mobileMenu.classList.toggle("is-active");
  notification.classList.remove("isActive");
  notificationDropdownTriangle.classList.remove("isActive");
});

notificationOpen.addEventListener("click", function () {
  notification.classList.toggle("isActive");
  notificationDropdownTriangle.classList.toggle("isActive");
  hamburger.classList.remove("is-active");
  mobileMenu.classList.remove("is-active");
});

notificationClose.addEventListener("click", function () {
  notification.classList.remove("isActive");
  notificationDropdownTriangle.classList.remove("isActive");
});
