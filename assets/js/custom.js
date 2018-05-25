$(document).ready(function(){
    $("#fields_no").keyup(function(){
        var num= $(this).val();
        $('.fields').empty();
        $('.fields').append('<label>Field Names in Table</label>');
        for(var i=1;i<=num;i++){
            $('.fields').append('<div class="form-group"><label>'+i+'.</label><input name="fields[]"  class="form-control"  value=""/></div>');
        }
    });
    $("#submit").click(function(){
        $.ajax({
            url:base_url+"Crud/generate_code",
            type:"POST",
            data:$("#crud_form").serialize(),
            success:function(response){
                response= JSON.parse(response);
                //add
                $("#add_tab").empty();
                $("#add_tab").append("<h4>Controller</h4><pre class='pre-scrollable'>"+response.add.back+"</pre>");
                //edit
                $("#edit_tab").empty();
                $("#edit_tab").append("<h4>Controller</h4><pre class='pre-scrollable'>"+response.edit.back+"</pre>");
                //delete
                $("#delete_tab").empty();
                $("#delete_tab").append("<h4>Controller</h4><pre class='pre-scrollable'>"+response.delete.back+"</pre>");
                
                $(".tabs_div").slideDown();
            }
        }); 
    });

});