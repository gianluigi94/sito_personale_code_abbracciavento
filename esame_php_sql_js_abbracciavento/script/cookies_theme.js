  //in questa pagina gestisco i cookie e il cambio di tema
  class Theme { 
    constructor() {}
     /**
     * Il Metodo riportato sotto è usato per convertire sostituire una classe con un altra nel cambio tema, senza transizioni o ritardi.
     * @param string selector è il nome del selettore.
     * @param string classToRemove è la classe che tolgo
     * @param string classToAdd è la classe che aggiungo    
     */
    updateElementClasses(selector, classToRemove, classToAdd) {
        document.querySelectorAll(selector).forEach(element => {
            element.classList.remove(classToRemove);
            element.classList.add(classToAdd);
        });
    }

     /**
     * Il Metodo riportato sotto è usato per convertire sostituire una classe con un altra nel cambio tema, con una transizione gestita in js.
     * @param string selector è il nome del selettore.
     * @param string transitionProperty è la proprietà di stile che cambio.
     * @param string transitionTiming è la durata della transizione.
     * @param string classToRemove è la classe che tolgo
     * @param string classToAdd è la classe che aggiungo    
     */
    updateElementStylesClas(selector, transitionProperty, transitionDuration, transitionTiming, classToRemove, classToAdd) {
        document.querySelectorAll(selector).forEach(element => {
            element.style.transition = `${transitionProperty} ${transitionDuration} ${transitionTiming}`;
            element.classList.remove(classToRemove);
            element.classList.add(classToAdd);
        });
    }
    /**
     * Il Metodo riportato sotto è usato per cambiare con una transizione una proprietà css.
     * @param string selector è il nome del selettore.
     * @param string cssProperty è la proprietà di stile che cambio.
     * @param string propertyValue è il valore della proprietà.
     * @param string transitionTime è la durata della transizione.   
     */
    applyCssTransition(selector, cssProperty, propertyValue, transitionTime) {
        document.querySelectorAll(selector).forEach(element => {
            element.style.transition = `${cssProperty} ${transitionTime}`;
            element.style[cssProperty] = propertyValue;
        });
    }
    /**
     * Il Metodo riportato sotto è usato per cambiare una proprietà css, facendo prima scomparire e poi ricomparire l'elemento.
     * @param string selector è il nome del selettore.
     * @param string fadeOutTime è il tempo di scomparsa.
     * @param string newBackground è il nuovo valore della proprietà.
     * @param string fadeInTime è la durata della ricomparsa.   
     * @param string delay è il ritardo tra la scomparsa e la ricomparsa.   
     */
    scomparsaRicomparsa(selector, fadeOutTime, newBackground, fadeInTime, delay) {
        document.querySelectorAll(selector).forEach(element => {
            element.style.transition = `opacity ${fadeOutTime}`;
            element.style.opacity = "0";
    
            setTimeout(() => {
                element.style.background = newBackground;
                element.style.transition = `opacity ${fadeInTime}`;
                element.style.opacity = "1";
            }, delay);
        });
    }

    /**
     * Il Metodo riportato sotto è usato per sostituire una classe, con una transizione, ma poi cambia il valore della transizione.
     * Mi è utile per esempio se c'è una scritta con un hover, dove la transizione css viene sostituita al cambio tema insieme alla transizione dell'hover.
     * @param string selector è il nome del selettore.
     * @param string transitionProperty è la proprietà che cambio.
     * @param string transitionDuration è la durata della transizione.
     * @param string classToRemove è la classe che tolgo
     * @param string classToAdd è la classe che aggiungo   
     * @param string delay è il ritardo tra la scomparsa e la ricomparsa.   
     * @param string newTransitionDuration è la durata della transizione futura.   
     */
    applyTransition(selector, transitionProperty, transitionDuration, classToAdd, classToRemove, delay, newTransitionDuration) {
        document.querySelectorAll(selector).forEach(element => {
            element.style.transition = `${transitionProperty} ${transitionDuration} ease-in-out`;
            element.classList.remove(classToRemove);
            element.classList.add(classToAdd);
    
            setTimeout(() => {
                element.style.transition = `${transitionProperty} ${newTransitionDuration} ease-in-out`;
            }, delay);
        });
    }

     /**
     * Il Metodo riportato sotto è usato per convertire sostituire una classe con un altra nel cambio tema, con un ritardo tra un cambio e l'altro.
     * @param string selector è il nome del selettore.
     * @param string classToRemove è la classe che tolgo
     * @param string classToAdd è la classe che aggiungo 
     * @param string delay è il ritardo tra la scomparsa e la ricomparsa.   
     */
    fadeToggle(selector, classToRemove, classToAdd, delay) {
        document.querySelectorAll(selector).forEach(element => {
            element.style.opacity = "0";
            element.classList.replace(classToRemove, classToAdd);
            setTimeout(() => {
                element.style.opacity = "1";
            }, delay);
        });
    }
}


const themeCk = new Theme();

  document.addEventListener("DOMContentLoaded", function () {
      let theme = getCookie("theme");
      let checkbox = document.getElementById("cHorse");
      let animateBg = document.querySelector(".animateBg");
    
      
      // Applica il tema in base al cookie
      if (theme === "light") {
        checkbox.checked = true;
        animateBg.classList.remove("min");
        animateBg.classList.add("max");
      } else if (theme === "dark") {
        checkbox.checked = false;
        animateBg.classList.add("min");
        animateBg.classList.remove("max");
      }
    
      // Funzione per ottenere il valore di un cookie
    function getCookie(name) {
      let cookieArr = document.cookie.split(";");
      for (let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");
        if (name == cookiePair[0].trim()) {
          return decodeURIComponent(cookiePair[1]);
        }
      }
      return null;
    }  
    
      // Al cambio della checkbox cambiano tutte le proprietà e si imposta il tema del cookie
      checkbox.addEventListener("change", function () {
        if (this.checked) {
          animateBg.style.opacity = "1";
          animateBg.classList.remove("min");
          animateBg.classList.add("max");
          
          themeCk.updateElementClasses(".subMenu li", "hoverDark", "hoverLight");
          themeCk.updateElementClasses(".lOne a", "colorLightSecond", "colorDarkSecond");
          themeCk.updateElementClasses(".navbigTwo", "shadowDarkMenu", "shadowLightMenu");
          themeCk.updateElementClasses(".subMenu", "darkMenuTwo", "lightMenuTwo");
          themeCk.updateElementClasses(".scomparsa", "colorLight", "colorDark");
          themeCk.updateElementClasses(".competenze li", "colorLight", "colorDark");
          themeCk.updateElementClasses(".bordoBianco", "bordoBianco", "bordoNero");
          themeCk.updateElementClasses(".whiteBefore", "whiteBefore", "darkBefore");
          themeCk.updateElementClasses(".spanBord", "borderDark", "borderLight");
          themeCk.updateElementClasses("option", "optionCoockieBlack", "optionCoockieWhite");
          
          themeCk.updateElementStylesClas(".headerContent h1", "color", "1.5s", "ease-in-out", "colorLight", "colorDark" );
          themeCk.updateElementStylesClas(".spieg", "color", "1s", "ease-in-out", "colorLight", "colorDark" );
          themeCk.updateElementStylesClas("legend", "color", "1s", "ease-in-out", "colorLight", "colorDark" );
          themeCk.updateElementStylesClas(".conteinerdue h3", "color", "0.7s", "ease-in-out", "colorLight", "colorDark" );
          themeCk.updateElementStylesClas(".headerContent a", "color", "1.5s", "ease-in-out", "colorLight", "colorDark" );
          themeCk.updateElementStylesClas(".headerContent h2", "color", "1.5s", "ease-in-out", "colorLightSecond", "colorDarkSecond");
          themeCk.updateElementStylesClas(".conteinerdue p", "color", "1.5s", "ease-in-out", "colorLightSecond", "colorDarkSecond");
          themeCk.updateElementStylesClas("fieldset label", "color", "1.5s", "ease-in-out", "colorLightSecond", "colorDarkSecond");
        
          themeCk.applyCssTransition(".description p", "color", "#111111", "1.2s");
          themeCk.applyCssTransition(".lOne", "color", "#111111", "1.5s");
          themeCk.applyCssTransition(".prototipo", "color", "#111111", "2.5s");
          themeCk.applyCssTransition(".descritionPop", "color", "#111111", "1s");
          themeCk.applyCssTransition(".popupS", "background", "#ffffffe9", "2s");
    
          themeCk.scomparsaRicomparsa(".navbarDue", "900ms", "linear-gradient(to right, #e6f1eaf7 0%, #cfe3def0 100%)", "1s", 600 );
          themeCk.scomparsaRicomparsa(".msgBk", "0.4s", "linear-gradient(to right, #52f8a016, #369a5714)", "1s", 400 );
          themeCk.scomparsaRicomparsa(".proBack", "0.4s", "linear-gradient(to right, #52f8a016, #369a5714)", "1s", 400 );
          themeCk.scomparsaRicomparsa(".pCookies ", "0.4s", "linear-gradient(to right, #52f8a016, #369a5714)", "1s", 400 );
          themeCk.scomparsaRicomparsa(".pCookiesDue", "0.4s", "linear-gradient(to right, #52f8a016, #369a5714)", "1s", 400 );
          themeCk.scomparsaRicomparsa(".pCookiesTre", "0.7s", "linear-gradient(to right, #52f8a016, #369a5714)", "1s", 400 );
          themeCk.scomparsaRicomparsa(".pCookiesQuattro", "0.7s", "linear-gradient(to right, #52f8a016, #369a5714)", "1s", 400 );
          themeCk.scomparsaRicomparsa(".imgCon span", "0.7s", "linear-gradient(to right, #52f8a016, #369a5714)", "0.7s", 200 );
          themeCk.scomparsaRicomparsa(".imgCo", "0.6s", "linear-gradient(to right, #52f8a016, #369a5714)", "1.5s", 300 );
          themeCk.scomparsaRicomparsa(".click", "0.6s", "linear-gradient(to right, rgba(235, 244, 223, 0.936) 0%, rgba(210, 222, 197, 0.922) 100%)", "1.5s", 700 );
          
          themeCk.applyTransition(".ttprogect h3", "color", "1.5s", "colorDark", "colorLight", 10, "0.3s" );
          themeCk.applyTransition(".text", "color", "1.5s", "colorDark", "colorLight", 10, "0.3s" );
          themeCk.applyTransition("aside a", "color", "1.5s", "darkGreen", "whiteGreen", 1500, "" );
        
          themeCk.fadeToggle(".inputBkDark", "inputBkDark", "inputBkLight", 500);
          themeCk.fadeToggle(".inputBkDarkInv", "inputBkDarkInv", "inputBkLightInv", 600);
    
          //questa è la funzione che gestisce il cambio del colore della barra del menu dove imposto anche il fatto che se non ho scrollato non si deve vedere
          document.querySelectorAll(".navbigTwo").forEach((a) => {
            a.style.transition = "opacity 900ms";
            a.style.opacity = "0";
    
            setTimeout(() => {
              a.style.background =
                "linear-gradient(to right, #f5fffcf1,#f5fffcf1, #b2cfb9f1,#b2cfb9f1,#d4e2def1,#d4e2def1 )";
              a.style.transition = "opacity 1s";
              a.style.opacity = "1";
              if (window.scrollY == 0) {
                a.style.opacity = "0"; 
              }
            }, 800);
          });
    
          //metodo particolari per elementi che hanno hover
          document.querySelectorAll(".aStyle").forEach((a) => {
            a.style.transition = "color 1s ease";
    
            a.classList.add("hoD");
            a.classList.remove("hoL");
    
            a.addEventListener(
              "transitionend",
              function () {
                a.style.transition = "";
              },
              { once: true }
            ); 
          });
    
    
          theme = "light";
    // ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE ELSE 
        } else {
          animateBg.classList.add("min");
          animateBg.classList.remove("max");
          setTimeout(() => {
            animateBg.style.opacity = "0";
        }, 500);
    
          themeCk.updateElementClasses("option", "optionCoockieWhite", "optionCoockieBlack");      
          themeCk.updateElementClasses(".spanBord", "borderLight", "borderDark");
          themeCk.updateElementClasses(".competenze li", "colorDark", "colorLight");
          themeCk.updateElementClasses(".bordoNero", "bordoNero", "bordoBianco");
          themeCk.updateElementClasses(".darkBefore", "darkBefore", "whiteBefore");
          themeCk.updateElementClasses(".scomparsa", "colorDark", "colorLight");
          themeCk.updateElementClasses(".subMenu li", "hoverLight", "hoverDark");
          themeCk.updateElementClasses(".navbigTwo", "shadowLightMenu", "shadowDarkMenu");
          themeCk.updateElementClasses(".subMenu", "lightMenuTwo", "darkMenuTwo");
          themeCk.updateElementClasses(".lOne a", "colorDarkSecond", "colorLightSecond");
    
          themeCk.updateElementStylesClas("fieldset label", "color", "1.5s", "ease-in-out", "colorDarkSecond", "colorLightSecond" );
          themeCk.updateElementStylesClas(".headerContent h2", "color", "1.5s", "ease-in-out", "colorDarkSecond", "colorLightSecond" );
          themeCk.updateElementStylesClas(".conteinerdue p", "color", "1.5s", "ease-in-out", "colorDarkSecond", "colorLightSecond" );
          themeCk.updateElementStylesClas(".conteinerdue h3", "color", "1.5s", "ease-in-out", "colorDark", "colorLight" );
          themeCk.updateElementStylesClas("legend", "color", "1.5s", "ease-in-out", "colorDark", "colorLight" );
          themeCk.updateElementStylesClas(".headerContent h1", "color", "2s", "ease-in-out", "colorDark", "colorLight" );
          themeCk.updateElementStylesClas(".headerContent a", "color", "1.5s", "ease-in-out", "colorDark", "colorLight" );
          themeCk.updateElementStylesClas(".spieg", "color", "1.5s", "ease-in-out", "colorDark", "colorLight" );
    
          themeCk.applyCssTransition(".lOne", "color", "#ffffff", "2.5s");
          themeCk.applyCssTransition(".popupS", "background", "#000000e9", "1s");
          themeCk.applyCssTransition(".prototipo", "color", "#ffffff", "2.5s");
          themeCk.applyCssTransition(".description p", "color", "#ffffff", "2.5s");
          themeCk.applyCssTransition(".descritionPop", "color", "#ffffff", "2.5s");
    
          themeCk.scomparsaRicomparsa(".navbarDue", "900ms", "linear-gradient(to right, #535353fa, #515151fa, #414141fa)", "1.2s", 700 );
          themeCk.scomparsaRicomparsa(".imgCon span", "0.7s", "none", "0.8s", 700 );
          themeCk.scomparsaRicomparsa(".pCookiesTre", "0.7s", "linear-gradient(to right, #12131383 0%, #0b0f0c85 0%)", "0.8s", 700 );
          themeCk.scomparsaRicomparsa(".pCookiesQuattro", "1.3s", "linear-gradient(to right, #12131383 0%, #0b0f0c85 0%)", "0.8s", 900 );
          themeCk.scomparsaRicomparsa(".pCookies ", "0.4s", "linear-gradient(to right, #12131383 0%, #0b0f0c85 0%)", "2.0s", 400 );
          themeCk.scomparsaRicomparsa(".pCookiesDue ", "0.4s", "none", "2.0s", 400 );
          themeCk.scomparsaRicomparsa(".proBack", "0.8s", "none", "1.5s", 600 );
          themeCk.scomparsaRicomparsa(".msgBk", "0.8s", "linear-gradient(to right, #12131383 0%, #0b0f0c85 0%)", "1.5s", 600 );
          themeCk.scomparsaRicomparsa(".imgCo", "0.6s", "linear-gradient(to right, #12131383 0%, #0b0f0c85 0%)", "1.5s", 700 );
          themeCk.scomparsaRicomparsa(".click", "0.6s", "linear-gradient(to right, #6e6e6e7d, #6666667d, #5f5f5f7d, #5757577d, #5050507d, #4949497d, #4242427d, #4b4b4b7d)", "1s", 700 );
    
          themeCk.applyTransition(".ttprogect h3", "color", "1.5s", "colorLight", "colorDark", 10, "0.3s" );
          themeCk.applyTransition(".text", "color", "1.5s", "colorLight", "colorDark", 10, "0.3s" );
          themeCk.applyTransition("aside a", "color", "1.5s", "whiteGreen", "darkGreen", 1500, "" );
          
          themeCk.fadeToggle(".inputBkLight", "inputBkLight", "inputBkDark", 500);
          themeCk.fadeToggle(".inputBkLightInv", "inputBkLightInv", "inputBkDarkInv", 600);
    
    
          //questa è la funzione che gestisce il cambio del colore della barra del menu dove imposto anche il fatto che se non ho scrollato non si deve vedere
          document.querySelectorAll(".navbigTwo").forEach((a) => {
            a.style.transition = "opacity 900ms";
            a.style.opacity = "0";
    
            setTimeout(() => {
              a.style.background =
                "linear-gradient(to right, #454545f2, #000000f2,#000000f2, #363535f2)";
              a.style.transition = "opacity 1s";
              a.style.opacity = "1";
    
              if (window.scrollY == 0) {
                a.style.opacity = "0"; 
              }
            }, 600);
          });
    
          //metodo particolari per elementi che hanno hover
          document.querySelectorAll(".aStyle").forEach((a) => {
            a.style.transition = "color 1s ease";
            a.classList.add("hoL");
            a.classList.remove("hoD");
    
            a.addEventListener(
              "transitionend",
              function () {
                a.style.transition = "";
              },
              { once: true }
            ); 
          });
    
          theme = "dark";
        }
    
        // Salva il tema nel cookie Salva il tema nel cookie Salva il tema nel cookie Salva il tema nel cookie Salva il tema nel cookie 
        document.cookie =
          "theme=" + theme + "; path=/; expires=Fri, 31 Dec 9999 23:59:59 GMT";
      });
      setTimeout(function () {
        document.querySelectorAll(".moon, .sun, .toggle").forEach(function (el) {
          el.classList.remove("notransition");
        });
      }, 100); 
    });