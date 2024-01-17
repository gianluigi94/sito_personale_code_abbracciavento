// var bottone = document.getElementById('cambiaColore');
// var cliccato = false;

// if (localStorage.getItem('btnClicked')) {
//   cliccato = true;
//   bottone.classList.add('green');

//   document.querySelector('.animate').style.clipPath = 'circle(100%)';
//   document.querySelector('.sun').style.transform = 'scale(1) rotate(360deg)';
//   document.querySelector('.mun').style.transform = 'scale(0) rotate(360deg)';

// }

// bottone.addEventListener('click', function() {
//   if (cliccato) {
//     this.classList.remove('green');
//     localStorage.removeItem('btnClicked');

//     document.querySelector('.animate').style.clipPath = 'circle(0% at 0% 0%)';
//     document.querySelector('.animate').style.transition = 'clip-path 1.5s ease-out';
//     document.querySelector('.sun').style.transform = 'scale(0)';
//     document.querySelector('.sun').style.transition = 'transform 1.8s ease';

//     document.querySelector('.mun').style.transform = 'scale(1)';
//     document.querySelector('.mun').style.transition = 'transform 1.8s ease';

//   } else {
//     this.classList.add('green');
//     localStorage.setItem('btnClicked', 'true');

//     document.querySelector('.animate').style.clipPath = 'circle(100% at center)';


//     document.querySelector('.animate').style.transition = 'clip-path 1.5s ease-out';

//     document.querySelector('.sun').style.transform = 'scale(1) rotate(360deg)';
//     document.querySelector('.sun').style.transition = 'transform 1.8s ease';

//     document.querySelector('.mun').style.transform = 'scale(0) rotate(360deg)';
//     document.querySelector('.mun').style.transition = 'transform 1.8s ease';

//   }
//   cliccato = !cliccato;
// });

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
  element.src = "assets/nero.png";
}

function restoreImage(element) {
  element.src = "assets/bianco.png";
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

// var coloreCorrente = localStorage.getItem('colore') || 'whbl';
//     applicaColore();

//     function cambiaCol() {
//       var elementiBianchi = document.querySelectorAll('.whbl');

//       elementiBianchi.forEach(function(elemento) {
//         elemento.style.transition = "color 2s";
//         if (coloreCorrente === 'whbl') {
//           elemento.style.color = "#111111";
//         } else {
//           elemento.style.color = "#ffffff";
//         }
//       });

    //   coloreCorrente = (coloreCorrente === 'whbl') ? '#111111' : 'whbl';
    //   localStorage.setItem('colore', coloreCorrente);
    // }

    // function applicaColore() {
    //   var elementiBianchi = document.querySelectorAll('.whbl');

    //   elementiBianchi.forEach(function(elemento) {
    //     elemento.style.transition = "color 2s";
    //     if (coloreCorrente === 'whbl') {
    //       elemento.style.color = "#ffffff";
    //     } else {
    //       elemento.style.color = "#111111";
    //     }

    
    //     elemento.addEventListener('mouseenter', function() {
    //       elemento.style.color = "#088b17"; // Colore durante l'hover
          
    //     elemento.style.transition = "color 0.4s";

    //     });

    //     elemento.addEventListener('mouseleave', function() {
    //       // Ripristina il colore in base alla variabile di stato corrente
    //       if (coloreCorrente === 'whbl') {
    //         elemento.style.color = "#ffffff";
        

    //       } else {
    //         elemento.style.color = "#111111";
    //       }
    //     });
    //   });
    // }

   

