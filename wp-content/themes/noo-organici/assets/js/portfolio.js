jQuery(document).ready(function(){
    "use strict";
    var $container = jQuery('.noo-product-grid');
    //Init masonry isotope
    var $filter = jQuery('.masonry-filters a');
    $filter.click(function(e){
        e.stopPropagation();
        e.preventDefault();
        var $this = jQuery(this);
        // don't proceed if already selected
        if ($this.hasClass('selected')) {
            return false;
        }
        var filters = $this.closest('ul');
        filters.find('.selected').removeClass('selected');
        $this.addClass('selected');

        var options = {},
            key = filters.attr('data-option-key'),
            value = $this.attr('data-option-value');

        value = value === 'false' ? false : value;
        options[key] = value;

        $container.isotope(options);

    });

});


