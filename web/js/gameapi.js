function Api(_game) {

    /** public methods */

    this.send = function(action, data, params) {
        // console.log(action);
        // console.log(data);
        // console.log(params);

        if (action == undefined) {
            console.error('Undefined action');
            return false;
        }
        if (action == '') {
            console.error('Empty action');
            return false;
        }



        jQuery.ajax({
            url: '/api/' + action,
            ContentType: 'application/json',
            type: 'POST',
            dataType: 'json',
            data:{'data':data}
        }).done(function(responce) {
            switch(action) {
                case 'endturn':
                    _game.endturn(responce);
                    break;
                case 'update':
                    _game.update(responce);
                    break;
                case 'test':
                    console.log('test');
                    console.log(responce);
                    break;
                default:
                    //
            }
        }).always(function() {
            params.afterCallback();
        });
    };

    /** private methods */
    function f1() {}

}