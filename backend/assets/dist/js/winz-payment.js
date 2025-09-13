/**
 * Created by Mr. Winz on 4/16/2018.
 */
/** Payment gateway: paystack, paypal, bitcoin **/

function payWithPaystack(url, uid, amount){
    url1 = url+"ajax/payment-info";
    $.ajax({
        type:       "post",
        url:        url1,
        dataType:   "json",
        data:       "uid="+uid,
        success:    function (pay) {
            var handler = PaystackPop.setup({
                key:            pay['key'],
                email:          pay['email'],
                amount:         amount * 100,
                //ref:            ''+Math.floor((Math.random() * 1000000000) + 1),
                //currency:       pay['currency'],
                subaccount:     pay['subaccount'],
                bearer:         "subaccount",
                metadata: {
                    custom_fields: [
                        {

                            display_name:   "Mobile Number",
                            variable_name:  "mobile_number",
                            value:          pay['phone']
                        }
                    ]
                },
                callback: function(response){
                    $.post(url+"ajax/payment-confirm",{"amount":amount,"reference":response.reference},function (data) {
                        reloadPage();
                    });
                },
                onClose: function(){

                }
            });
            handler.openIframe();
        },
        error: function () {
            alert('An error occured during initialization. Try again shortly');
        }
    });
}