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

    this.send = function(params) {
        console.log(params);

        data = '{}';

        jQuery.ajax({
            url: '/api/createroom',
            contentType: 'application/json',
            method: 'POST',
            dataType: 'json',
            data:data
        }).done(function(responce) {

        }).always(function() {
            if (params.afterCallback != undefined)
                params.afterCallback();
        });
    };

    /** private methods */
    function _f1() {}

}