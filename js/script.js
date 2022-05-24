let url = document.URL
let menu = document.getElementsByClassName('opcoes-menu')

window.onload = function (){
    if (url.includes('index.php')) {
        menu[0].classList.add('selected')
    }else if (url.includes('artefatos.php')){
        menu
        menu[1].classList.add('selected')
    }if (url.includes('testes.php')) {
        menu[2].classList.add('selected')
    }
}

function scrollToBreakpoint() {
    if (url.includes('buscar') || (url.includes('pagina_atual'))) {
        window.scroll(0, breakpoint.offsetTop)
    }
}