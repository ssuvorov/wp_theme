
jQuery(document).ready(function(){
    "use strict";
    // woo control
    jQuery('span.noo-list').click(function(){
        jQuery('span.noo-grid').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('.noo-row').removeClass('product-grid').addClass('product-list');
        setCookie("product-list", 'list', 30);
        noo_removeCookie('product-grid');
    });

    jQuery('span.noo-grid').click(function(){
        jQuery('span.noo-list').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('.noo-row').removeClass('product-list').addClass('product-grid');
        setCookie("product-grid", 'grid', 30);
        noo_removeCookie('product-list');
    });

    if( getCookie('product-list') == 'list' ){
        jQuery('span.noo-list').addClass('active');
        jQuery('span.noo-grid').removeClass('active');
        jQuery('.post-type-archive .noo-row').removeClass('product-grid').addClass('product-list');
    }
    if( getCookie('product-grid') == 'grid' ){
        jQuery('span.noo-grid').addClass('active');
        jQuery('span.noo-list').removeClass('active');
        jQuery('.post-type-archive .noo-row').removeClass('product-list').addClass('product-grid');
    }

    //quick view
    jQuery('.noo-qucik-view').on('click',function(event){
        event.preventDefault();
        var p_id  = jQuery(this).data('id');
        var $html = '';
            $html += '<div class="quick-view-wrap">';
                $html += '<p class="quick-loading">loading...</p>';
                $html += '<div class="quick-content woocommerce">';
                $html +=  '<button title="Close (Esc)" class="quickview-close"></button>';
                $html += '</div>';
            $html += '</div>';
        jQuery('body').append($html);

        jQuery.ajax({
            type: 'post',
            url : noo_new.ajax_url,
            data: ({
                action: 'noo_organici_product_quick_view',
                p_id: p_id
            }),
            success: function(data){
                if(data){
                    jQuery('.quick-loading').remove();
                    jQuery('.quick-content').append(data).addClass('eff');

                }

            }
        })

    });

    jQuery('body').on('click','.quickview-close',function(){
        jQuery('.quick-content').removeClass('eff');
        var myvar ;
        myvar = setTimeout(function(){
            jQuery('.quick-view-wrap').remove();
        }, 400);

        clearTimeout(myVar);
    });

});
function setCookie(name,value,days) {
    "use strict";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(cname) {
    "use strict";
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function noo_removeCookie(name) {
    "use strict";
    setCookie(name,"",-1);
}


jQuery(window).load(function(){
    "use strict";
    jQuery('.noo-page-heading').addClass('eff');
    jQuery('.page-title').addClass('eff');
    jQuery('.noo-page-breadcrumb').addClass('eff');
    jQuery('.noo-spinner').remove();
});

