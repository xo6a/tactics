function Game(){
    // var map = new Map(),
    var drawer, //new Drawer()
        api = new Api(),
        spinner = new Spinner();

    var $butEndTurn = jQuery('.js-end-turn');


    /** init */
    function init() {
        drawer = new Drawer();
    }
    init();



    /** control */

    $butEndTurn.click(function () {
        //send ajax orders
        spinner.show();

        var
            data = {
                orders: drawer.getOrders(),
                looks: drawer.getLooks(),
                afterCallback: spinner.hide //todo почему функция вызывается при передаче в качестве параметра
            };

        api.send('test',data);
    });



}

jQuery(document).ready(function ($) {
    var game = new Game();
});
