let images = document.querySelectorAll('.img');
let currentIndex = 0;
let fadeDuration = 3500; 
let displayTime = 2500;  
let delayAfterCycle = 3400; 

function fadeImages() {
    images.forEach((img, index) => {
        img.classList.add('fade');
    });

    setTimeout(() => {
        images.forEach((img) => {
            img.classList.remove('fade'); 
        });
    }, fadeDuration);
}

setInterval(() => {
    fadeImages();
}, displayTime + fadeDuration + delayAfterCycle); 

let text = document.querySelector('.fade-text');

function fadeText() {
    text.classList.add('fade');

    setTimeout(() => {
        text.classList.remove('fade');
    }, fadeDuration);
}

setInterval(() => {
    fadeText();
    fadeImages(); 
}, displayTime + fadeDuration + delayAfterCycle);

