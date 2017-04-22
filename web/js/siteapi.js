function Api(){
    
    /** public methods */
    
    this.send = function(params) {
        console.log('send');

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