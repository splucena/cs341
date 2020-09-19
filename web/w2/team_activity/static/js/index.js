let btnClickMe = document.querySelector('#btn-click-me');
btnClickMe.addEventListener('click', (e) => {
    e.preventDefault();
    console.log(e.target.innerHTML);
    alert('Clicked!');
})

let inputChangeColor = document.querySelector('#input-change-color');
let btnChangeColor = document.querySelector('#btn-change-color');
let divContainerFirstElement = document.querySelector('.div-container > div:nth-child(2)');

btnChangeColor.addEventListener('click', (e) => {
    e.preventDefault();
    let inputChangeColorValue = inputChangeColor.value;
    divContainerFirstElement.style.backgroundColor = inputChangeColorValue;
})