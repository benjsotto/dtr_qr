/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var load_items_url;

function load_items()
{
    
        $('#items_div').mask('Loading. Please wait...');
        var post_data={};
        post_data['sale_id']=$('#sale_id').val();
        $.ajax({
                url: load_items_url+'/'+$('#sale_id').val(),
                type: 'POST',
                data: post_data,
                success:function(result){
                    $('#items_div').html(result);
                }
        });
}

function load_total_amount()
{
    
}
        
//        function compute_total_item()
//        {
//                var payment_total = parseFloat($('#payment_total').val());
//                var total_amount = parseFloat($('#total_amount').val());
//                var amount_due = total_amount-payment_total;
//                $('#amount_due').html('Php ' + amount_due);
//                
//                $('#total_amount').val(amount_due);
//                $('#total_amount_lbl').html('Php ' + amount_due);
//        }

                
//------SEARCH item enter -------------------------------
    
                
//add-item button
/*$('#add-item_btn').on("click", function(){
        if($('#item_code').val()!=''){
            showmodal();
        } else {
            alert('No item selected.')
        }
});*/

var get_item_url;
                //add-item button
                $('#add-item_btn').on("click", function(){
                    
                        var item_id =$('#item_input').val();
                        
                        if(item_id==''){
                                alert('No item selected.')
                        } else {
                            
                                $('#register_div').mask();
                                var post_data={};
                                post_data['item_id']=item_id;
                                $.ajax({
                                        url: get_item_url,
                                        type: 'POST',
                                        data: post_data,
                                        success:function(result){
                                            var json = $.parseJSON(result);
                                            $(json).each(function(i,val){
                                                
                                                    $('#item_code').val(val.item_code);
                                                    $('#item_name').val(val.item_name);
                                                    $('#item_id').val(val.item_id);
                                                    $('#unit_price').val(val.unit_price);
                                                    $('#unit_price_desc').val(val.price_desc);
                                                    $('#unit_price_desc2').html(val.price_desc);
                                                    $('#promo_desc').val(val.promo_desc);
                                            });
                                            showmodal();
                                        }
                                });
                        }
                });
                
                
                function showmodal()
                {
                        $("#myModal").modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false,
                            backdrop: 'static',
                            keyboard: false
                        });
                }
                
            //-------------------------------------------------------------
            
            
            
                
            //------input item QUANTITY -------------------------------
                
                $('#recitem_qty').keypress(function (e) {
                    if (e.which == 13) {
                        enter_item();
                        return false; 
                    }
                });
                
                
                $('.add-item_btn2').on("click", function(){
                        enter_item();
                });
                
                function enter_item()
                {
                        if($('#recitem_qty').val()!='0' && $('#recitem_qty').val()!=''){
                            $("#myModal").modal("hide");
                            $("#sale_form").submit();
                        } else {
                            alert('Invalid quantity.');
                            $('#recitem_qty').focus().select();
                            return false; 
                        }
                }
            
            //-------------------------------------------------------------
            
            //------CANCEL item -------------------------------
                $('#cancel_item').on("click", function(){
                        $("#myModal").modal("hide");
                        clear();
                        $('#register_div').unmask();
                });
                
                function clear()
                {
                        $('#item_input').val('');
                        $('#item_name').val('');
                        $('#item_code').val('');
                        $('#item_id').val('');
                        $('#unit_price').val('');
                        $('#recitem_qty').val('1');
                        $('#unit_price_desc').val('');
                        $('#unit_price_desc2').html('');
                        $('#promo_desc').val('');
                        $('#item_discount').val('');
                        $('#item_remarks').val('');
                }
            //-------------------------------------------------------------
            
        
            //------REMOVE item -------------------------------------------
            
                /*
                var remove_item_url;
            
                function remove_item(item_id,price){
                            
                        //--------unfinished
//                        var subtotal = parseFloat($('#subtotal').val());
//                        var item_price = parseFloat(price);
//                        var new_subtotal = subtotal-item_price;
//                        
//                        $('#subtotal').val(new_subtotal);
//                        $('#subtotal_lbl').html(new_subtotal);
//                          
                        //--------unfinished

                    
                            
                        $('#register_div').mask('Loading. Please wait...');
                        //var item_id = $(this).attr('id');
                        var post_data={};
                        post_data['item_id'] = item_id;
                        post_data['item_name'] = $('#name_'+item_id+'').html();
                        post_data['sale_id']=$('#sale_id').val();
                        $.ajax({
                                url: remove_item_url,
                                type: 'POST',
                                data: post_data,
                                success:function(result){
                                    $('#register_div').unmask();
                                    if(result=='1'){
                                        alert('Item successfully removed');
                                    } else {
                                        alert('Something went wrong while removing item.');
                                    }
                                    load_items();
                                }
                        });
                        
                }
                */
            //-------------------------------------------------------------
            
            
            
            //------SUPPLIER-------------------------------
                var update_customer_url;
            
                $('#customer').on("change", function(){
                    
                        if($('#sale_id').val()!=''){
                            
                                $('#register_div').mask('Loading. Please wait...');
                                
                                var post_data={};
                                post_data['customer']=$('#customer').val();
                                post_data['sale_id']=$('#sale_id').val();
                                $.ajax({
                                        url: update_customer_url,
                                        type: 'POST',
                                        data: post_data,
                                        success:function(result){
                                            $('#register_div').unmask();
                                        }
                                });
                        }
                });
            
            //-------------------------------------------------------------
            
            //------is QUOTE-------------------------------
                var update_isquote_url;
            
                $('input#isquote').on('ifChecked', function(event){
                    $('#isquote').attr('checked','checked');
                    save_isquote(1);
                });
                $('input#isquote').on('ifUnchecked', function(event){
                    $('#isquote').removeAttr('checked');
                    save_isquote(0);
                });
                
                function save_isquote(isquote){
                    //alert(isquote)
                        if($('#sale_id').val()!=''){
                            
                                $('#isquote2').val(isquote);
                        
                                $('#register_div').mask('Loading. Please wait...');
                                
                                var post_data={};
                                //var quote_chk 
                                post_data['isquote']=isquote;
                                post_data['sale_id']=$('#sale_id').val();
                                $.ajax({
                                        url: update_isquote_url,
                                        type: 'POST',
                                        data: post_data,
                                        success:function(result){
                                            $('#register_div').unmask();
                                        }
                                });
                        }
                }
            
            //-------------------------------------------------------------
            
            
            //------SALE TYPE-------------------------------
                var update_type_url;
            
                $('.sale_type').on('ifChecked', function(event){
                        var sale_type = $(this).val();
                    
                        $('#sale_type2').val(sale_type);
                        
                        if($('#sale_id').val()!=''){
                            
                                $('#register_div').mask('Loading. Please wait...');
                                
                                var post_data={};
                                //var quote_chk 
                                post_data['sale_type']=sale_type;
                                post_data['sale_id']=$('#sale_id').val();
                                $.ajax({
                                        url: update_type_url,
                                        type: 'POST',
                                        data: post_data,
                                        success:function(result){
                                            $('#register_div').unmask();
                                        }
                                });
                        }
                });
            
            //-------------------------------------------------------------
            
            
// ----------------PAYMENT----------------------------
            
        $('#payment_amount,#item_discount').on('focus',function(){
            if ($(this).val() == '0.00' || $(this).val() == 0) {
                    $(this).val('');
            }
        });

        $('#payment_amount,#item_discount').on('blur',function(){
            if ($(this).val() == '' || $(this).val() == 0) {
                    $(this).val('0.00');
            }
        });


        var add_payment_url;
        
        $('#payment_amount').keypress(function (e) {
                if (e.which == 13){
                    
                    var payment = parseFloat($('#payment_amount').val());
                    
                    if($('#payment_amount').val()!='' && payment>0) {
                
                        save_payment();

                    }
                }
        });
        
        $('#add_payment_button').on('click',function(){
            
            var payment = parseFloat($('#payment_amount').val());
            
            if(payment>0){
                
                    save_payment();
                    
            } else {
                
                alert('Please input valid payment amount.')
            }
        });
        
        function save_payment()
        {
            $('.register-summary').mask('Loading. Please wait...');
            var post_data={};
            post_data['payment_amount']=$('#payment_amount').val();
            post_data['payment_type']=$('#payment_type').val();
            post_data['sale_id']=$('#sale_id').val();
            $.ajax({
                    url: add_payment_url,
                    type: 'POST',
                    data: post_data,
                    success:function(result){
                        //$('.register-summary').html(result);
                        load_payments();
                        $('#payment_amount').val('0.00');
                    }
            });
        }
        
        var load_payments_url;
        function load_payments()
        {
                $('.register-summary').mask('Loading. Please wait...');
                var post_data={};
                //post_data['sale_id']=$('#sale_id').val();
                $.ajax({
                        url: load_payments_url+'/'+$('#sale_id').val(),
                        type: 'POST',
                        data: post_data,
                        success:function(result){
                            $('.payments_list').html(result);
                            $('.register-summary').unmask();
                            
                        }
                });
        }
        
        function ReplaceNumberWithCommas(yourNumber) {
            //Seperates the components of the number
            var n= yourNumber.toString().split(".");
            //Comma-fies the first part
            n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            //Combines the two sections
            return n.join(".");
        }


        function compute_total_payment()
        {
                var payment_total = parseFloat($('#payment_total').val());
                var total_amount = parseFloat($('#total_amount').val());
                var amount_due = total_amount-payment_total;
                
                $('#amount_due').html('Php ' + ReplaceNumberWithCommas(amount_due.toFixed(2)));
        }

            //------REMOVE Payment -------------------------------------------
            
                var remove_payment_url;
            
                function remove_payment(payment_id){

                        $('.register-summary').mask('Loading. Please wait...');
                        //var payment_id = $(this).attr('id');
                        var post_data={};
                        post_data['payment_id'] = payment_id;
                        post_data['payment_amount'] = $('#payment_'+payment_id+'').html();
                        post_data['payment_type'] = $('#ptype_'+payment_id+'').html();
                        post_data['sale_id']=$('#sale_id').val();
                        $.ajax({
                                url: remove_payment_url,
                                type: 'POST',
                                data: post_data,
                                success:function(result){
                                    $('.register-summary').unmask();
                                    if(result=='1'){
                                        alert('Payment successfully removed');
                                    } else {
                                        alert('Something went wrong while removing payment.');
                                    }
                                    load_payments();
                                }
                        });
                        
                }

//-------------------------------------------------------------

                //cancel button
                $('#cancel_sale').on("click", function(){
                            $("#complete_value").val('0');
                            show_modal_complete();
                });
                
                $('#complete_sale').on("click", function(){
                            $("#complete_value").val('1');
                            show_modal_complete();
                });
                
                function show_modal_complete()
                {
                        $("#modal_complete").modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false,
                            backdrop: 'static',
                            keyboard: false
                        });
                }
                $('#complete_cancel').on("click", function(){
                        $("#modal_complete").modal("hide");
                        $("#complete_value").val('1');
                });
                $('#complete_submit').on("click", function(){
                        var complete_value= $("#complete_value").val();
                        if(complete_value=='1'){
                            var str = 'Are you sure you want to submit this Sale? This cannot be undone.'; 
                        } else {
                            var str = 'Are you sure you want to cancel this Sale? All items will be cleared.'
                        }
                        if(confirm(str)){
                            $("#complete_form").submit();
                        }
                });
                
                
//-------------------------------------------------------------
                
                //var load_discounts_url;

                $('#bypercent_divform').slideUp();
                
                $('.set_bypercent').on("click", function(){
                        $(this).slideUp();
                        $('#bypercent_divform').slideDown();
                        
                        var amount = $('#amount_bypercent').val();
                        $('#newamount_bypercent').val(amount);
                        $('#newamount_bypercent').focus().select();
                
                });
                
                var save_discount_url;
                $('#save_bypercent').on("click", function(){
                        
                        var percent = parseFloat($('#amount_bypercent').val());
                        var newpercent = parseFloat($('#newamount_bypercent').val());

                        if(percent==newpercent){
                                cancel_bypercent();
                        } else if(newpercent>=0){
                                var type = 'bypercent';
                                save_discount(type,newpercent);
                        } else {
                            alert('Please input valid discount percentage.');
                        }
                });
                
                function save_discount(type,newamount)
                {
                        $('.register-summary').mask('Loading. Please wait...');

                        var post_data={};
                        post_data['discount_type'] = type;
                        post_data['sale_id']=$('#sale_id').val();
                        post_data['newamount'] = newamount;
                        $.ajax({
                                url: save_discount_url,
                                type: 'POST',
                                data: post_data,
                                success:function(result){

                                    if(result=='0'){
                                        alert('Something went wrong while saving discount.');
                                        cancel_bypercent();
                                    } else {
                                        var json = $.parseJSON(result);
                                        $(json).each(function(i,val){
                                            if(type=='bypercent'){
                                                $('.set_bypercent').html(val.newbypercent+' % (Php '+ val.bypercent_amount  +')');
                                                $('.set_bypercent').removeClass('editable-empty');
                                                $('#amount_bypercent').val(val.newbypercent);
                                                cancel_bypercent();
                                            } else {
                                                $('.set_byamount').html('Php '+ val.newbyamount);
                                                $('.set_byamount').removeClass('editable-empty');
                                                $('#amount_byamount').val(val.newbyamount);
                                                cancel_byamount();
                                            }

                                            $('#total_discount').html(val.total_discount);

                                            $('#total_amount').val(val.amount_final);
                                            $('#total_amount_lbl').html('Php ' + val.amount_final);
                                            $('#amount_due').html('Php ' + val.amount_due);

                                        });
                                    }

                                    $('.register-summary').unmask();

                                }
                        });
                }
                
                $('#cancel_bypercent').on("click", function(){
                        cancel_bypercent();
                });
                
                function cancel_bypercent()
                {
                        $('#newamount_bypercent').val('');
                        $('.set_bypercent').slideDown();
                        $('#bypercent_divform').slideUp();
                    
                }
                
                
//-------------------------------------------------------------

                $('#byamount_divform').slideUp();
                
                $('.set_byamount').on("click", function(){
                        $(this).slideUp();
                        $('#byamount_divform').slideDown();
                        
                        var amount = $('#amount_byamount').val();
                        $('#newamount_byamount').val(amount);
                        $('#newamount_byamount').focus().select();
                
                });
                
                $('#save_byamount').on("click", function(){
                        
                        var amount = parseFloat($('#amount_byamount').val());
                        var newamount = parseFloat($('#newamount_byamount').val());

                        if(amount==newamount){
                                cancel_byamount();
                        } else if(newamount>=0){
                                var type = 'byamount';
                                save_discount(type,newamount);
                        } else {
                            alert('Please input valid discount percentage.');
                        }
                });
                
                $('#cancel_byamount').on("click", function(){
                        cancel_byamount();
                });
                
                function cancel_byamount()
                {
                        $('#newamount_byamount').val('');
                        $('.set_byamount').slideDown();
                        $('#byamount_divform').slideUp();
                    
                }
                
//-----------------DISCOUNT DETAILS--------------------------------------------

                $('#details_divform').slideUp();
                
                $('.set_details').on("click", function(){
                        $(this).slideUp();
                        $('#details_divform').slideDown();
                        
                        var details = $('#discount_details').val();
                        $('#newdiscount_details').val(details);
                        $('#newdiscount_details').focus().select();
                
                        
                });
                
                var save_details_url;
                $('#save_details').on("click", function(){
                        
                        var details = $('#discount_details').val();
                        var newdetails = $('#newdiscount_details').val();

                        if(details!=newdetails){
                            
                                $('.register-summary').mask('Loading. Please wait...');

                                var post_data={};
                                post_data['discount_details']=newdetails;
                                post_data['sale_id'] = $('#sale_id').val();
                                $.ajax({
                                        url: save_details_url,
                                        type: 'POST',
                                        data: post_data,
                                        success:function(result){
                                            if(result=='1'){
                                                $('#discount_details').val(newdetails);
                                                $('.set_details').html(newdetails);
                                                $('.set_details').removeClass('editable-empty');
                                            } else {
                                                alert('Something went wrong while saving discount details.')
                                            }
                                            $('.register-summary').unmask();
                                            cancel_details();
                                        }
                                });
                                
                        } else {
                            cancel_details();
                        }
                });
                
                $('#cancel_details').on("click", function(){
                        cancel_details();
                });
                
                function cancel_details()
                {
                        $('#newdiscount_details').val('');
                        $('.set_details').slideDown();
                        $('#details_divform').slideUp();
                    
                }
                
//-------------------------------------------------------------

function validateamount(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode( key );
        var regex = /[0-9]|[\b]|[\.]|[\t]/;
        if( !regex.test(key) ) {
              theEvent.returnValue = false;
              if(theEvent.preventDefault) theEvent.preventDefault();
        }
}     
