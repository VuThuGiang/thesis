
// swiper----------------------------------------->
var swiper = new Swiper(".mySwiper", {
  slidesPerView: 3,
  spaceBetween: 30,
  autoplay: {
    delay: 2000,
    disableOnInteraction: false
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});



// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
document.addEventListener('DOMContentLoaded', function () {
  let toggle = document.querySelector(".toggle");
  let navigation = document.querySelector(".navigation");
  let main = document.querySelector(".main");

  if (toggle) {
    toggle.onclick = function () {
      if (navigation) {
        navigation.classList.toggle("active");
      }
      if (main) {
        main.classList.toggle("active");
      }
    };
  } else {
    console.error("Element with class 'toggle' not found");
  }
});

