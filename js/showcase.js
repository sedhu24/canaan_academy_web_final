
var onScrollHandler = function () {
  let myElem = document.getElementById('logo')
  document.getElementById('nav-menu').style.height = "95px"
  var newImageUrl = myElem.src;
  var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
  if (scrollTop < 200) {
    newImageUrl = "../Images/logo.webp"
    myElem.style.height = "140px"
    myElem.style.transition = ".5s ease-out"
  }
  if (scrollTop > 200) {
    newImageUrl = "../Images/logo.webp"
    myElem.style.height = "104px"
    myElem.style.transition = ".5s ease-out"

  }
  myElem.src = newImageUrl;
};
document.addEventListener("scroll", onScrollHandler);

//actvie nav

document.addEventListener("DOMContentLoaded", function () {
  var currentPath = window.location.pathname.split("/");
  currentPath = currentPath[2];

  var anchors = document.querySelectorAll(".nav-item .nav-link");

  document.querySelectorAll(".nav-item .nav-link").forEach(function (activeAnchor) {
    activeAnchor.classList.remove("active");
  });

  anchors.forEach(function (anchor) {
    var anchorPath = new URL(anchor.href).pathname.split("/");
    anchorPath = anchorPath[2];

    if (anchorPath === currentPath) {
      anchor.classList.add("active");
    }
  });
});