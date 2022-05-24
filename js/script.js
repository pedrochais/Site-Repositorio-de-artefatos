let menu = document.getElementsByClassName('opcoes-menu')
let url = document.URL

function scrollToBreakpoint() {
    if (url.includes('buscar') || (url.includes('pagina_atual'))) {
        window.scroll(0, breakpoint.offsetTop)
    }
}

function toggleState() {
    console.log(menu)
    if (url.includes('index.php')) {
        menu[0].classList.add('selected')
        menu[0].classList.remove('opcoes-menu')
    } else if (url.includes('artefatos.php')) {
        menu[1].classList.add('selected')
        menu[1].classList.remove('opcoes-menu')
    } if (url.includes('testes.php')) {
        menu[2].classList.add('selected')
        menu[2].classList.remove('opcoes-menu')
    }
}