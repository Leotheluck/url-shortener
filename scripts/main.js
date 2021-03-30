console.log("Hello, wolf!")

const sidePanel = document.querySelector('.side-panel')
const sidePanelButton = sidePanel.querySelector('.hide .button')
const shortener = document.querySelector('.container .main')

let isPanel = true

sidePanelButton.addEventListener('click', () => {
    if (isPanel == true) {
        isPanel = false
        sidePanel.style.transform = "translateX(22vw)"
        sidePanelButton.style.transform = "rotateY(0deg)"
        shortener.style.width = "97vw"
        shortener.style.marginRight = "3vw"   
    } else if (isPanel == false) {
        isPanel = true
        sidePanel.style.transform = "translateX(0vw)"
        sidePanelButton.style.transform = "rotateY(180deg)"
        shortener.style.width = "75vw"
        shortener.style.marginRight = "25vw"   
    }
})