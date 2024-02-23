const currentInboxButton = document.querySelector(".inbox-button");
const currentInbox = document.querySelector(".currentInboxMatchWrapper");
const requestButton = document.querySelector(".request-button");
const requests = document.querySelector(".requestsMatchWrapper");
const showHideButton = document.querySelector(".showHideMobile");
const leftMenu = document.querySelector(".leftChatPage");

currentInboxButton.addEventListener("click", function () {
  currentInbox.classList.remove("disabled-menu");
  requestButton.classList.remove("is-active");
  currentInboxButton.classList.add("is-active");
  requests.classList.add("disabled-menu");
});

requestButton.addEventListener("click", function () {
  currentInbox.classList.add("disabled-menu");
  currentInboxButton.classList.remove("is-active");
  requestButton.classList.add("is-active");
  requests.classList.remove("disabled-menu");
});

showHideButton.addEventListener("click", function () {
  this.classList.toggle("isON");
  leftMenu.classList.toggle("isON");
});

//fix scroll position to always start at bottom
document.querySelector('.rightChatPageMessages').scrollTop = document.querySelector('.rightChatPageMessages').scrollHeight;

const emojiKeyboard = document.querySelector('.emojiKeyboard');
const emojiKeyboardContainer = document.querySelector('.emojiKeyboardMenu');
const emojiHolderContainer = document.querySelector('.emojiHolder');

let listEmoji = ['😀','😃','😄','😁','😆','😅','😂','🤣','😊','😇','🙂','🙃','😉','😌','😍','😘','😗','😙','😚','😋','😛','😝','😜','🤪','🤨','🧐','🤓','😎','🤩','😏','😒','😞','😔','😟','😕','🙁','☹️','😣','😖','😫','😩','😢','😭','😤','😠','😡','🤬','🤯','😳','😱','😨','😰','😥','😓','🤗','🤔','🤭','🤫','🤥','😶','😐','😑','😬','🙄','😯','😦','😧','😮','😲','🥱','😴','🤤','😪','😵','🤐','🤢','🤮','🤧','😷','🤒','🤕','🤑','🤠','😈','👿','👹','👺','🤡','💩','👻','💀','☠️','👽','👾','🤖','🎃','😺','😸','😹','😻','😼','😽','🙀','😿','😾'];
let ourHtml = "";

listEmoji.forEach(element => {
  ourHtml += `<p class='emojiButton' data-emoji='${element}'>${element}</p>`;
});
emojiHolderContainer.innerHTML += ourHtml;


const allClickableEmojiButton = document.querySelectorAll(".emojiButton");
const textArea = document.getElementById('inputBarBottomText');

allClickableEmojiButton.forEach(button =>{
  button.addEventListener("click", ()=>{
    textArea.value += (button.dataset.emoji);
  })
})

textArea.addEventListener("click",()=>{
  emojiKeyboardContainer.classList.add('hideEmoji');
})


emojiKeyboard.addEventListener("click", ()=>{
  emojiKeyboardContainer.classList.toggle('hideEmoji');
})

const likeButton = document.querySelector('.likeButton');

likeButton.addEventListener("click", ()=>{
  textArea.value = ":like:";
  document.getElementById('send').click();

})


// Execute a function when the user releases a key on the keyboard
textArea.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  let key = window.event.keyCode;
  if (key === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("send").click();
  }
});