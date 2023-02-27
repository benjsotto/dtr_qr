/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var edit_url;


function edit_type(type_id)
{
                        $('.type_form').mask('Loading details. Please wait...');
                                    
                        $(".type_form").slideDown(80,function(){
                            $('html, body').animate({
                                scrollTop: parseInt($("#type_form").offset().top)-80
                            }, 1000);
                        });

                        var post_data={};
                        post_data['type_id'] = type_id;
                        $.ajax({
                                url: edit_url,
                                type: 'POST',
                                data: post_data,
                                success:function(result){
                                    var json = $.parseJSON(result);
                                    $(json).each(function(i,val){
                                        $('#type_id_fld').val(val.id_type);
                                        $('#type_name_fld').val(val.type_name);
                                        $('#category_id_fld').val(val.category_id);
                                        if(val.type_isactive=='1'){
                                            $('#type_isactive_chk').attr('checked',true);
                                            $('#type_isactive_div label div.icheckbox_flat-green').addClass('checked');
                                        }
                                    });

                                    $('.type_form').unmask();
                                }
                        });

}
