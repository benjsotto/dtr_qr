/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var edit_url;


function edit_size(size_id)
{
                        $('.size_form').mask('Loading details. Please wait...');
                                    
                        $(".size_form").slideDown(80,function(){
                            $('html, body').animate({
                                scrollTop: parseInt($("#size_form").offset().top)-80
                            }, 1000);
                        });

                        var post_data={};
                        post_data['size_id'] = size_id;
                        $.ajax({
                                url: edit_url,
                                type: 'POST',
                                data: post_data,
                                success:function(result){
                                    var json = $.parseJSON(result);
                                    $(json).each(function(i,val){
                                        $('#size_id_fld').val(val.id_size);
                                        $('#size_name_fld').val(val.size_name);
                                        $('#category_id_fld').val(val.category_id);
                                        if(val.size_isactive=='1'){
                                            $('#size_isactive_chk').attr('checked',true);
                                            $('#size_isactive_div label div.icheckbox_flat-green').addClass('checked');
                                        }
                                    });

                                    $('.size_form').unmask();
                                }
                        });

}
