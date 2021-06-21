{config_load file="test.conf" section="setup"}
{include file="header.tpl" title=$title}

<div id="netpay-form"></div>
    <script>  
        NetPay.setApiKey("pk_netpay_YZBmAQnMQhRRpfFGRrRijheWx");
        NetPay.setSandboxMode(true);
        
        function success(e) {
            console.log("Token created successfully");
            console.log(e);
            const obj = JSON.parse(e.message.data);
            console.log(obj); 

            $.post( "http://localhost:8888/netpay-checkout-php/demo/form/checkout.php", { token: obj.token})
                .done(function( data ) {
                    console.log( "response: " + data );
                    var obj =JSON.parse(data);
                    if(obj.status == 'REVIEW') {
                        window.location = obj.redirect;
                    }
            });
        }
        
        function error(e) {
            console.log("Something went wrong!");
            console.log(e);
        }
        
        NetPay.form.generate("netpay-form", success, error, { title: "", submitText: "Pagar" });
            
    </script>

{include file="footer.tpl"}
