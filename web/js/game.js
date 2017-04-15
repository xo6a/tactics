function Game(){
    var map = new Map(),
        drawer = new Drawer(),
        api = new Api(),
        playerId = 1;

    var $butEndTurn = jQuery('.js-end-turn');


    /** init */
    function init() {
        drawer.init();
    }
    init();

    $butEndTurn.click(function () {
        //send ajax orders
        var orders = drawer.getOrders();

        api.ajaxEndTurn();
    });

}

jQuery( document ).ready(function($) {
    var game = new Game();
});
