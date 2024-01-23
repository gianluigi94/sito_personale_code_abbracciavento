
var mainImages = document.getElementsByClassName("mainImage");

for (var i = 0; i < mainImages.length; i++) {
  mainImages[i].addEventListener("mouseover", function() {
    changeImage(this);
  });

  mainImages[i].addEventListener("mouseout", function() {
    restoreImage(this);
  });
}

function changeImage(element) {
  element.src = "assets/logonero.png";
}

function restoreImage(element) {
  element.src = "assets/logobianco.png";
}


document.addEventListener("DOMContentLoaded", function () {

  var navProgect = document.querySelector('.navprogect');


  navProgect.addEventListener('click', function () {

    var sottomini = document.querySelector('.sottomini');


    sottomini.style.display = (sottomini.style.display === 'block') ? 'none' : 'block';
  });
});

document.addEventListener("DOMContentLoaded", function () {
  var navProgect = document.querySelector('.navprogect');
  var sottomini = document.querySelector('.sottomini');


  sottomini.style.height = '0';

  navProgect.addEventListener('click', function () {
    sottomini.style.height = sottomini.style.height === '0px' ? sottomini.scrollHeight + 'px' : '0';


  });

});


const menuIcon = document.querySelector('.hamburgermenu');
const navbar = document.querySelector('.navbar');
menuIcon.addEventListener('click', () => {
  navbar.classList.toggle("change");
});


   

