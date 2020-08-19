const TxtRotate = function(el, toRotate, period) {
  this.toRotate = toRotate;
  this.el = el;
  this.loopNum = 0;
  this.period = parseInt(period, 10) || 3000;
  this.txt = '';
  this.tick();
  this.isDeleting = false;
};



TxtRotate.prototype.tick = function() {
  let i = this.loopNum % this.toRotate.length;
  let fullTxt = this.toRotate[i]; 
  if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
  } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
  }

  this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

  const that = this;
  let delta = 300 - Math.random() * 300;

  if (this.isDeleting) { delta /= 2; }

  if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
  } else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
  }

  setTimeout(function() {
    that.tick();
  }, delta);
};

  
  window.onload = function() {
    const elements = document.getElementsByClassName('txt-rotate');
    for (let i=0; i<elements.length; i++) {
      let toRotate = elements[i].getAttribute('data-rotate');
      let period = elements[i].getAttribute('data-period');
      if (toRotate) {
        new TxtRotate(elements[i], JSON.parse(toRotate), period);
      }
    }
    // INJECT CSS
    const css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".txt-rotate > .wrap { border-right: 0.1em solid white;  height: 40px; display: inline-block;}";
   
    

    function blink() {
        if (window.innerWidth == 500) {
        
          if(css.innerHTML === ".txt-rotate > .wrap { border-right: 0.1em solid white; padding: 2%; height: 40px; display: inline-block;}") {
            css.innerHTML = ".txt-rotate > .wrap { border-right: 0.1em solid rgba(0, 0, 0, 0); padding: 2%; height: 40px; display: inline-block;}"
         } else {
             css.innerHTML = ".txt-rotate > .wrap { border-right: 0.1em solid white; padding: 2%; height: 40px; display: inline-block;}"
         }
        } else if (window.innerWidth > 500) {
          
          if(css.innerHTML === ".txt-rotate > .wrap { border-right: 0.1em solid white; padding: 2%; height: 40px; display: inline-block;}") {
            css.innerHTML = ".txt-rotate > .wrap { border-right: 0.1em solid rgba(0, 0, 0, 0); padding: 2%; height: 40px; display: inline-block;}"
         } else {
             css.innerHTML = ".txt-rotate > .wrap { border-right: 0.1em solid white; padding: 2%; height: 40px; display: inline-block;}"
         }
        }
        


    }

    setInterval(blink, 400)

    document.body.appendChild(css);
  };

let image = document.querySelector('.image')
let counter = 0;

function imageCycle() {


  if (image.hasAttribute("src") && counter < 5) {
    counter++;
    image.setAttribute("src", `./img/${counter}.png`)

  } else if (image.hasAttribute("src") && counter == 5) {
    counter = 0;
  }

    
}

setInterval(imageCycle, 1000)  
