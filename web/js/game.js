function Game() {
    // var map = new Map(),
    var drawer, //new Drawer()
        api = new Api(this),
        spinner = new Spinner(),
        doUpdate = false,
        UPDATE_INTERVAL = 1000;

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
                afterCallback: spinner.hide
            };

        api.send(action, null, params);
    }


    /** control */

    $butEndTurn.on("click", function () {
        //send ajax orders
        spinner.show();

        var
            action = 'endturn',
            data = {
                orders: drawer.getOrders(),
                looks: drawer.getLooks()
            },
            params = {
                afterCallback: endTurn
            };

        api.send(action, data, params);
    });

    function endTurn () {
        spinner.hide();
        setWait();
    }

    function setWait() {
        doUpdate = true;
    }

    function unsetWait() {
        doUpdate = false;
    }



    /** timer */

    window.setInterval(function() {
        update();
    }, UPDATE_INTERVAL);

    function update() {
        if (!doUpdate)
            return false;

        console.log('update');

        //send ajax orders
        spinner.show();

        var
            action = 'update',
            data = {
                orders: drawer.getOrders(),
                looks: drawer.getLooks()
            },
            params = {
                afterCallback: updated
            };

        api.send(action, data, params);
    }

    function updated() {
        unsetWait();
        spinner.hide();
    }



    /** public methods */

    this.update = function () {
        console.log('update game');

    };

    this.endturn = function () {
        console.log('endturn game');
        
    };

}

jQuery(document).ready(function ($) {
    var game = new Game();
});
