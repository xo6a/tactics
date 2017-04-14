function Game(){
    var map = new Map(),
        drawer = new Drawer(),
        api = new Api();


    function init() {
        drawer.init();

        //prevent right click
        document.addEventListener('contextmenu', function(event) {
            event.preventDefault();
        }, true);
    }
    init();
}

var game = new Game();


