const graphSymbol = document.querySelector('.graph-symbol');
let count = 0;

graphSymbol.addEventListener('click', () => {
  if (count < 5) {
    const newSymbol = document.createElement('div');
    newSymbol.classList.add('graph-symbol', 'active');
    graphSymbol.appendChild(newSymbol);
    count++;
  }
});
