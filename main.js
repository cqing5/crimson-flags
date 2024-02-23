// Wrap every letter in a span
var textWrapper = document.querySelector('.animatedTitle .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: false})
  .add({
    targets: '.animatedTitle .letter',
    translateY: ["1.1em", 0],
    translateX: ["0.55em", 0],
    translateZ: 0,
    rotateZ: [180, 0],
    duration: 750,
    easing: "easeOutExpo",
    delay: (el, i) => 50 * i
  }).add({
    targets: '.animatedTitle',
    duration: 1000,
    easing: "easeOutExpo",
    delay: 2000
  });


  // Wrap every letter in a span
var textWrapper = document.querySelector('.ml6 .letters2');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter2'>$&</span>");

setTimeout(() => {anime.timeline({loop: false})
  .add({
    targets: '.ml6 .letter2',
    translateY: ["1.2em", 0],
    translateZ: 0,
    opacity: 1,
    duration: 700,
    delay: (el, i) => 50 * i
  }).add({
    targets: '.ml6',
    duration: 1000,
    opacity: 1,
    easing: "easeOutExpo",
    delay: 1000
  })}, 1000);