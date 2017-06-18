function Spinner(){

    var spinnerHtml = '<div id="spinner" style="position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,0.5);"><div class="loader" style="position:relative;left:50%;top:50%;margin:-60px;"></div></div>';
    var $spinner;

    function init(){
        jQuery('body').append(spinnerHtml);
        $spinner = jQuery('#spinner');
    }
    init();

    this.show = function(){
        // console.log('show spin');
        $spinner.css('display','block');
    };


    this.hide = function(){
        // console.log('hide spin');
        $spinner.css('display','none');
    };

    this.hide();
}