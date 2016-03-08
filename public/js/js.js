/**
 * Created by pat on 3/8/2016.
 */
$(document).ready(function(){
    +function(){
        $('select.filter').on('change', function(e){
            $select = $(this);
            $form = $select.parents('form');
            $filter = $form.find("input[name='filter']");
            $value  = $form.find("input[name='value']");

            $filter.val($select.attr('name'));
            $value.val($select.val());
            $form.trigger('submit');
        });
    }();
});