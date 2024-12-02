let cardIndex = 0;

function mostrarCard(index) {
    const cards = document.querySelectorAll('.card_dia');
    if (index >= cards.length) cardIndex = 0;
    if (index < 0) cardIndex = cards.length - 1;
    
    const offset = -cardIndex * 100; // Mova para a esquerda
    document.querySelector('.slides').style.transform = `translateX(${offset}%)`;

    cards.forEach((card, i) => {
        card.classList.toggle('ativo', i === cardIndex);
    });
}

function mudarCard(n) {
    cardIndex += n;
    mostrarCard(cardIndex);
}

// Inicializa o carrossel
mostrarCard(cardIndex);