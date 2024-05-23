//in questa pagina gestisco l'animazione delle particelle della homepage 



// funzione per ottenere la posizione dell'elemento canvas rispetto allo schermo
function getCanvasPosition(canvas) { 
    let rect = canvas.getBoundingClientRect();
    return {

      // accedo alla posizione rispetto all'asse verticale e orizzontale
      x: rect.left,
      y: rect.top,
    };
  }
  
  const canvas = document.getElementById("canvas");
  const ctx = canvas.getContext("2d"); //definisco la struttura su cui inserirò le grafiche
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  
 //definisco il gradiente delle particelle, tuttavia per il momento non sto usando questa possibilità per rendere più semplice la grafica, ma lascio aperta la possibilità in futuro
  const gradient = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
  gradient.addColorStop(0, "#4d4b4b17");
  gradient.addColorStop(0.5, "#4d4b4b17");
  gradient.addColorStop(1, "#4d4b4b17");
  ctx.fillStyle = gradient;
  ctx.strokeStyle = "rgba(158, 158, 158, 0.1)"; //colore linee di unione
  

  //classe per definire le particelle
  class Particle {
    constructor(Effect) { //nel costruttore passo le informazioni della classe effect
      this.effect = Effect;
      this.radius = Math.floor(Math.random() * 10 + 1);  //dimensione particella casuale
      this.x =
        this.radius + Math.random() * (this.effect.width - this.radius * 2); //coordinata x per la posizione orizzontale
      this.y = Math.random() * this.effect.height - this.radius * 2; //coordinata y per la posizione verticale
      //velocità casuale delle particelle lungo i due assi
      this.vx = Math.random() * 1 - 0.5; 
      this.vy = Math.random() * 1 - 0.5;
      //la spinta del mouse è inizialmente nulla
      this.pushX = 0;
      this.pushY = 0;
      this.friction = 0.4; //questa è la forza che si opporrà alla spinta del mouse
    }
    //ora disegno effettivamente la particella
    draw(context) {
      context.beginPath();
      context.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
      context.fill();
      // context.stroke();
    }
    update() {
      if (this.effect.mouse.pressed) { // controlla se è premuto il mouse
        // colo posizioni dal mause alla particella
        const dx = this.x - this.effect.mouse.x;
        const dy = this.y - this.effect.mouse.y;
        const distance = Math.hypot(dx, dy);
        const force = this.effect.mouse.radius / distance; //la forza cambia a seconda della distanza del mouse
        //se abbastanza vicino il mouse applico lo spostamento
        if (distance < this.effect.mouse.radius) {
          const angle = Math.atan2(dy, dx);
          this.pushX += Math.cos(angle) * force;
          this.pushY += Math.sin(angle) * force;
        }
      }
      //aggiungo la forza di resistenza
      this.x += (this.pushX *= this.friction) + this.vx;
      this.y += (this.pushY *= this.friction) + this.vy;
      //la particella torna indietro se è contro uno dei quattro bordi dello schermo
      if (this.x < this.radius) {
        this.x = this.radius;
        this.vx *= -1;
      } else if (this.x > this.effect.width - this.radius) {
        this.x = this.effect.width - this.radius;
        this.vx *= -1;
      }
      if (this.y < this.radius) {
        this.y = this.radius;
        this.vy *= -1;
      } else if (this.y > this.effect.height - this.radius) {
        this.y = this.effect.height - this.radius;
        this.vy *= -1;
      }
    }
    
  }
  
  class Effect {
    //classe che genera il contenuto del canvas
    constructor(canvas, context) {
      this.canvas = canvas;
      this.context = context;
      this.width = this.canvas.width;
      this.height = this.canvas.height;
      this.particles = [];
  
      //il numero delle particelle è differente a seconda dello schermo
      if (window.innerWidth > 800) {
        this.numberOfParticles = 150;
      } else if (window.innerWidth > 500) {
        this.numberOfParticles = 100;
      } else {
        this.numberOfParticles = 50;
      }
  
      this.createParticles();
  
      //definisco la grandezza del mouse
      this.mouse = {
        x: 0,
        y: 0,
        pressed: false, 
        radius: 120,
      };
  
      //gestisco il ridimensionamento del canvas in base allo schermo
      window.addEventListener("resize", (e) => {
        this.resize(e.target.window.innerWidth, e.target.window.innerHeight);
      });

      //attivo l'effetto (originariamente l'effetto era dato dal click del mouse, ma in precedenza ho invertito i parametri ed ora è un effetto hover)    
  
      window.addEventListener("mousemove", (e) => {
        let canvasPos = getCanvasPosition(canvas);
        this.mouse.x = e.clientX - canvasPos.x;
        this.mouse.y = e.clientY - canvasPos.y;
        this.mouse.pressed = true; //false crea un effetto hover e non click del mouse
      });
  
    }
    //creo la particella 
    createParticles() {
      for (let i = 0; i < this.numberOfParticles; i++) {
        this.particles.push(new Particle(this));
      }
    }
    handleParticles(context) {
      this.connectParticles(context);
      this.particles.forEach((particle) => {
        particle.draw(context);
        particle.update();
      });
    }
    //creo la linea che unisce le particelle e faccio in modo che l'opacità cambi a seconda della vicinanza con le sfere
    connectParticles(context) {
      const maxDistance = 80;
      for (let a = 0; a < this.particles.length; a++) {
        for (let b = a; b < this.particles.length; b++) {
          const dx = this.particles[a].x - this.particles[b].x;
          const dy = this.particles[a].y - this.particles[b].y;
          const distance = Math.hypot(dx, dy);
          if (distance < maxDistance) {
            context.save();
            const opacity = 1 - distance / maxDistance;
            context.globalAlpha = opacity;
            context.beginPath();
            context.moveTo(this.particles[a].x, this.particles[a].y);
            context.lineTo(this.particles[b].x, this.particles[b].y);
            context.stroke();
            context.restore();
          }
        }
      }
    }
    //gestisco la ridimensione dello schermo anche in questa classe
    resize(width, height) {
      this.canvas.width = width;
      this.canvas.height = height;
      this.width = width;
      this.height = height;
  
      if (window.innerWidth > 800) {
        this.numberOfParticles = 150;
      } else if (window.innerWidth > 500) {
        this.numberOfParticles = 100;
      } else {
        this.numberOfParticles = 50;
      }
  
      
      this.particles = [];
      this.createParticles();
  
      //gestisco il colore del tutto anche in questa classe
      const gradient = this.context.createLinearGradient(0, 0, width, height);
      gradient.addColorStop(0, "#4d4b4b17");
      gradient.addColorStop(0.5, "#4d4b4b17");
      gradient.addColorStop(1, "#4d4b4b17");
      this.context.fillStyle = gradient;
      this.context.strokeStyle = "rgba(158, 158, 158, 0.1)";
    }
  }
  const effect = new Effect(canvas, ctx);
  
  // questa funzione, collegata alle classi chiama il canvas completo di animazioni
  function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    effect.handleParticles(ctx);
    requestAnimationFrame(animate);
  }
  
  animate();