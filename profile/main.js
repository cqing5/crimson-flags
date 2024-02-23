console.log("js Working");

//popup verify
let verifyPopup = document.getElementsByClassName('verifyAccount');
if (verifyPopup.length > 0) {


  const verify = document.querySelector(".verify");
  const verifyOpenButton = document.querySelector(".verifyAccount");


  verifyOpenButton.addEventListener("click", () => {
    console.log("test");
    verify.classList.add("open");
  });

  verify.addEventListener("click", (e) => {
    if (e.target.classList.contains("modal")) {
      verify.classList.remove("open");
    }
  });

}


//popup report
let reportPopup = document.getElementsByClassName('reportProfile');
if (reportPopup.length > 0) {


  const report = document.querySelector(".report");
  const reportOpenButton = document.querySelector(".reportProfile");


  reportOpenButton.addEventListener("click", () => {
    console.log("test");
    report.classList.add("open");
  });

  report.addEventListener("click", (e) => {
    if (e.target.classList.contains("modal")) {
      report.classList.remove("open");
    }
  });

}

//popup admin
let adminPopup = document.getElementsByClassName('userPermissions');
if (adminPopup.length > 0) {

  const makeAdmin = document.querySelector(".makeAdmin");
  const adminOpenButton = document.querySelector(".userPermissions");

  adminOpenButton.addEventListener("click", () => {
    console.log("test");
    makeAdmin.classList.add("open");
  });

  makeAdmin.addEventListener("click", (e) => {
    if (e.target.classList.contains("modal")) {
      makeAdmin.classList.remove("open");
    }
  });

}

//popup basic user
let makeBasic = document.getElementsByClassName('makeBasicUserType');
if (makeBasic.length > 0) {

  const makeBasicUSer = document.querySelector(".makeBasicUser");
  const basicOpenButton = document.querySelector(".makeBasicUserType");

  basicOpenButton.addEventListener("click", () => {
    console.log("test");
    makeBasicUSer.classList.add("open");
  });

  makeBasicUSer.addEventListener("click", (e) => {
    if (e.target.classList.contains("modal")) {
      makeBasicUSer.classList.remove("open");
    }
  });

}

//popup review
let reviewPopup = document.getElementsByClassName('reviewUser');
if (reviewPopup.length > 0) {


  const review = document.querySelector(".modalReview");
  const reviewOpenButton = document.querySelector(".reviewUser");


  reviewOpenButton.addEventListener("click", () => {
    console.log("test");
    review.classList.add("open");
  });

  review.addEventListener("click", (e) => {
    if (e.target.classList.contains("modal")) {
      review.classList.remove("open");
    }
  });

}