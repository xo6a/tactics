function Game(){
    var map = new Map(),
        drawer = new Drawer(),
        api = new Api();


    function init() {
        drawer.init();
    }
    init();
}

var game = new Game();


