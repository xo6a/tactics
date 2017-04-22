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


    /** private methods */
    function _f1() {}

}