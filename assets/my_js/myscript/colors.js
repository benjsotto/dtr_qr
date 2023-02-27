/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var edit_url;


function edit_color(color_id)
{
                        $('.color_form').mask('Loading details. Please wait...');
                                    
                        $(".color_form").slideDown(80,function(){
                            $('html, body').animate({
                                scrollTop: parseInt($("#color_form").offset().top)-80
                            }, 1000);
                        });

                        var post_data={};
                        post_data['color_id'] = color_id;
                        $.ajax({
                                url: edit_url,
                                type: 'POST',
                                data: post_data,
                                success:function(result){
                                    var json = $.parseJSON(result);
                                    $(json).each(function(i,val){
                                        $('#color_id_fld').val(val.id_color);
                                        $('#color_name_fld').val(val.color_name);
                                        if(val.w_brand=='1'){ 
                                            $('#w_brand_chk').attr('checked',true);
                                            $('#w_brand_div label div.icheckbox_flat-green').addClass('checked');
                                        } if(val.w_size=='1'){
                                            $('#w_size_chk').attr('checked',true);
                                            $('#w_size_div label div.icheckbox_flat-green').addClass('checked');
                                        } if(val.w_color=='1'){
                                            $('#w_color_chk').attr('checked',true);
                                            $('#w_color_div label div.icheckbox_flat-green').addClass('checked');
                                        }
                                    });

                                    $('.color_form').unmask();
                                }
                        });

}
