let slider = document.getElementById('slider');
let image = document.querySelectorAll('#overlay-img')
let row = document.querySelector('.row').offsetHeight;




for (let i = 0; i < image.length; i++) {
    image[0].style.display = "none"
}

slider.addEventListener('mouseup', () => {
    let sliderValue = slider.value;
    for(let i = 0; i < image.length; i++) {
        if (slider.value == 0) {
            image[0].style.display = "none";
            image[1].style.display = "block";
        } else if (slider.value == 1) {
            image[1].style.display = "none";
            image[0].style.display = "block";
        }
    }
})


let counter = 0;

function imageCycle() {
    for (let i = 0; i<image.length; i++) {
        counter+= 1;
        if (image[i].hasAttribute("src") && counter < 13) {

            image[i].setAttribute("src", `./public/img/slides/${counter}.jpg`)

        
          } else if (image[i].hasAttribute("src") && counter == 13) {
            counter = 0;
          }
        
    }

  
    
}

setInterval(imageCycle, 300)  
