
jQuery(document).ready(function(){
    jQuery('#block-footerquicklinks select').val('');
});

jQuery('#block-footerquicklinks select').change(function(e){
    if(e.target.value != ''){
        window.location = e.target.value;
    }
});
