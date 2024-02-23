console.log("js Working");

//popup
const modal = document.querySelector(".modal");
const modalOpenButton = document.querySelector(".matchOnInfo");

modalOpenButton.addEventListener("click", () => {
  console.log("test");
  modal.classList.add("open");
});

modal.addEventListener("click", (e) => {
  if (e.target.classList.contains("modal")) {
    modal.classList.remove("open");
  }
});
