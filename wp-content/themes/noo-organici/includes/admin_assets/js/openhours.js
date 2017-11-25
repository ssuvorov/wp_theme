jQuery(document).ready(function(){
    jQuery('.add-hours').live('click',function(){
        var $hours = jQuery(this);
        var $id = $hours.attr('data-num');
        var $new_id = parseInt($id) + 1;
        var $parent = jQuery(this).closest('.widget-content').find('.open-hours');
        jQuery.ajax({
            type: 'POST',
            url: openhours.url,
            data:({
                action: 'add_tab',
                count: $new_id
            }),
            success: function(data){
                if(data){
                    $hours.attr('data-num',$new_id);
                    $parent.append(data);
                }
            }
        })
    });
    jQuery('.add-hours2').live('click',function(){
        var $hours = jQuery(this);
        var $id = $hours.attr('data-num');
        var $new_id = parseInt($id) + 1;
        var $parent = jQuery(this).closest('.widget-content').find('.open-hours');
        jQuery.ajax({
            type: 'POST',
            url: openhours.url,
            data:({
                action: 'add_tab2',
                count: $new_id
            }),
            success: function(data){
                if(data){
                    $hours.attr('data-num',$new_id);
                    $parent.append(data);
                }
            }
        })
    });
    jQuery('.openhours-remove').live('click',function(){
       jQuery(this).parent().remove();
    });
});