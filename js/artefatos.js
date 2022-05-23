let url = document.URL

function scrollToBreakpoint() {
    if (url.includes('buscar') || (url.includes('pagina_atual'))) {
        window.scroll(0, breakpoint.offsetTop)
    }
}

window.onload = function (){
    scrollToBreakpoint()
}