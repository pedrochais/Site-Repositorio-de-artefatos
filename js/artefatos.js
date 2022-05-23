let url = document.URL

function scrollToBreakpoint() {
    if (url.includes('buscar') || (url.includes('pagina_atual'))) {
        window.scroll({
            top: breakpoint.offsetTop,
            left: 0,
            behavior: 'smooth'
        });
    }
}

window.onload = function (){
    scrollToBreakpoint()
}