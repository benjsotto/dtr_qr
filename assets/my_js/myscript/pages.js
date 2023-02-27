/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var edit_url;
var save_url;
var load_url;
var delete_url;

function load_pages()
{
        var post_data={};
        $.ajax({
                url: load_url,
                type: 'POST',
                data: post_data,
                success:function(result){
                    $('#load_result').html(result);
                }
        });

}

function clear()
{
        $('#page_id').val('');
        $('#page_name').val('');
        $('#page_parent').val('0');
        $('#class_name').val('');
        $('#position').val('');
        $('#menu_icon').val('');
        $('#menu_id').val('');
        $('#has_children').val('0');
        $('#is_menu').val('1');
        $('#with_count').val('0');
}


function remove_errors()
{
        $('#page_name_form_div').attr('class','col-sm-8');
        $('#page_name_error_label').hide();
        $('#class_name_form_div').attr('class','col-sm-8');
        $('#class_name_error_label').hide();
        $('#position_form_div').attr('class','col-sm-8');
        $('#position_error_label').hide();

}


$(".add_button").on('click',function(){
        $("#page_form").slideDown(80,function(){
            $('html, body').animate({
                scrollTop: parseInt($("#new_form").offset().top)-90
            }, 1000);
        });
});


$("#cancel").on('click',function(){
        clear();
        remove_errors();
//        $("#page_form").slideUp();
});

$("#save_page").on('click',function(){
        remove_errors();
        var error = 0;

        if($('#page_name').val()==''){
                $('#page_name_form_div').attr('class','col-sm-8 has-error has-feedback');
                $('#page_name_error_label').show();
                error = 1;
        } 

        if($('#class_name').val()==''){
                $('#class_name_form_div').attr('class','col-sm-8 has-error has-feedback');
                $('#class_name_error_label').show();
                error = 1;
        } 

//        if($('#position').val()==''){
//                $('#position_form_div').attr('class','col-sm-8 has-error has-feedback');
//                $('#position_error_label').show();
//                error = 1;
//        } 
        if(error==0){
                $('#tbl_pages').mask('Updating pages. Please wait...');
                var post_data={};                        
                post_data['page_id'] = $('#page_id').val();
                post_data['page_name'] = $('#page_name').val();
                post_data['page_parent'] = $('#page_parent').val();
                post_data['class_name'] = $('#class_name').val();
                post_data['position'] = $('#position').val();
                post_data['menu_icon'] = $('#menu_icon').val();
                post_data['menu_id'] = $('#menu_id').val();
                post_data['has_children'] = $('#has_children').val();
                post_data['is_menu'] = $('#is_menu').val();
                post_data['with_count'] = $('#with_count').val();

                $.ajax({
                        url: save_url,
                        type: 'POST',
                        data: post_data,
                        success:function(result){
//                                $("#page_form").slideUp();
                                if(result==1){
                                    $('#success').html('Successfully saved.');
                                    $('#success').show();
                                } else {
                                    $('#error').html('Error! Something went wrong while saving.');
                                    $('#error').show();
                                }
                                clear();
                                //load_pages();
                                location.reload();
                        }
                });		
        }
}); 


function edit_page(page_id)
{
        $('.x_content').mask('Loading details. Please wait...');
        $("#page_form").slideDown(80,function(){
            $('html, body').animate({
                scrollTop: parseInt($("#new_form").offset().top)-90
            }, 1000);
        });

        var post_data={};
        post_data['page_id'] = page_id;
        $.ajax({
                url: edit_url,
                type: 'POST',
                data: post_data,
                success:function(result){
                    var json = $.parseJSON(result);
                    $(json).each(function(i,val){
                        $('#page_id').val(val.id_page);
                        $('#page_name').val(val.page_name);
                        $('#page_parent').val(val.page_parent);
                        $('#class_name').val(val.class_name);
                        $('#position').val(val.position);
                        $('#menu_icon').val(val.menu_icon);
                        $('#menu_id').val(val.menu_id);
                        $('#has_children').val(val.has_children);
                        $('#is_menu').val(val.is_menu);
                        $('#with_count').val(val.with_count);
                    });
                    $('.x_content').unmask();
                }
        });

}

function delete_page(page_id)
{
        var post_data={};
        post_data['page_id'] = page_id;
        $.ajax({
                url: delete_url,
                type: 'POST',
                data: post_data,
                success:function(result){
                    if(result==1){
                        $('#success').html('Successfully deleted.');
                        $('#success').show();
                    } else {
                        $('#error').html('Deleting failed.');
                        $('#error').show();
                    }
                    clear();
                    load_pages();
                }
        });
}


/*   this validation for numbers   */
	function validatewholenum(evt) {
	  var theEvent = evt || window.event;
	  var key = theEvent.keyCode || theEvent.which;
	  key = String.fromCharCode( key );
	  var regex = /[0-9]|[\b]|[\t]/;
	  if( !regex.test(key) ) {
		theEvent.returnValue = false;
		if(theEvent.preventDefault) theEvent.preventDefault();
	  }
	}
	