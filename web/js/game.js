function Game(){
    // var map = new Map(),
    var drawer, //new Drawer()
        api = new Api(),
        spinner = new Spinner();

    var $butEndTurn = jQuery('.js-end-turn');


    /** init */
    function init() {
        apiInit();
        drawer = new Drawer();
    }
    init();

    function apiInit() {
        spinner.show();

        var
            action = 'init',
            params = {
                afterCallback: spinner.hide //todo почему функция вызывается при передаче в качестве параметра
            };

        api.send(action, null, params);
    }



    /** control */

    $butEndTurn.click(function () {
        //send ajax orders
        spinner.show();

        var
            action = 'test',
            data = {
                orders: drawer.getOrders(),
                looks: drawer.getLooks()
                },
            params = {
                afterCallback: spinner.hide //todo почему функция вызывается при передаче в качестве параметра
            };

        api.send(action, data, params);
    });



}

jQuery(document).ready(function ($) {
    var game = new Game();
});
