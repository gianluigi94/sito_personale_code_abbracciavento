//In questa pagina gestisco la maggior parte del js.

//questa classe serve per gestire la comparsa degli elementi con lo scroll o al caricamento della pagina
class GestoreVisualizzazione {
  /**
   * Mostra un elemento spostandolo in posizione visibile attraverso una trasformazione CSS.
   * @param string
   */
  mostraDiv(selector) {
      const elemento = document.querySelector(selector);
      if (elemento) {
          elemento.style.transform = 'translateX(0)';
      }
  }
  /**
   * Mostra un elemento girandolo in posizione visibile attraverso una trasformazione CSS.
   * @param string
   */
   mostraElementi(selector) {
    document.querySelectorAll(selector).forEach((element) => {
      if (element) {
        element.style.transform = "translateX(0)";
        element.style.opacity = 1;
      }
    });
  }
   
   
  /**
   * Mostra un elemento spostandolo in posizione visibile attraverso una trasformazione CSS.
   * @param string
   */
  revealOnScrollImgCon(selector) {
    if (!document.body.classList.contains("scroll")) {
      return;
    }
    const elements = document.querySelectorAll(selector);
    const windowHeight = window.innerHeight;
    elements.forEach((element) => {
      const elementTop = element.getBoundingClientRect().top;
      if (
        elementTop < windowHeight - 100 &&
        elementTop + element.offsetHeight > 0
      ) {
        element.style.opacity = 1;
        element.style.transform = "rotate(0deg)";
      } else {
        element.style.opacity = 0;
        element.style.transform = "rotate(-2deg)";
      }
    });
  }
/**
   * Mostra un elemento spostandolo e roteandolo in posizione visibile attraverso una trasformazione CSS.
   * @param string
   */
  revealOnScrollH3(title) {
    if (!document.body.classList.contains("scroll")) {
      return;
    }
  
    const elements = document.querySelectorAll(title);
    const windowHeight = window.innerHeight;
  
    elements.forEach((element) => {
      const elementTop = element.getBoundingClientRect().top;
      if (elementTop <= windowHeight - 100) {
        element.style.transform = "translateX(0)";
        element.style.opacity = 1;
      }
    });
  }

  
  /**
   * Mostra un elemento spostandolo in posizione visibile attraverso una trasformazione CSS.
   * @param string
   */
  revealOnScroll(selector) {
    if (!document.body.classList.contains("scroll")) {
      return;
    }
  
    const elements = document.querySelectorAll(selector );
    const windowHeight = window.innerHeight;
  
    elements.forEach((element, index) => {
      if (index === 0 && element.classList.contains("conteinerdue")) return;
  
      const elementTop = element.getBoundingClientRect().top;
      if (elementTop < windowHeight - 100) {
        element.style.transform = "translateX(0)";
        element.style.opacity = 1;
      }
    });
  }
}

const gestore = new GestoreVisualizzazione();

// queste sono le funzioni che permettono al logo del sito di scomparire dopo il caricamento della pagina. Oltre alla scomparsa del logo permette anche di poter scorrere il sito(durante il caricamento è bloccato). Solo dopo che lo schermo è visibile partono le varie animazioni.

function load() {
  setTimeout(function () {
    loader.style.display = "none";
    document.body.classList.add("scroll");
    document.body.classList.remove("noscroll");
    gestore.revealOnScroll(".conteinerdue, .description, .secondCol iframe");
    setTimeout(() => gestore.revealOnScrollH3(".newtonh3")); 
  }, 1000);
};

window.addEventListener("load", function () {
  const loader = document.getElementById("loader");
  setTimeout(function () {
    if (loader) {
      loader.style.display = "none";
    }
    gestore.mostraDiv('.conteinerdue');
    gestore.revealOnScrollImgCon(".imgCon, aside");

    gestore.mostraElementi("h1");
    setTimeout(function () {
      gestore.mostraElementi("h2");
    }, 600); //gli elementi appaiono con tempi diversi

    const paragraphs = document.querySelectorAll(".uno p");
    paragraphs.forEach((p, index) => {
      setTimeout(() => {
        p.style.opacity = 1;
      }, 200 * index);
    });
  }, 1200);
  load();
});

const loader = document.getElementById("loadingPage");
//richiamo le funzioni
window.addEventListener("scroll", () => gestore.revealOnScrollImgCon(".imgCon, aside"));
window.addEventListener("scroll",() => gestore.revealOnScrollH3(".newtonh3"));
window.addEventListener("scroll",() => gestore.revealOnScrollH3(".newtonh3"));
window.addEventListener("scroll",() => gestore.revealOnScroll(".conteinerdue, .description, .secondCol iframe"));
// questa è la funzione per la comparsa e scomparsa dello sfondo del menù dovuto al fatto se si sta scrollando o ci si trova in cima alla pagina
window.addEventListener('load', function() {
  const nav = document.querySelector(".navbigTwo");

  // Imposta l'opacità in base alla posizione di scroll corrente alla pagina caricata
  if (window.scrollY > 0) {
      nav.style.opacity = "1";
  } else {
      nav.style.opacity = "0";
  }

  // Aggiungi il listener per l'evento di scroll
  window.addEventListener("scroll", function () {
      if (window.scrollY > 0) {
          nav.style.opacity = "1";
      } else {
          nav.style.opacity = "0";
      }
  });
});

// funzione autoplay per video youtube
window.addEventListener('load', function() {
  const youtubeVideo = document.getElementById('youtubeVideo');

  // verifico se l'elemento esiste per evitare errori in console
  if (!youtubeVideo) {
      return; 
  }

  const offset = 250; // distanza sopra elemento

  //controllo la visibilità del video nello schermo
  function isElementInViewport(el) {
      const rect = el.getBoundingClientRect();
      return (
          rect.top >= -offset && // controllo se è abbastanza vicino
          rect.left >= 0 &&
          rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) + offset &&
          rect.right <= (window.innerWidth || document.documentElement.clientWidth)
      );
  }

  function addAutoplay() { // inserisco autoplay se è vicino
      let src = youtubeVideo.getAttribute('src');
      if (!src.includes('autoplay=1')) {
          src += (src.includes('?') ? '&' : '?') + 'autoplay=1';
          youtubeVideo.setAttribute('src', src);
      }
  }

  function handleScroll() {
      if (isElementInViewport(youtubeVideo)) {
          addAutoplay();
          window.removeEventListener('scroll', handleScroll);
      }
  }

  // controllo iniziale se mi trovo a metà pagina al caricamento
  if (isElementInViewport(youtubeVideo)) {
      addAutoplay();
  }


  window.addEventListener('scroll', handleScroll);
});


//funzione per ricaricare la pagina al click dell'accettazione di yubenda, mi dava problemi con alcuni elementi premere su quel bottone e ricaricare la pagina è la soluzione migliore
window.addEventListener('load', function() {
  const iubendaButton = document.querySelector('.iubenda-cs-accept-btn.iubenda-cs-btn-primary');
  if (iubendaButton) {
      iubendaButton.addEventListener('click', function() {
          location.reload(); // Ricarica la pagina quando il pulsante viene cliccato
      });
  }
});




//funzione per il movimento delle svg nello sfondo
function handleScrollAnimation() {
  const cls1 = document.querySelector(".cls-1");
  const cls3 = document.querySelector(".cls-3");
  if (!cls1 || !cls3) {
    return; 
  }
// calcolo posizione scroll
  const maxScroll = document.body.scrollHeight - window.innerHeight;
  const scrollPosition = window.scrollY;
  const pathLength = 400; //lunghezza scroll
  const newOffset = pathLength - (scrollPosition / maxScroll) * pathLength; //movimento in base a quanto l'utente ha effetivamente scrollato
  //comparsa del disegno
  cls1.style.strokeDashoffset = newOffset;
  cls3.style.strokeDashoffset = newOffset;
}

window.addEventListener("scroll", handleScrollAnimation);






//codice per la gestione del popup e delle immagini che mostra
document.addEventListener("DOMContentLoaded", function () {
  if (!document.querySelector(".popup") || !document.querySelector(".imgCon img")) {
    return; // Se non ci sono elementi popup o immagini, esce dalla funzione
  }
  const images = Array.from(document.querySelectorAll(".imgCon img")); //creo un array che contiene tutte li immagine all'interno dei div imgCon
  let currentIndex = 0; //l'indice è a 0
  const popup = document.querySelector(".popup");
  const popupImg = document.querySelector(".popup .largeImg");
  const popupDes = document.querySelector(".popup .descritionPop");
  const imageName = document.querySelector(".immageNamePop");
  const leftArrow = document.querySelector(".arrowLeft");
  const rightArrow = document.querySelector(".arrowRight");
  
  
  let progettiTitolo = titoliFromPHP; 
  let progettiParagrafo = descrizioniFromPHP;


    //questa funzione fa sparire la freccia sinistra o destra se si è arrivati alla prima o ultima immagine 
    function updateArrows() {
      leftArrow.style.display = currentIndex > 0 ? "" : "none";
      rightArrow.style.display = currentIndex < images.length - 1 ? "" : "none";
    }

    //definisco cosa visualizzano i vari elementi del popup
    function updatePopupImage(src, title, description) {
      popupImg.src = src;
      imageName.textContent = title; 
      popupDes.textContent = description; 
    }
  
  //questa è la funzione che fa aprire il popup cliccando sopra un immagine della galleria
  //inizio con il prendere l'indice specifico dell'array che contiene le immagini
  document.querySelectorAll(".imgCon").forEach((div, index) => {
    div.addEventListener("click", function () {
      currentIndex = index;
      updatePopupImage(
        //seleziono l'elemento corrispondente all'indice delle immagini all'indice dell'array del src, del titolo e delle descrizioni
        images[currentIndex].src,
        progettiTitolo[currentIndex],
        progettiParagrafo[currentIndex]
      );
      popup.classList.add("active");
      updateArrows();
    });
  });

  if (leftArrow) {
    //funzione per scorrere a sinistra quando clicco la freccia sinistra. Cambia index dei vari elementi
    leftArrow.addEventListener("click", function () {
        if (currentIndex > 0) {
            currentIndex--;
            updatePopupImage(
                images[currentIndex].src,
                progettiTitolo[currentIndex],
                progettiParagrafo[currentIndex]
            );
            updateArrows();
        }
    });
}

//funzione per scorrere a destra quando clicco la freccia destra. Cambia index dei vari elementi
if (rightArrow) {
    rightArrow.addEventListener("click", function () {
        if (currentIndex < images.length - 1) {
            currentIndex++;
            updatePopupImage(
                images[currentIndex].src,
                progettiTitolo[currentIndex],
                progettiParagrafo[currentIndex]
            );
            updateArrows();
        }
    });
}

//questa funzione chiude il popup
const closeBtn = document.querySelector(".closeBtn");
if (closeBtn) {
    closeBtn.addEventListener("click", function () {
        popup.classList.remove("active");
    });
}
});




//effetto hover eseguito con js
let mainImages = document.getElementsByClassName("mainImage");
for (let i = 0; i < mainImages.length; i++) {
  mainImages[i].addEventListener("mouseover", function () {
    changeImage(this);
  });
  mainImages[i].addEventListener("mouseout", function () {
    restoreImage(this);
  });
}
function changeImage(element) {
  // funzione per logo che compare
  element.src = "assets/logonero.png";
}
function restoreImage(element) {
  // funzione per logo di default
  element.src = "assets/logobianco.png";
}

//apertura e chiusura del sottomenu
document.addEventListener("DOMContentLoaded", function () {
  let navProgect = document.querySelector(".navprogect");
  let sottomini = document.querySelector(".sottomini");

  sottomini.style.maxHeight = "0px";
  sottomini.style.display = "none"; // all'avio il sotto menu è nascosto
  navProgect.addEventListener("click", function () {
    // se clicco da chiuso si apre, mostra la sua altezza naturale e non è più su none . Se clicco da aperto invece si chiude e scompare
    if (sottomini.style.maxHeight === "0px") {
      sottomini.style.display = "block";

      requestAnimationFrame(() => {
        //codice per permettere al browser di elaborare l'altezza
        sottomini.style.maxHeight = sottomini.scrollHeight + "px";
      });
    } else {
      sottomini.style.maxHeight = "0px";
    }
  });
});

// codice per cambiare classe al menu hamburger e permettere le animazioni
const menuIcon = document.querySelector(".hamburgermenu");
const navbar = document.querySelector(".navbar");
menuIcon.addEventListener("click", () => {
  navbar.classList.toggle("change");
});

