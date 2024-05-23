
// in questa pagina gestisco il codice per le creazione e la gestione delle tabelle del mio backend


/**
 * funzione GENERICA per aprire il form insert: la tabella si stringe e il form appare
 * @param string form- l'elemento form a cui mi riferisco'.
 * @param string container - lo span dove si trova la tabella.
 * @param int widthPercentage - la percentuale di quanto il contenitore della tabella si deve stringere.
 */
function apriFormInsertGenerico(form, container, widthPercentage) {
  form.style.right = "0";
  container.style.width = widthPercentage + "%";
  container.style.pointerEvents = "none";
}
  


/**
 * Alterna la visibilità di un elemento basandosi sul suo stato attuale.
 * @param {Element} button - Il bottone che attiva la funzione. Deve avere attributi 'data-id' e 'data-cancellato'.
 * @param {string} url - URL per inviare la richiesta POST.
 * La funzione aggiorna l'attributo 'data-cancellato', l'immagine e il testo del bottone per riflettere il nuovo stato.
 * Invia una richiesta POST al server con l'ID e il nuovo stato.
 */
function toggleVisibility(button, url) {
    let id = button.getAttribute("data-id");
    let statoCancellato = button.getAttribute("data-cancellato");
    let nuovoStato = statoCancellato === "1" ? "0" : "1";  // se nel database risulta nascosto, mostrerà l'occhio chiuso
    button.setAttribute("data-cancellato", nuovoStato);
    button.querySelector("img").src = `assets/${
      nuovoStato === "1" ? "occhio_chiuso.png" : "occhio_aperto.png"
    }`;
    button.querySelector("span").textContent =
      nuovoStato === "1" ? "show" : "hide"; // cambia anche la scritta a seconda dello stato
  
    // informazioni prese dal database
    const data = {
      id: id,
      nuovoStato: nuovoStato,
      azione: "toggleVisibility",
    };
  
    //eseguo richiesta
    fetch(url, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => response.json())
      //controllo eventuali errori
      .catch((error) => {
        console.error("Error:", error);
      });
  }
  
  /**
 * Apre un popup di cancellazione centrato nella pagina.
 * Questa funzione è generica e può essere riutilizzata per aprire qualsiasi popup definito da un selettore CSS.
 * @param {Event} e - L'evento generato dal click dell'utente.
 * @param string -popupSelector- Il selettore CSS dell'elemento popup da visualizzare.
 * La funzione recupera l'ID dell'elemento da cancellare dall'attributo 'data-val' dell'elemento che ha scatenato l'evento,
 */
  function apriPopupCancellazione(e, popupSelector) {
    idDaCancellare = e.currentTarget.getAttribute("data-val");
    let popup = document.querySelector(popupSelector);
    if (popup) {
        // stile comparsa messaggio
      popup.style.transition = "transform 0.5s ease";
      popup.style.transform = "translate(-50%, -50%) scale(1)";
    }
  }
  
  /**
 * Aggiorna o rigenera una tabella all'interno di un dato contenitore.
 * 
 * @param string tabellaSelector - Selettore CSS per individuare la tabella esistente.
 * @param string container - Il contenitore DOM in cui si trova la tabella.
 * @param Function generazioneFunction - Funzione che genera o rigenera la tabella.
 */
  
  function aggiornaTabellaGenerica(
    tabellaSelector,
    container,
    generazioneFunction
  ) {
    let tabella = document.querySelector(tabellaSelector);
    if (tabella) {
      container.removeChild(tabella);
    }
    generazioneFunction();
  }
  
  
  /**
 * funzione GENERICA per creare il bottone di inserimento di un novo dato con la svg di icona
 *  * @param string
 */
   
function createInsertButton(className) {
    return `<button class="${className}">
        <svg class='insertSvg' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 27.53 37.19'> <path d='M.56 36.87l-.31-3.17a.25.25 0 0 1 .21-.13l3.3 2.21a.25.25 0 0 1-.04.24l-3.17.83zm-.03-5.41l5.13 3.44 2.03-1.04a.5.5 0 0 0 .05-.84l-6.22-4.17a.5.5 0 0 0-.76.35l-.23 2.26zM5.66 29.41l14.51-21.63M2.34 27.18l14.5-21.63M8.98 31.64l14.51-21.63'/> <path d='M20.21.5a1.79 1.79 0 0 1 .81.26l5.37 3.6c.58.39.8 1.08.5 1.53l-1.7 2.54-7.47-5.01 1.7-2.54a.75.75 0 0 1 .79-.38z'/> </svg>
                    <span>insert</span>
                </button>`;
  }



 /**
 * funzione per accettare recensione, passo i parametri presi dal bottone e in base all'id "accetto" il messaggio specifico + icona svg
 *  * @param object
 */
   
function createAcceptButton(messaggio) {
    return `<button class="accept" onclick="trasferisciRecensione(this)"
                    data-id="${messaggio.id}" 
                    data-nome="${messaggio.nome}"
                    data-testo="${messaggio.testo}"
                    data-url-immagine="${messaggio.url_immagine}"
                    data-social="${messaggio.social}"
                    data-link="${messaggio.link}">
        <svg class='insertSvg' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 27.53 37.19'> 
            <path d='M.56 36.87l-.31-3.17a.25.25 0 0 1 .21-.13l3.3 2.21a.25.25 0 0 1-.04.24l-3.17.83zm-.03-5.41l5.13 3.44 2.03-1.04a.5.5 0 0 0 .05-.84l-6.22-4.17a.5.5 0 0 0-.76.35l-.23 2.26zM5.66 29.41l14.51-21.63M2.34 27.18l14.5-21.63M8.98 31.64l14.51-21.63'/>
            <path d='M20.21.5a1.79 1.79 0 0 1 .81.26l5.37 3.6c.58.39.8 1.08.5 1.53l-1.7 2.54-7.47-5.01 1.7-2.54a.75.75 0 0 1 .79-.38z'/>
        </svg>
        <span>accept</span>
        </button>`;
  }
  

  //   funzione per annullare l'apertura del form di cambiamento solo per i messaggi

document.querySelector(".annullaUpdate").addEventListener("click", function () {
    // cambio di stile
    formUpdateMes.style.right = "-800px";
    tabellaContainerMes.style.width = "100%";
    tabellaContainerMes.style.pointerEvents = "auto";
    let elements = document.getElementsByClassName("testoColonna");
    for (let i = 0; i < elements.length; i++) {
        //imposto un ritardo  
      setTimeout(
        function (index) {
          elements[index].style.width = "42%";
        },
        500,
        i
      );
    }
  });



//   TABELLE TABELLE TABELLE TABELLE TABELLE TABELLE TABELLE TABELLE TABELLE TABELLE TABELLE TABELLE TABELLE TABELLE TABELLE 

// funzione per generare la tabella portfolio e funzione per le sue righe

function generaTabellaPortfolio() {
    const data = {
      azione: "seleziona",
    };
  
    fetch("./db/mysql.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => response.json()) //converto la risposta
      .then((data) => {
        let tabellaContainer = document.getElementById("tabellaContainer");
        let existingTable = document.querySelector(".table");
        if (existingTable) {
          tabellaContainer.removeChild(existingTable); //rimuovo tabella precedente ad ogni riavvio
        }
        //genero la tabella con le funzioni che la costituiscono
        let tabella = `
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>URL</th>
                                <th>TITOLO</th>
                                <th>DESCRIZIONE</th>
                                <th>SOTTOTITOLO</th>
                                <th>ALT</th>
                                <th class="createButtonTable">
                                ${createInsertButton("insertf")}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                           ${generaRighe(data)}
                        </tbody>
                    </table>
                `;
        tabellaContainer.insertAdjacentHTML("beforeend", tabella); //agdancio la tabella
        //se premo il tasto cancellazione cambia lo stile e fa apparire il popup di conferma
        document.querySelectorAll(".delete").forEach((button) => {
          button.addEventListener("click", function () {
            let idDaCancellare = this.getAttribute("data-val");
            let popup = document.querySelector("#cancUno");
            popup.style.transform = "translate(-50%, -50%) scale(1)";
            //passo l'id così da sapere quale dato cancellare
            document
              .getElementById("cancDefUno")
              .setAttribute("data-id", idDaCancellare);
          });
        });
        // se premo il pulsante insert cambio lo stile per far apparire il form
        document.querySelectorAll(".insertf").forEach((button) => {
          button.addEventListener("click", () => {
            apriFormInsertGenerico(formInsertf, tabellaContainer, 52);
          });
        });
      })
      // in caso di errore
      .catch((error) => {
        console.error("Error: ", error);
      });
  }
  // funzione per generare le righe del portfolio che vengono create in base ai dati raccolti creo anche i vari bottoni con le svg e le loro funzioni
  function generaRighe(portfolio) {
    let righe = "";
    portfolio.forEach((disegno) => {
      let riga = `
                        <tr>
                                <td><div>${disegno.id}</div></td>
                                <td><div>${disegno.url}</div></td>
                                <td><div>${disegno.titolo}</div></td>
                                <td><div>${disegno.descrizione}</div></td>
                                <td><div>${disegno.sottotitolo}</div></td>
                                <td><div>${disegno.alt}</div></td>
                                <td class="createButtonTable">
                                <button class="update" data-id="${
                                  disegno.id
                                }" data-url="${disegno.url}" data-titolo="${
        disegno.titolo
      }" data-sottotitolo="${disegno.sottotitolo}" data-alt="${
        disegno.alt
      }" data-descrizione="${
        disegno.descrizione
      }" onclick="apriFormUpdateDisegno(this)">
    
                    <svg class='updateSvg' viewBox='0 0 51.28 51.32'>
                        <polygon points='14.67 33 19.27 33 19.27 29.34 22.55 28.52 24.35 30.76 28.69 28.52 26.46 25.42 27.89 23.3 31.16 24.15 32.9 19.59 30.07 18.09 29.71 15.05 32.26 13.84 30.8 9.23 28.13 9.72 25.95 8.63 28.74 5.23 23.78 2.34 22.07 4.99 19.16 4.74 19.52 .5 13.88 .5 13.88 4.08 12.12 5.47 8.79 2.22 5.33 5.47 7.88 8.02 6.3 10.57 2.18 8.87 .6 13.72 3.51 15.42 3.87 18.09 .6 18.69 1.33 24.03 5.45 23.3 7.63 25.42 4.72 28.4 9.45 31.18 11.88 28.64 13.88 28.85 14.67 33'/>
                        <circle cx='16.73' cy='16.75' r='6.79'/>
                        <polygon points='47.44 28.93 44.7 26.22 42.55 28.4 40.11 26.96 40.36 24.57 36.46 23.35 35.97 26.5 33.87 26.92 32.42 24.49 28.71 26.19 29.5 28.74 27.94 30.76 25.71 29.98 23.86 33.57 25.73 34.86 26.39 36.79 22.73 37.17 23.98 41.8 26.56 41.23 28.14 43.09 25.43 45.4 28.78 48.72 30.89 46.59 32.75 46.8 32.82 50.69 36.79 50.79 36.78 47.78 39.21 47.19 40.66 50.63 44.45 48.67 43.72 45.95 45.08 44.15 47.38 45.72 50.09 42.12 47.21 40.12 47.16 37.58 50.64 37.52 49.47 33.08 46.53 33.17 45.46 31.87 47.44 28.93'/>
                        <circle cx='36.62' cy='37.37' r='5.68'/>
                    </svg>
                    <span>update</span>
                </button>
    
                <button class="hid_sho" onclick="toggleVisibility(this, './db/mysql.php')" data-id="${
                  disegno.id
                }" data-cancellato="${disegno.cancellato}">
      <img src="assets/${
        disegno.cancellato === "1" ? "occhio_chiuso.png" : "occhio_aperto.png"
      }" alt="">
      <span>${disegno.cancellato === "1" ? "show" : "hide"}</span>
  </button>
  
    
                
                            <button class="delete" data-val='${disegno.id}'>
                    <svg class='deleteSvg' viewBox='0 0 24 30'>
                        <path d='M0.75,5.25 H23.25 M7.76,2.75 V1.58 C7.76,1.12 8.13,0.75 8.59,0.75 H15.42 C15.88,0.75 16.25,1.12 16.25,1.58 V2.75 M3.41,7.75 V26.82 C3.41,28.53 4.8,29.92 6.51,29.92 H17.49 C19.2,29.92 20.59,28.53 20.59,26.82 V7.75 M15.08,10.75 V23.75  M9.08,10.75 V23.75'/>
                    </svg>
                    <span>delete</span>
                </button>
                        </td>
                            </tr>
                        `;
  
      righe += riga;
    });
    return righe;
  }
  
  // funzione per generare la tabella progetti e funzione per le sue righe
  function generaTabellaProg() {
    const data = {
      azione: "seleziona",
    };
  
    fetch("./db/mysql_progetti.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => response.json()) //converto la risposta
      .then((data) => {
        console.log("dati ", data);
        let tabellaContainerProg = document.getElementById(
          "tabellaContainerProg"
        );
        let existingTableProg = document.querySelector(".tableProg");
        if (existingTableProg) {
          tabellaContainerProg.removeChild(existingTableProg); //rimuovo tabella precedente ad ogni riavvio
        }
         //genero la tabella con le funzioni che la costituiscono
        let tabellaProg = `
          <table class="tableProg">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>TITOLO</th>
                      <th>TESTO</th>
                      <th>N.</th>
                      <th>DESCRIZIONI</th>
                      <th>ALT IMG.</th>
                      <th>URL IMG.</th>
                      <th class="createButtonTable">
                      ${createInsertButton("inserty")}
                      </th>
                  </tr>
              </thead>
              <tbody>
                 ${generaRigheProg(data)}
              </tbody>
          </table>
        `;
        tabellaContainerProg.insertAdjacentHTML("beforeend", tabellaProg); //aggancio la tabella
        //se premo il tasto cancellazione cambia lo stile e fa apparire il popUp di conferma
        document.querySelectorAll(".deleteTwo").forEach((button) =>
          button.addEventListener("click", function (e) {
            apriPopupCancellazione(e, "#cancDue");
          })
        );
         // se premo il pulsante insert cambio lo stile per far apparire il form
        document.querySelectorAll(".inserty").forEach((button) =>
          button.addEventListener("click", () => {
            apriFormInsertGenerico(formInsertProg, tabellaContainerProg, 52);
          })
        );
      })
      //in caso di errore
      .catch((error) => {
        console.error("Error: ", error);
      });
  }
  // funzione per generare le righe dei progetti che vengono create in base ai dati raccolti creo anche i vari bottoni con le svg e le loro funzioni
  function generaRigheProg(progetti) {
    let righe = "";
    progetti.forEach((progetto) => {
      let riga = `
                        <tr>
                                <td><div>${progetto.id}</div></td>
                                <td><div>${progetto.titolo}</div></td>
                                <td><div>${progetto.testo}</div></td>
                                <td><div>${progetto.ripetizioni_testo}</div></td>
                                <td><div>${progetto.descrizione}</div></td>
                                <td><div>${
                                  progetto.sottotitolo_immagine
                                }</div></td>
                                <td><div>${progetto.url_immagine}</div></td>
                                <td class="createButtonTable">
                                <button class="update" onclick="apriFormUpdateProg('${
                                  progetto.id
                                }', '${progetto.titolo}', '${progetto.testo}', '${
        progetto.ripetizioni_testo
      }', '${progetto.descrizione}', '${progetto.sottotitolo_immagine}', '${
        progetto.url_immagine
      }')">
    
                    <svg class='updateSvg' viewBox='0 0 51.28 51.32'>
                        <polygon points='14.67 33 19.27 33 19.27 29.34 22.55 28.52 24.35 30.76 28.69 28.52 26.46 25.42 27.89 23.3 31.16 24.15 32.9 19.59 30.07 18.09 29.71 15.05 32.26 13.84 30.8 9.23 28.13 9.72 25.95 8.63 28.74 5.23 23.78 2.34 22.07 4.99 19.16 4.74 19.52 .5 13.88 .5 13.88 4.08 12.12 5.47 8.79 2.22 5.33 5.47 7.88 8.02 6.3 10.57 2.18 8.87 .6 13.72 3.51 15.42 3.87 18.09 .6 18.69 1.33 24.03 5.45 23.3 7.63 25.42 4.72 28.4 9.45 31.18 11.88 28.64 13.88 28.85 14.67 33'/>
                        <circle cx='16.73' cy='16.75' r='6.79'/>
                        <polygon points='47.44 28.93 44.7 26.22 42.55 28.4 40.11 26.96 40.36 24.57 36.46 23.35 35.97 26.5 33.87 26.92 32.42 24.49 28.71 26.19 29.5 28.74 27.94 30.76 25.71 29.98 23.86 33.57 25.73 34.86 26.39 36.79 22.73 37.17 23.98 41.8 26.56 41.23 28.14 43.09 25.43 45.4 28.78 48.72 30.89 46.59 32.75 46.8 32.82 50.69 36.79 50.79 36.78 47.78 39.21 47.19 40.66 50.63 44.45 48.67 43.72 45.95 45.08 44.15 47.38 45.72 50.09 42.12 47.21 40.12 47.16 37.58 50.64 37.52 49.47 33.08 46.53 33.17 45.46 31.87 47.44 28.93'/>
                        <circle cx='36.62' cy='37.37' r='5.68'/>
                    </svg>
                    <span>update</span>
                </button>
    
                <button class="hid_sho" onclick="toggleVisibility(this, './db/mysql_progetti.php')" data-id="${
                  progetto.id
                }" data-cancellato="${progetto.cancellato}">
      <img src="assets/${
        progetto.cancellato === "1" ? "occhio_chiuso.png" : "occhio_aperto.png"
      }" alt="">
      <span>${progetto.cancellato === "1" ? "show" : "hide"}</span>
  </button>
  
    
    
                            <button class="deleteTwo" data-val='${progetto.id}'>
                    <svg class='deleteSvg' viewBox='0 0 24 30'>
                        <path d='M0.75,5.25 H23.25 M7.76,2.75 V1.58 C7.76,1.12 8.13,0.75 8.59,0.75 H15.42 C15.88,0.75 16.25,1.12 16.25,1.58 V2.75 M3.41,7.75 V26.82 C3.41,28.53 4.8,29.92 6.51,29.92 H17.49 C19.2,29.92 20.59,28.53 20.59,26.82 V7.75 M15.08,10.75 V23.75  M9.08,10.75 V23.75'/>
                    </svg>
                    <span>delete</span>
                </button>
                        </td>
                            </tr>
                        `;
  
      righe += riga;
    });
    return righe;
  }
  
  // funzione per generare la tabella recensioni e funzione per le sue righe
  
  function generaTabellaRec() {
    const data = {
      azione: "seleziona",
    };
  
    fetch("./db/mysql_recensioni.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => response.json()) //converto la risposta
      .then((data) => {
        console.log("dati ", data);
        let tabellaContainerRec = document.getElementById("tabellaContainerRec");
        let existingTableRec = document.querySelector(".tableRec");
        if (existingTableRec) {
          tabellaContainerRec.removeChild(existingTableRec); //rimuovo tabella precedente ad ogni riavvio
        }
         //genero la tabella con le funzioni che la costituiscono
        let tabellaRec = `
            <table class="tableRec">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>TESTO</th>
                        <th>IMMAGINE</th>
                        <th>SOCIAL</th>
                        <th>LINK</th>
                        <th class="createButtonTableRec">
                        ${createInsertButton("insert")}
                        </th>
                    </tr>
                </thead>
                <tbody>
                   ${generaRigheRec(data)}
                </tbody>
            </table>
        `;
        tabellaContainerRec.insertAdjacentHTML("beforeend", tabellaRec); //aggancio la tabella
        //se premo il tasto cancellazione cambia lo stile e fa apparire il popUp di conferma
        document.querySelectorAll(".deleteTre").forEach((button) =>
          button.addEventListener("click", function (e) {
            apriPopupCancellazione(e, "#cancTre");
          })
        );
         // se premo il pulsante insert cambio lo stile per far apparire il form
        document.querySelectorAll(".insert").forEach((button) =>
          button.addEventListener("click", () => {
            apriFormInsertGenerico(formInsertRec, tabellaContainerRec, 52);
          })
        );
      })
      //in caso di errore
      .catch((error) => {
        console.error("Error: ", error);
      });
  }
  
  function generaRigheRec(recensioni) {
    let righe = "";
    recensioni.forEach((recensione) => {
      let riga = `
                <tr>
                        <td><div>${recensione.id}</div></td>
                        <td><div>${recensione.nome}</div></td>
                        <td><div>${recensione.testo}</div></td>
                        <td><div>${recensione.url_immagine}</div></td>
                        <td><div>${recensione.social}</div></td>
                        <td><div>${recensione.link}</div></td>
                        
                        
                        <td class="createButtonTableRec">
                        <button class="update" onclick="apriFormUpdateRec(this)"
                        data-id="${recensione.id}"
                        data-nome="${recensione.nome}"
                        data-testo="${recensione.testo}"
                        data-url-immagine="${recensione.url_immagine}"
                        data-social="${recensione.social}"
                        data-link="${recensione.link}">
    
            <svg class='updateSvg' viewBox='0 0 51.28 51.32'>
                <polygon points='14.67 33 19.27 33 19.27 29.34 22.55 28.52 24.35 30.76 28.69 28.52 26.46 25.42 27.89 23.3 31.16 24.15 32.9 19.59 30.07 18.09 29.71 15.05 32.26 13.84 30.8 9.23 28.13 9.72 25.95 8.63 28.74 5.23 23.78 2.34 22.07 4.99 19.16 4.74 19.52 .5 13.88 .5 13.88 4.08 12.12 5.47 8.79 2.22 5.33 5.47 7.88 8.02 6.3 10.57 2.18 8.87 .6 13.72 3.51 15.42 3.87 18.09 .6 18.69 1.33 24.03 5.45 23.3 7.63 25.42 4.72 28.4 9.45 31.18 11.88 28.64 13.88 28.85 14.67 33'/>
                <circle cx='16.73' cy='16.75' r='6.79'/>
                <polygon points='47.44 28.93 44.7 26.22 42.55 28.4 40.11 26.96 40.36 24.57 36.46 23.35 35.97 26.5 33.87 26.92 32.42 24.49 28.71 26.19 29.5 28.74 27.94 30.76 25.71 29.98 23.86 33.57 25.73 34.86 26.39 36.79 22.73 37.17 23.98 41.8 26.56 41.23 28.14 43.09 25.43 45.4 28.78 48.72 30.89 46.59 32.75 46.8 32.82 50.69 36.79 50.79 36.78 47.78 39.21 47.19 40.66 50.63 44.45 48.67 43.72 45.95 45.08 44.15 47.38 45.72 50.09 42.12 47.21 40.12 47.16 37.58 50.64 37.52 49.47 33.08 46.53 33.17 45.46 31.87 47.44 28.93'/>
                <circle cx='36.62' cy='37.37' r='5.68'/>
            </svg>
            <span>update</span>
        </button>
    
        <button class="hid_sho" onclick="toggleVisibility(this, './db/mysql_recensioni.php')" data-id="${
          recensione.id
        }" data-cancellato="${recensione.cancellato}">
      <img src="assets/${
        recensione.cancellato === "1" ? "occhio_chiuso.png" : "occhio_aperto.png"
      }" alt="">
      <span>${recensione.cancellato === "1" ? "show" : "hide"}</span>
  </button>
  
    
    
                    <button class="deleteTre" data-val='${recensione.id}'>
            <svg class='deleteSvg' viewBox='0 0 24 30'>
                <path d='M0.75,5.25 H23.25 M7.76,2.75 V1.58 C7.76,1.12 8.13,0.75 8.59,0.75 H15.42 C15.88,0.75 16.25,1.12 16.25,1.58 V2.75 M3.41,7.75 V26.82 C3.41,28.53 4.8,29.92 6.51,29.92 H17.49 C19.2,29.92 20.59,28.53 20.59,26.82 V7.75 M15.08,10.75 V23.75  M9.08,10.75 V23.75'/>
            </svg>
            <span>delete</span>
        </button>
                </td>
                    </tr>
                `;
  
      righe += riga;
    });
    return righe;
  }
  
  // funzione per generare la tabella messaggi e funzioni per le sue righe
  
  function generaTabella() {
    const data = {
      azione: "seleziona",
    };
  
    fetch("./db/mysql_messaggi.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => response.json()) //converto la risposta
      .then((data) => {
        console.log("dati ", data);
        let tabellaContainerMes = document.getElementById("tabellaContainerMes"); 
        let existingTableMes = document.querySelector(".tableMes");
        if (existingTableMes) {
          tabellaContainerMes.removeChild(existingTableMes); //rimuovo tabella precedente ad ogni riavvio
        }
         //genero la tabella con le funzioni che la costituiscono
        let tabellaMes = `
                    <table class="tableMes">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th class="testoColonna">TESTO</th>
                                <th>IMMAGINE</th>
                                <th>SOCIAL</th>
                                <th colspan="2">LINK</th>
                            </tr>
                        </thead>
                        <tbody>
                           ${generaRigheh(data)}
                        </tbody>
                    </table>
                `;
        tabellaContainerMes.insertAdjacentHTML("beforeend", tabellaMes); //aggancio la tabella
        //se premo il tasto cancellazione cambia lo stile e fa apparire il popup di conferma
        document.querySelectorAll(".deleteQuattro").forEach((button) =>
          button.addEventListener("click", function (e) {
            apriPopupCancellazione(e, "#cancQuattro");
          })
        );
      })
      //in caso di errore
      .catch((error) => {
        console.error("Error: ", error);
      });
  }
  
  function generaRigheh(messaggi) {
    let righe = "";
    if (messaggi.length === 0) {
      return '<p class="noRec">Non ci sono nuove recensioni...</p>'; //messaggio che appare se la tabella è vuota
    }
    messaggi.forEach((messaggio) => {
      let riga = `
                        <tr>
                                <td><div>${messaggio.id}</div></td>
                                <td><div>${messaggio.nome}</div></td>
                                <td class="testoColonna"><div>${
                                  messaggio.testo
                                }</div></td>
                                <td><div>${messaggio.url_immagine}</div></td>
                                <td><div>${messaggio.social}</div></td>
                                <td><div>${
                                  messaggio.link
                                }</div></td>                            
                                <td class="createButtonTable">
    
                                ${createAcceptButton(messaggio)}
                                <button class="update" onclick="apriFormUpdate(this)"
                                data-id="${messaggio.id}"
                                data-nome="${messaggio.nome}"
                                data-testo="${messaggio.testo}"
                                data-url-immagine="${messaggio.url_immagine}"
                                data-social="${messaggio.social}"
                                data-link="${messaggio.link}">
    
                    <svg class='updateSvg' viewBox='0 0 51.28 51.32'>
                        <polygon points='14.67 33 19.27 33 19.27 29.34 22.55 28.52 24.35 30.76 28.69 28.52 26.46 25.42 27.89 23.3 31.16 24.15 32.9 19.59 30.07 18.09 29.71 15.05 32.26 13.84 30.8 9.23 28.13 9.72 25.95 8.63 28.74 5.23 23.78 2.34 22.07 4.99 19.16 4.74 19.52 .5 13.88 .5 13.88 4.08 12.12 5.47 8.79 2.22 5.33 5.47 7.88 8.02 6.3 10.57 2.18 8.87 .6 13.72 3.51 15.42 3.87 18.09 .6 18.69 1.33 24.03 5.45 23.3 7.63 25.42 4.72 28.4 9.45 31.18 11.88 28.64 13.88 28.85 14.67 33'/>
                        <circle cx='16.73' cy='16.75' r='6.79'/>
                        <polygon points='47.44 28.93 44.7 26.22 42.55 28.4 40.11 26.96 40.36 24.57 36.46 23.35 35.97 26.5 33.87 26.92 32.42 24.49 28.71 26.19 29.5 28.74 27.94 30.76 25.71 29.98 23.86 33.57 25.73 34.86 26.39 36.79 22.73 37.17 23.98 41.8 26.56 41.23 28.14 43.09 25.43 45.4 28.78 48.72 30.89 46.59 32.75 46.8 32.82 50.69 36.79 50.79 36.78 47.78 39.21 47.19 40.66 50.63 44.45 48.67 43.72 45.95 45.08 44.15 47.38 45.72 50.09 42.12 47.21 40.12 47.16 37.58 50.64 37.52 49.47 33.08 46.53 33.17 45.46 31.87 47.44 28.93'/>
                        <circle cx='36.62' cy='37.37' r='5.68'/>
                    </svg>
                    <span>update</span>
                </button>
    
                
    
    
                            <button class="deleteQuattro" data-val='${
                              messaggio.id
                            }'>
                    <svg class='deleteSvg' viewBox='0 0 24 30'>
                        <path d='M0.75,5.25 H23.25 M7.76,2.75 V1.58 C7.76,1.12 8.13,0.75 8.59,0.75 H15.42 C15.88,0.75 16.25,1.12 16.25,1.58 V2.75 M3.41,7.75 V26.82 C3.41,28.53 4.8,29.92 6.51,29.92 H17.49 C19.2,29.92 20.59,28.53 20.59,26.82 V7.75 M15.08,10.75 V23.75  M9.08,10.75 V23.75'/>
                    </svg>
                    <span>delete</span>
                </button>
                        </td>
                            </tr>
                        `;
  
      righe += riga;
    });
    return righe;
  }

  // funzione per generare la tabella utenti e funzione per le sue righe
  
  function generaTabellaUt() {
    const data = {
      azione: "seleziona",
    };
  
    fetch("./db/mysql_utenti.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => response.json()) //converto la risposta
      .then((data) => {
        console.log("dati ", data);
        let tabellaContainerUt = document.getElementById("tabellaContainerUt");
        let existingTableUt = document.querySelector(".tableUt");
        if (existingTableUt) {
          tabellaContainerUt.removeChild(existingTableUt); //rimuovo tabella precedente ad ogni riavvio
        }
         //genero la tabella con le funzioni che la costituiscono
        let tabellaUt = `
            <table class="tableUt">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>PASSWORD</th>
                        <th class="createButtonTable">
                        ${createInsertButton("insertUt")}
                        </th>
                    </tr>
                </thead>
                <tbody>
                   ${generaRigheUt(data)}
                </tbody>
            </table>
        `;
        tabellaContainerUt.insertAdjacentHTML("beforeend", tabellaUt); //aggancio la tabella
        //se premo il tasto cancellazione cambia lo stile e fa apparire il popUp di conferma
        document.querySelectorAll(".deleteCinque").forEach((button) =>
          button.addEventListener("click", function (e) {
            apriPopupCancellazione(e, "#cancCinque");
          })
        );
         // se premo il pulsante insert cambio lo stile per far apparire il form
        document.querySelectorAll(".insertUt").forEach((button) =>
          button.addEventListener("click", () => {
            apriFormInsertGenerico(formInsertUt, tabellaContainerUt, 70);
          })
        );
      })
      //in caso di errore
      .catch((error) => {
        console.error("Error: ", error);
      });
  }
  
  function generaRigheUt(utenti) {
    let righe = "";
    utenti.forEach((utentes) => {
      let riga = `
            <tr>
                <td><div>${utentes.id}</div></td>
                <td><div>${utentes.nome}</div></td>
                <td><div>${utentes.password}</div></td>
                <td class="createButtonTableUt">
                    <button class="update" onclick="apriFormUpdateUt(this)"
                        data-id="${utentes.id}"
                        data-nome="${utentes.nome}"
                        data-password="${utentes.password}">
                        <svg class='updateSvg' viewBox='0 0 51.28 51.32'>
                            <polygon points='14.67 33 19.27 33 19.27 29.34 22.55 28.52 24.35 30.76 28.69 28.52 26.46 25.42 27.89 23.3 31.16 24.15 32.9 19.59 30.07 18.09 29.71 15.05 32.26 13.84 30.8 9.23 28.13 9.72 25.95 8.63 28.74 5.23 23.78 2.34 22.07 4.99 19.16 4.74 19.52 .5 13.88 .5 13.88 4.08 12.12 5.47 8.79 2.22 5.33 5.47 7.88 8.02 6.3 10.57 2.18 8.87 .6 13.72 3.51 15.42 3.87 18.09 .6 18.69 1.33 24.03 5.45 23.3 7.63 25.42 4.72 28.4 9.45 31.18 11.88 28.64 13.88 28.85 14.67 33'/>
                            <circle cx='16.73' cy='16.75' r='6.79'/>
                            <polygon points='47.44 28.93 44.7 26.22 42.55 28.4 40.11 26.96 40.36 24.57 36.46 23.35 35.97 26.5 33.87 26.92 32.42 24.49 28.71 26.19 29.5 28.74 27.94 30.76 25.71 29.98 23.86 33.57 25.73 34.86 26.39 36.79 22.73 37.17 23.98 41.8 26.56 41.23 28.14 43.09 25.43 45.4 28.78 48.72 30.89 46.59 32.75 46.8 32.82 50.69 36.79 50.79 36.78 47.78 39.21 47.19 40.66 50.63 44.45 48.67 43.72 45.95 45.08 44.15 47.38 45.72 50.09 42.12 47.21 40.12 47.16 37.58 50.64 37.52 49.47 33.08 46.53 33.17 45.46 31.87 47.44 28.93'/>
                            <circle cx='36.62' cy='37.37' r='5.68'/>
                        </svg>
                        <span>update</span>
                    </button>
                    <button class="deleteCinque" data-val='${utentes.id}'>
                        <svg class='deleteSvg' viewBox='0 0 24 30'>
                            <path d='M0.75,5.25 H23.25 M7.76,2.75 V1.58 C7.76,1.12 8.13,0.75 8.59,0.75 H15.42 C15.88,0.75 16.25,1.12 16.25,1.58 V2.75 M3.41,7.75 V26.82 C3.41,28.53 4.8,29.92 6.51,29.92 H17.49 C19.2,29.92 20.59,28.53 20.59,26.82 V7.75 M15.08,10.75 V23.75  M9.08,10.75 V23.75'/>
                        </svg>
                        <span>delete</span>
                    </button>
                </td>
            </tr>
        `;
        righe += riga;
    });
    return righe;
  }

///////////////////////////////////////////////////////////////


generaTabellaPortfolio(); // richiamo la tabella portfolio
generaTabellaProg(); // richiamo la tabella progetti
generaTabellaRec(); // richiamo la tabella recensioni
generaTabella(); // richiamo la tabella messaggi
generaTabellaUt(); // richiamo la tabella utenti

////////////////////////////////////////////////////////////////////


// CANCELLARE CANCELLARE CANCELLARE CANCELLARE CANCELLARE CANCELLARE CANCELLARE CANCELLARE CANCELLARE CANCELLARE 


// funzione che gestisce la cancellazione effettiva di un elemento portfolio
function procediConCancellazione() {
  const idDaCancellare = document
    .getElementById("cancDefUno")
    .getAttribute("data-id"); // estraggo id

  if (!idDaCancellare) return; // non cancello nulla in caso contrario

  const data = {
    azione: "elimina",
    id: idDaCancellare,
  };

  fetch("./db/mysql.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((response) => response.json()) // converto risposta
    .then((data) => {
      console.log(data);
      document.querySelector("#cancUno").style.transform =
        "translate(-50%, -50%) scale(0)";
      aggiornaTabellaGenerica(
        "table",
        tabellaContainer,
        generaTabellaPortfolio
      );
    })
    //in caso di errore
    .catch((error) => {
      console.error("Error:", error);
      document.querySelector("#cancUno").style.transform =
        "translate(-50%, -50%) scale(0)";
    });
}
//la funzione viene richiamata al click
document.addEventListener("DOMContentLoaded", function () {
    document
      .getElementById("cancDefUno")
      .addEventListener("click", procediConCancellazione);
  
    document
    //in caso di annullamento il popup si richiude
      .getElementById("annullaCancB")
      .addEventListener("click", function () {
        document.querySelector("#cancUno").style.transform =
          "translate(-50%, -50%) scale(0)";
      });
  });

// funzione che gestisce la cancellazione effettiva di un elemento progetti
function procediConCancellazioneProgy() {
  if (!idDaCancellare) return;
  // in caso di fallimento non faccio nulla 

  
  const data = {
    azione: "elimina", 
    id: idDaCancellare,
  };

  fetch("./db/mysql_progetti.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((response) => response.json()) // converto la risposa
    .then((data) => {
      console.log(data);
      aggiornaTabellaGenerica(
        ".tableProg",
        tabellaContainerProg,
        generaTabellaProg
      );
      // cambio lo stile
      document.querySelector("#cancDue").style.transform =
        "translate(-50%, -50%) scale(0)";
      idDaCancellare = null;
    })
    .catch((error) => {
        // in caso di errore e richiudo il popup
      console.error("Error:", error);
      document.querySelector("#cancDue").style.transform =
        "translate(-50%, -50%) scale(0)";
      idDaCancellare = null;
    });
}

//la funzione si verifica al click
document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("cancDefDue")
    .addEventListener("click", procediConCancellazioneProgy);

  document
  // e cambio lo stile del popUp
    .getElementById("annullaCancBDue")
    .addEventListener("click", function () {
      document.querySelector("#cancDue").style.transform =
        "translate(-50%, -50%) scale(0)";
    });
});

// funzione che gestisce la cancellazione effettiva di un elemento recensioni
function procediConCancellazioneRec() {
  if (!idDaCancellare) return;
// se non esiste l'id non faccio nulla

  const data = {
    azione: "elimina",
    id: idDaCancellare,
  };

  fetch("./db/mysql_recensioni.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data), // converto in stringa
  })
    .then((response) => response.json()) // converto la risposta
    .then((data) => {
      console.log(data);
      aggiornaTabellaGenerica(".tableRec", tabellaContainerRec, generaTabellaRec);
      document.querySelector("#cancTre").style.transform =
      //cambio lo stile
        "translate(-50%, -50%) scale(0)";
      idDaCancellare = null;
    })
    .catch((error) => {
        // in caso di errore e richiudo il pop up
      console.error("Error:", error);
      document.querySelector("#cancTre").style.transform =
        "translate(-50%, -50%) scale(0)";
      idDaCancellare = null;
    });
}

//la funzione viene richiamata al click e vine cambiato lo stile del popup  
document.addEventListener("DOMContentLoaded", function () {
    document
      .getElementById("cancDefTre")
      .addEventListener("click", procediConCancellazioneRec);
  
    document
      .getElementById("annullaCancBTre")
      .addEventListener("click", function () {
        document.querySelector("#cancTre").style.transform =
          "translate(-50%, -50%) scale(0)";
      });
  });

// funzione che gestisce la cancellazione effettiva di un elemento messaggio

function procediConCancellazioneMes() {
  if (!idDaCancellare) return;
// se non esiste non faccio nulla

  const data = {
    azione: "elimina",
    id: idDaCancellare,
  };

  fetch("./db/mysql_messaggi.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data), // converto in stringa
  })
    .then((response) => response.json()) // converto risposta
    .then((data) => {
      console.log(data);
      aggiornaTabellaGenerica(".tableMes", tabellaContainerMes, generaTabella);
      // cambio stile
      document.querySelector("#cancQuattro").style.transform =
        "translate(-50%, -50%) scale(0)";
      idDaCancellare = null;
    })
    .catch((error) => {
        //in caso di errore richiudo anche il pop up
      console.error("Error:", error);
      document.querySelector("#cancQuattro").style.transform =
        "translate(-50%, -50%) scale(0)";
      idDaCancellare = null;
    });
}

//La funzione viene richiamata al click e cambia e richiude il pop up
document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("cancDefQuattro")
    .addEventListener("click", procediConCancellazioneMes);

  document
    .getElementById("annullaCancBQuattro")
    .addEventListener("click", function () {
      document.querySelector("#cancQuattro").style.transform =
        "translate(-50%, -50%) scale(0)";
    });
});



// // funzione che gestisce la cancellazione effettiva di un utente
function procediConCancellazioneUt() {
  if (!idDaCancellare) return;
// se non esiste l'id non faccio nulla

  const data = {
    azione: "elimina",
    id: idDaCancellare,
  };

  fetch("./db/mysql_utenti.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data), // converto in stringa
  })
    .then((response) => response.json()) // converto la risposta
    .then((data) => {
      console.log(data);
      aggiornaTabellaGenerica(".tableUt", tabellaContainerUt, generaTabellaUt);
      document.querySelector("#cancCinque").style.transform =
      //cambio lo stile
        "translate(-50%, -50%) scale(0)";
      idDaCancellare = null;
    })
    .catch((error) => {
        // in caso di errore e richiudo il pop up
      console.error("Error:", error);
      document.querySelector("#cancCinque").style.transform =
        "translate(-50%, -50%) scale(0)";
      idDaCancellare = null;
    });
}

//la funzione viene richiamata al click e vine cambiato lo stile del popup  
document.addEventListener("DOMContentLoaded", function () {
    document
      .getElementById("cancDefCinque")
      .addEventListener("click", procediConCancellazioneUt);
  
    document
      .getElementById("annullaCancBCinque")
      .addEventListener("click", function () {
        document.querySelector("#cancCinque").style.transform =
          "translate(-50%, -50%) scale(0)";
      });
  });




// INSERT INSERT INSERT INSERT INSERT INSERT INSERT INSERT INSERT INSERT INSERT INSERT INSERT INSERT INSERT INSERT 


//   funzione che si occupa di inserire un nuovo elemento nel portfolio
function inserisciDisegno() {
    const form = document.querySelector("#formInsertf");
    // raccolgo i dati del form
    const data = {
      azione: "inserisci",
      id: form.elements["id"].value,
      url: form.elements["url"].value,
      titolo: form.elements["titolo"].value,
      descrizione: form.elements["descrizione"].value,
      sottotitolo: form.elements["sottotitolo"].value,
      alt: form.elements["alt"].value,
    };
  
    fetch("./db/mysql.php", {  //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data), //converto in stringa
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        //aggiorno tabella e la rigenero
        aggiornaTabellaGenerica(
          "table",
          tabellaContainer,
          generaTabellaPortfolio
        );
      })
      .catch((error) => {
        console.error("Error:", error); //in caso di errore
      });
      // richiudo form
    formInsertf.style.right = "-800px";
    tabellaContainer.style.width = "100%";
    tabellaContainer.style.pointerEvents = "auto";
  }
  
  //   funzione che si occupa di inserire un nuovo elemento nei progetti
  function inserisciProg() {
    const form = document.querySelector("#formInsertProg");
    //raccolgo dati dal form
    const data = {
      azione: "inserisci",
      id: form.elements["idProg"].value,
      titolo: form.elements["titoloProg"].value,
      testo: form.elements["testoProg"].value,
      ripetizioni_testo: form.elements["numeroProg"].value,
      descrizione: form.elements["descrizioneProg"].value,
      sottotitolo_immagine: form.elements["sottotitoloImgProg"].value,
      url_immagine: form.elements["urlProg"].value,
    };
  
    fetch("./db/mysql_progetti.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data), // converto in stringa
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        //aggiorno e rigenero la tabella
        aggiornaTabellaGenerica(
          ".tableProg",
          tabellaContainerProg,
          generaTabellaProg
        );
      })
      .catch((error) => {
        console.error("Error:", error); // in caso di errore
      });
  
      //cambio lo stile e richiudo il form
    formInsertProg.style.right = "-800px";
    tabellaContainerProg.style.width = "100%";
    tabellaContainerProg.style.pointerEvents = "auto";
  
  }
  
  //   funzione che si occupa di inserire un nuovo elemento nelle recensioni
  function inserisciRec() {
    const form = document.querySelector("#formInsertRec");
    //raccolgo i dati dal form
    const data = {
      azione: "inserisci",
      id: form.elements["idRec"].value,
      nome: form.elements["nomeRec"].value,
      testo: form.elements["testoRec"].value,
      url_immagine: form.elements["urlProfilo"].value,
      social: form.elements["socialName"].value,
      link: form.elements["socialUrl"].value,
    };
  
    fetch("./db/mysql_recensioni.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data), // converto in stringa
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        //aggiorno e rigenero la tabella
        aggiornaTabellaGenerica(".tableRec", tabellaContainerRec, generaTabellaRec);
      })
      .catch((error) => {
        console.error("Error:", error); // in caso di errore
      });
  
      //cambio lo stile e richiudo il form
    formInsertRec.style.right = "-800px";
    tabellaContainerRec.style.width = "100%";
    tabellaContainerRec.style.pointerEvents = "auto";
    
  }


  //   funzione che si occupa di inserire un nuovo elemento negli utenti
  function inserisciUt() {
    const form = document.querySelector("#formInsertUt");
    // Raccolgo i dati dal form
    const data = {
      azione: "inserisci",
      id: form.elements["idInserUt"].value,
      nome: form.elements["nomeInsertUt"].value,
      password: form.elements["passwordInsertUt"].value
    };
  
    fetch("./db/mysql_utenti.php", { // Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un'operazione SQL
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data), // Converto in stringa
    })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      // Aggiorno e rigenero la tabella
      aggiornaTabellaGenerica(".tableUt", tabellaContainerUt, generaTabellaUt);
    })
    .catch((error) => {
      console.error("Error:", error); // In caso di errore
    });
  
    // Cambio lo stile e richiudo il form
    formInsertUt.style.right = "-800px";
    tabellaContainerUt.style.width = "100%";
    tabellaContainerUt.style.pointerEvents = "auto";
    
  }
  

/////////////////////////////////////////////////////////////////////////////////////////////////////

// richiamo l'inserimento della persona portfolio
let inserisciBtnf = document.querySelector("#nuoletigaf");
inserisciBtnf.addEventListener("click", inserisciDisegno);

// richiamo l'inserimento della persona progetti
let inserisciBtny = document.querySelector("#nuoletigaProg");
inserisciBtny.addEventListener("click", inserisciProg);

// richiamo l'inserimento della persona recensioni
let inserisciBtn = document.querySelector("#nuoletigaRecz");
inserisciBtn.addEventListener("click", inserisciRec);

// richiamo l'inserimento della persona utenti
let inserisciBtnUt = document.querySelector("#nuoletigaUt");
inserisciBtnUt.addEventListener("click", inserisciUt);

/////////////////////////////////////////////////////////////////////////////////////////////////////


// MODIFICHE MODIFICHE MODIFICHE MODIFICHE MODIFICHE MODIFCHEMODIFICHE MODIFICHE MODIFICHE MODIFICHE MODIFICHE MODIFCHE


// funzione che modifica il portfolio

function modificoPortfolio(id, titolo, url, descrizione, sottotitolo, alt) {

    // riprendo l'oggetto con i valori che mi servono
  const data = {
    azione: "aggiorna",
    id: id,
    titolo: titolo,
    url: url,
    descrizione: descrizione,
    sottotitolo: sottotitolo,
    alt: alt,
  };

  fetch("./db/mysql.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      //aggiorno e rigenero la tabella
      aggiornaTabellaGenerica(
        "table",
        tabellaContainer,
        generaTabellaPortfolio
      );
    })
    .catch((error) => {
      console.error("Error:", error); // in caso si errore 
    });
    //richiudo il form
  formUpdate.style.right = "-800px";
  tabellaContainer.style.width = "100%";
  tabellaContainer.style.pointerEvents = "auto";
}

// funzione che modifica i progetti
function modificaProg(
  id,
  titolo,
  testo,
  ripetizioni_testo,
  descrizione,
  sottotitolo_immagine,
  url_immagine
) {
  

    // riprendo l'oggetto con i dati che mi servono 
  const data = {
    azione: "aggiorna",
    id: id,
    titolo: titolo,
    testo: testo,
    ripetizioni_testo: ripetizioni_testo,
    descrizione: descrizione,
    sottotitolo_immagine: sottotitolo_immagine,
    url_immagine: url_immagine,
  };

  fetch("./db/mysql_progetti.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      //aggiorno e rigenero la tabella
      aggiornaTabellaGenerica(
        ".tableProg",
        tabellaContainerProg,
        generaTabellaProg
      );
    })
    .catch((error) => {
      console.error("Error:", error); // in caso di errore 
    });

    //richiudo il form
  formUpdateProg.style.right = "-800px";
  tabellaContainerProg.style.width = "100%";
  tabellaContainerProg.style.pointerEvents = "auto";
  let tableProg = document.querySelector(".tableProg");

}

// funzione che modifica le recensioni
function modificaRec(id, nome, testo, url_immagine, social, link) {

    //riprendo l'oggetto con i dati che mi servono
  const data = {
    azione: "aggiorna",
    id: id,
    nome: nome,
    testo: testo,
    url_immagine: url_immagine,
    social: social,
    link: link,
  };

  fetch("./db/mysql_recensioni.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data), // converto in stringa
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      //aggiorno e rigenero la tabella
      aggiornaTabellaGenerica(".tableRec", tabellaContainerRec, generaTabellaRec);
    })
    .catch((error) => {
      console.error("Error:", error); //in caso di errore
    });

    //richiudo il form
  formUpdateRec.style.right = "-800px";
  tabellaContainerRec.style.width = "100%";
  tabellaContainerRec.style.pointerEvents = "auto";
}

// funzione che modifica i messaggi

function modificaMes(id, nome, testo, url_immagine, social, link) {
  //riprendo l'oggetto con i dati che mi servono
  const data = {
    azione: "aggiorna",
    id: id,
    nome: nome,
    testo: testo,
    url_immagine: url_immagine,
    social: social,
    link: link,
  };

  fetch("./db/mysql_messaggi.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data), // converto in stringa
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
    //   aggiorno e rigenero tabella 
      aggiornaTabellaGenerica(".tableMes", tabellaContainerMes, generaTabella);
    })
    .catch((error) => {
      console.error("Error:", error); // in caso di errore
    });
    //richiudo form
  formUpdateMes.style.right = "-800px";
  tabellaContainerMes.style.width = "100%";
  tabellaContainerMes.style.pointerEvents = "auto";
}

// funzione che modifica gli utenti
function modificaUt(id, nome, password) {

  //riprendo l'oggetto con i dati che mi servono
const data = {
  azione: "aggiorna",
  id: id,
  nome: nome,
  password: password
};

fetch("./db/mysql_utenti.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
  method: "POST",
  headers: {
    "Content-Type": "application/json",
  },
  body: JSON.stringify(data), // converto in stringa
})
  .then((response) => response.json())
  .then((data) => {
    console.log(data);
    //aggiorno e rigenero la tabella
    aggiornaTabellaGenerica(".tableUt", tabellaContainerUt, generaTabellaUt);
  })
  .catch((error) => {
    console.error("Error:", error); //in caso di errore
  });

  //richiudo il form
formUpdateUt.style.right = "-800px";
tabellaContainerUt.style.width = "100%";
tabellaContainerUt.style.pointerEvents = "auto";
}

////////////////////////////////////////////////////////////////////

//richiamo le modifiche portfolio
let modificaBtnf = document.querySelector("#cambiaRigaf");
modificaBtnf.addEventListener("click", function () {
  let id = document.getElementById("idUpdate").value;
  let titolo = document.getElementById("titoloUpdate").value;
  let url = document.getElementById("urlUpdate").value;
  let descrizione = document.getElementById("descrizioneUpdate").value;
  let sottotitolo = document.getElementById("sottotitoloUpdate").value;
  let alt = document.getElementById("altUpdate").value;
  modificoPortfolio(id, titolo, url, descrizione, sottotitolo, alt);
});

//richiamo le modifiche ai progetti
let modificaBtny = document.querySelector("#cambiaRigaProg");
modificaBtny.addEventListener("click", function () {
  let id = document.getElementById("idUpdateProg").value;
  let titolo = document.getElementById("titoloUpdateProg").value;
  let testo = document.getElementById("testoUpdateProg").value;
  let ripetizioni_testo = document.getElementById("numeroUpdateProg").value;
  let descrizione = document.getElementById("descrizioneUpdateProg").value;
  let sottotitolo_immagine = document.getElementById(
    "sottotitoloUpdateImgProg"
  ).value;
  let url_immagine = document.getElementById("urlUpdateProg").value;
  modificaProg(
    id,
    titolo,
    testo,
    ripetizioni_testo,
    descrizione,
    sottotitolo_immagine,
    url_immagine
  );
});

//richiamo le modifiche alle recensioni
let modificaBtnz = document.querySelector("#modificaRigaRecz");
modificaBtnz.addEventListener("click", function () {
  let id = document.getElementById("idUpdateRec").value;
  let nome = document.getElementById("nomeUpdateRec").value;
  let testo = document.getElementById("testoUpdateRec").value;
  let url_immagine = document.getElementById("urlUpdateProfilo").value;
  let social = document.getElementById("socialUpdateName").value;
  let link = document.getElementById("socialUpdateUrl").value;
  modificaRec(id, nome, testo, url_immagine, social, link);
});

//richiamo le modifiche ai messaggi
let modificaBtn = document.querySelector("#modificaRigaMes");
modificaBtn.addEventListener("click", function () {
  let id = document.getElementById("idUpdateMes").value;
  let nome = document.getElementById("nomeUpdateMes").value;
  let testo = document.getElementById("testoUpdateMes").value;
  let url_immagine = document.getElementById("urlUpdateProfiloMes").value;
  let social = document.getElementById("socialUpdateNameMes").value;
  let link = document.getElementById("socialUpdateUrlMes").value;
  modificaMes(id, nome, testo, url_immagine, social, link);
});

//richiamo le modifiche agli utenti
let modificaBtnUt = document.querySelector("#modificaRigaUt");
modificaBtnUt.addEventListener("click", function () {
  let id = document.getElementById("idUpdateUt").value;
  let nome = document.getElementById("nomeUpdateUt").value;
  let password = document.getElementById("passwordUpdateUt").value;
  modificaUt(id, nome, password);
});

/////////////////////////////////////////////////////////////////////////////////////////////////////

 /**
 * funzione per trasferire dati da una tabella all'altra
 *  * @param object
 */
function trasferisciRecensione(button) {
    const data = {
      azione: "trasferisci",
      id: button.getAttribute("data-id"),
      nome: button.getAttribute("data-nome"),
      testo: button.getAttribute("data-testo"),
      url_immagine: button.getAttribute("data-url-immagine"),
      social: button.getAttribute("data-social"),
      link: button.getAttribute("data-link"),
    };
  
    fetch("./db/mysql_messaggi.php", { //Invio dati al server tramite una richiesta POST all'indirizzo e si esegue un operazione sql
      method: "POST",
      headers: {
        "Content-Type": "application/json", 
      },
      body: JSON.stringify(data), // converto in stringa // converto in stringa
    })
      .then((response) => response.json())
      .then((result) => {
        //aggiorno e rigenero tabella
        aggiornaTabellaGenerica(".tableMes", tabellaContainerMes, generaTabella);
      })
      .catch((error) => console.error("Errore:", error));
  }

//   APERTURA/MODIFICA FORM APERTURA/MODIFICA FORM APERTURA/MODIFICA FORM APERTURA/MODIFICA FORM APERTURA/MODIFICA FORM 



 /**
 * funzione per aprire form di cambiamento portfolio
 *  * @param object
 */
function apriFormUpdateDisegno(button) {
  let id = button.dataset.id;
  let url = button.dataset.url;
  let titolo = button.dataset.titolo;
  let sottotitolo = button.dataset.sottotitolo;
  let alt = button.dataset.alt;
  let descrizione = button.dataset.descrizione;
// cambio stile

  formUpdate.style.right = "0";
  tabellaContainer.style.width = "52%";
  tabellaContainer.style.pointerEvents = "none";

  //riprendo valori
  document.getElementById("idUpdate").value = id;
  document.getElementById("urlUpdate").value = url;
  document.getElementById("titoloUpdate").value = titolo;
  document.getElementById("sottotitoloUpdate").value = sottotitolo;
  document.getElementById("altUpdate").value = alt;
  document.getElementById("descrizioneUpdate").value = descrizione;
  document.getElementById("cambiaRigaf").setAttribute("data-val", id);
}

document
  .querySelector(".annullaInsertf")
  .addEventListener("click", function () {
    // se annullo richiudo il form 
    formInsertf.style.right = "-800px";
    tabellaContainer.style.width = "100%";
    tabellaContainer.style.pointerEvents = "auto";
  });

  // mi assicuro che si chiudano tutti i form
document
  .querySelector(".annullaUpdatef")
  .addEventListener("click", function () {
    console.log("Annullamento in corso");
    formUpdate.style.right = "-800px";
    tabellaContainer.style.width = "100%";
    tabellaContainer.style.pointerEvents = "auto";
  });

//funzione per aprire form di cambiamento progetti

function apriFormUpdateProg(
  id,
  titolo,
  testo,
  ripetizioni_testo,
  descrizione,
  sottotitolo_immagine,
  url_immagine
) {
  const formUpdate = document.querySelector("#formUpdateProg");
  //cambio lo stile
  formUpdateProg.style.right = "0";
  tabellaContainerProg.style.width = "52%";
  tabellaContainerProg.style.pointerEvents = "none";

  // imposto i valori di default nel form prendendoli dal database
  document.getElementById("idUpdateProg").value = id;
  document.getElementById("titoloUpdateProg").value = titolo;
  document.getElementById("testoUpdateProg").value = testo;
  document.getElementById("numeroUpdateProg").value = ripetizioni_testo;
  document.getElementById("descrizioneUpdateProg").value = descrizione;
  document.getElementById("sottotitoloUpdateImgProg").value =
    sottotitolo_immagine;
  document.getElementById("urlUpdateProg").value = url_immagine;

  document.getElementById("cambiaRigaProg").setAttribute("data-val", id);
}

document
  .querySelector(".annullaInserty")
  .addEventListener("click", function () {
    // in caso di annullamento richiudo il form
    formInsertProg.style.right = "-800px";
    tabellaContainerProg.style.width = "100%";
    tabellaContainerProg.style.pointerEvents = "auto";

  });
  // mi assicuro che tutti i form si ricchiudino
document
  .querySelector(".annullaUpdatey")
  .addEventListener("click", function () {
    console.log("Annullamento in corso");
    formUpdateProg.style.right = "-800px";
    tabellaContainerProg.style.width = "100%";
    tabellaContainerProg.style.pointerEvents = "auto";

  });

//funzione per aprire form di cambiamento recensioni  
function apriFormUpdateRec(button) {
  const formUpdate = document.querySelector("#formUpdateRec");
  // cambio lo stile
  formUpdateRec.style.right = "0";
  tabellaContainerRec.style.width = "52%";
  tabellaContainerRec.style.pointerEvents = "none";

  let id = button.getAttribute("data-id");
  let nome = button.getAttribute("data-nome");
  let testo = button.getAttribute("data-testo");
  let url_immagine = button.getAttribute("data-url-immagine");
  let social = button.getAttribute("data-social");
  let link = button.getAttribute("data-link");

  //compilo il form di default con i dati presi dal database
  document.getElementById("idUpdateRec").value = id;
  document.getElementById("nomeUpdateRec").value = nome;
  document.getElementById("testoUpdateRec").value = testo;
  document.getElementById("urlUpdateProfilo").value = url_immagine;
  document.getElementById("socialUpdateName").value = social;
  document.getElementById("socialUpdateUrl").value = link;

  document.getElementById("modificaRigaRecz").setAttribute("data-val", id);
}
// all'annullamento chiudo il form
document
  .querySelector(".annullaInsertz")
  .addEventListener("click", function () {
    formInsertRec.style.right = "-800px";
    tabellaContainerRec.style.width = "100%";
    tabellaContainerRec.style.pointerEvents = "auto";

  });

  //mi assicuro che tutti i form siano chiusi
document
  .querySelector(".annullaUpdatez")
  .addEventListener("click", function () {
    formUpdateRec.style.right = "-800px";
    tabellaContainerRec.style.width = "100%";
    tabellaContainerRec.style.pointerEvents = "auto";

  });

//funzione per aprire form di cambiamento messaggi
function apriFormUpdate(button) {
  const formUpdate = document.querySelector("#formUpdateMes");
   //cambio lo stile
  formUpdateMes.style.right = "0";
  tabellaContainerMes.style.width = "52%";
  tabellaContainerMes.style.pointerEvents = "none";
  let elements = document.getElementsByClassName("testoColonna"); // cambio al rimpicciolimento una colonna in particolare dopo 500ms dal verificarsi della funzione
  for (let i = 0; i < elements.length; i++) {
    setTimeout(
      function (index) {
        elements[index].style.width = "30%";
      },
      500,
      i
    );
  }

  let id = button.getAttribute("data-id");
  let nome = button.getAttribute("data-nome");
  let testo = button.getAttribute("data-testo");
  let url_immagine = button.getAttribute("data-url-immagine");
  let social = button.getAttribute("data-social");
  let link = button.getAttribute("data-link");
// compilo di default il form con i dati presi dal database

  document.getElementById("idUpdateMes").value = id;
  document.getElementById("nomeUpdateMes").value = nome;
  document.getElementById("testoUpdateMes").value = testo;
  document.getElementById("urlUpdateProfiloMes").value = url_immagine;
  document.getElementById("socialUpdateNameMes").value = social;
  document.getElementById("socialUpdateUrlMes").value = link;

  document.getElementById("modificaRigaMes").setAttribute("data-val", id);
}



//funzione per aprire form di cambiamento utenti  
function apriFormUpdateUt(button) {
  const formUpdate = document.querySelector("#formUpdateUt");
  // cambio lo stile
  formUpdateUt.style.right = "0";
  tabellaContainerUt.style.width = "70%";
  tabellaContainerUt.style.pointerEvents = "none";

  let id = button.getAttribute("data-id");
  let nome = button.getAttribute("data-nome");
  let password = button.getAttribute("data-password");
  

  //compilo il form di default con i dati presi dal database
  document.getElementById("idUpdateUt").value = id;
  document.getElementById("nomeUpdateUt").value = nome;
  document.getElementById("passwordUpdateUt").value = password;

  document.getElementById("modificaRigaUt").setAttribute("data-val", id);
}
// all'annullamento chiudo il form
document
  .querySelector(".annullaInsertUt")
  .addEventListener("click", function () {
    formInsertUt.style.right = "-800px";
    tabellaContainerUt.style.width = "100%";
    tabellaContainerUt.style.pointerEvents = "auto";
  });

  //mi assicuro che tutti i form siano chiusi
document
  .querySelector(".annullaUpdateUt")
  .addEventListener("click", function () {
    formUpdateUt.style.right = "-800px";
    tabellaContainerUt.style.width = "100%";
    tabellaContainerUt.style.pointerEvents = "auto";
  });

//////////////////////////////////////////////////////////////////////////////


// VISUALIZAZZIONE VISUALIZAZZIONE VISUALIZAZZIONE VISUALIZAZIONE VISUALIZAZIONE

document.addEventListener("DOMContentLoaded", function () {
  let links = document.querySelectorAll("#menuDb ul li a");
  let titles = document.querySelectorAll(".dbTitolo");
  let dbParam = new URLSearchParams(window.location.search).get("db"); // a seconda del valore passato nel url visualizzerò una pagina diversa

  //converto la node list in un array per trovare la corrispondenza dei link con la corrispondenza dei titoli
  let dbIndex = Array.from(links).findIndex((link) =>
    link.href.includes(`?db=${dbParam}`)
  );
  if (dbIndex === -1) dbIndex = 0; // se non trova nessuna elemento selezionerà il primo elemento dell'array e di default mostrerà la pagina con la tabella di accettazione

  // cambio css di conseguenza
  links[dbIndex].classList.add("menuDbSelect");
  titles[dbIndex].style.display = "block";

  let tabellaContainerRec = document.getElementById("tabellaContainerRec");
  let tabellaContainerProg = document.getElementById("tabellaContainerProg");
  let tabellaContainer = document.getElementById("tabellaContainer");
  let tabellaContainerUt = document.getElementById("tabellaContainerUt");

  //stile di default
  tabellaContainerRec.style.display = "none";
  tabellaContainerProg.style.display = "none";
  tabellaContainer.style.display = "none";
  tabellaContainerUt.style.display = "none";

  //cambio stile tabella
  if (!dbParam || dbParam === "conferma") {
    tabellaContainerMes.style.display = "block";
  } else if (dbParam === "recensioni") {
    tabellaContainerRec.style.display = "block";
  } else if (dbParam === "progetti") {
    tabellaContainerProg.style.display = "block";
  } else if (dbParam === "portfolio") {
    tabellaContainer.style.display = "block";
  }
  else if (dbParam === "utenti") {
    tabellaContainerUt.style.display = "block";
  }
});

//codice per uscire dalla sessione
document.getElementById("exit").addEventListener("click", function() {
  const formData = new FormData();
  formData.append('azione', 'logout');

  fetch(window.location.href, {
      method: 'POST',
      body: formData
  }).then(response => {
      window.location.href = 'login.php'; //dove vengo rimandato
  });
});