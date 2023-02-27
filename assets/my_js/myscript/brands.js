/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var edit_url;


function edit_brand(brand_id)
{
                        $('.brand_form').mask('Loading details. Please wait...');
                                    
                        $(".brand_form").slideDown(80,function(){
                            $('html, body').animate({
                                scrollTop: parseInt($("#brand_form").offset().top)-80
                            }, 1000);
                        });

                        var post_data={};
                        post_data['brand_id'] = brand_id;
                        $.ajax({
                                url: edit_url,
                                type: 'POST',
                                data: post_data,
                                success:function(result){
                                    var json = $.parseJSON(result);
                                    $(json).each(function(i,val){
                                        $('#brand_id_fld').val(val.id_brand);
                                        $('#brand_name_fld').val(val.brand_name);
                                        $('#category_id_fld').val(val.category_id);
                                        if(val.brand_isactive=='1'){
                                            $('#brand_isactive_chk').attr('checked',true);
                                            $('#brand_isactive_div label div.icheckbox_flat-green').addClass('checked');
                                        }
                                    });

                                    $('.brand_form').unmask();
                                }
                        });

}
