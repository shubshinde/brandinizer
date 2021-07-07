
jQuery(document).ready(function(){

    jQuery("input[name='brandinizer_brand_logo_shape']").click(function(){
        
        selected_shape_value = jQuery("input[name='brandinizer_brand_logo_shape']:checked").val();
        
        switch(selected_shape_value){

            case 'square':
                jQuery(".brandinizer-brand-logo").removeClass('rounded-circle');
                break;

            case 'circle':
                jQuery(".brandinizer-brand-logo").addClass('rounded-circle');
                break;

            default:
                jQuery(".brandinizer-brand-logo").addClass('rounded-circle');
                break;
        }
    });
});