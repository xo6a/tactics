function Api(){
    
    /** public methods */
    
    this.ajaxEndTurn = function() {
        console.log('ajaxEndTurn');

        data = '{}';

        jQuery.ajax({
            url: '/api/test',
            contentType: 'application/json',
            method: 'POST',
            dataType: 'json',
            data:data
        }).done(function(responce) {
            console.log(responce);
        });
    };

    this.send = function(action, data) {
        console.log(action);
        console.log(data);

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

        }).always(function() {
            data.afterCallback();
        });
    };

    /** private methods */
    function f1() {}

}