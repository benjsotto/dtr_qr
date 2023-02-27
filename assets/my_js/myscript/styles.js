/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var edit_url;


function edit_style(style_id)
{
                        $('.style_form').mask('Loading details. Please wait...');
                                    
                        $(".style_form").slideDown(80,function(){
                            $('html, body').animate({
                                scrollTop: parseInt($("#style_form").offset().top)-80
                            }, 1000);
                        });

                        var post_data={};
                        post_data['style_id'] = style_id;
                        $.ajax({
                                url: edit_url,
                                type: 'POST',
                                data: post_data,
                                success:function(result){
                                    var json = $.parseJSON(result);
                                    $(json).each(function(i,val){
                                        $('#style_id_fld').val(val.id_style);
                                        $('#style_name_fld').val(val.style_name);
                                        $('#type_id_fld').val(val.type_id);
                                        if(val.style_isactive=='1'){
                                            $('#style_isactive_chk').attr('checked',true);
                                            $('#style_isactive_div label div.icheckbox_flat-green').addClass('checked');
                                        }
                                    });

                                    $('.style_form').unmask();
                                }
                        });

}
