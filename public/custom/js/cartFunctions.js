"use strict";
var cartContent=null;
var cartTotal=null;
var footerPages=null;
var total=null;
var couponPrice=0;
var deliveryCharge=0;
var deliveryStatus = false;

var cart=null;

$('#localorder_phone').hide();
/**
 *
 * @param {Number} net The net value
 * @param {Number} delivery The delivery value
 * @param {Boolean} enableDelivery Disable or enable delivery
 */
function updatePrices(net,delivery,couponPrices,enableDelivery){
    var formatter = new Intl.NumberFormat(LOCALE, {
        style: 'currency',
        currency:  CASHIER_CURRENCY,
    });
    cartTotal.totalPrice = net;
    cartTotal.totalPriceFormat = formatter.format(net);

     cartTotal.delivery = true;
     cartTotal.deliveryPrice = delivery;
     cartTotal.deliveryPriceFormated = formatter.format(delivery);

    cartTotal.couponStore = couponPrices;
    cartTotal.withCouponFormat = formatter.format(couponPrices);

    cartTotal.withDelivery = net-(-delivery)-couponPrices;
    cartTotal.withDeliveryFormat = formatter.format(net-(-delivery)-couponPrices);
}

function updateSubTotalPrice(net,enableDelivery){
    updatePrices(net,(cartTotal.deliveryPrice?cartTotal.deliveryPrice:0),couponPrice,enableDelivery)
}
/**
 * getCartContentAndTotalPrice
 * This functions connect to laravel to get the current cart items and total price
 * Saves the values in vue
 */
function getCartContentAndTotalPrice(){
    axios.get('/cart-getContent').then(function (response) {
        cartContent.items=response.data.data;
        updateSubTotalPrice(response.data.total,true);
    })
        .catch(function (error) {
            console.log(error);
        });
};
// function getItem(id) {
//
//     $.ajax({
//         type:'GET',
//         url:'/getItem',
//         'data': {id: id},
//         success:function(data) {
//             var reslt = [data.data.name];
//             var arr = [];
//
//             for(var i; i<reslt.length;i++){
//                 var table = document.getElementById("table");
//                 var row = table.insertRow(0);
//                 var cell1 = row.insertCell(0);
//                 var cell2 = row.insertCell(1);
//                 cell1.innerHTML = "NEW CELL1";
//                 cell2.innerHTML = "NEW CELL2";
//             }
//
//
//             console.log(cartContent.items);
//
//         }
//     });
//     //alert(id);
//
// }
function apply() {

    $("#promo_code_btn").click(function() {
        var code = $('#coupon_code').val();

        // var formatter = new Intl.NumberFormat(LOCALE, {
        //     style: 'currency',
        //     currency:  CASHIER_CURRENCY,
        // });
        axios.post('/coupons/apply/'+code).then(function (response) {
            if(response.data.status){
                couponPrice=response.data.total;
                $("#promo_code_btn").attr("disabled",true);
                $("#promo_code_btn").attr("readonly");

                $("#promo_code_war").hide();
                $("#promo_code_succ").show();

                //console.log(couponPrice);

                updateSubTotalPrice(cartTotal.totalPrice,true);

                $("#couponWithDelivery").hide();
                $("#coup").val(cartTotal.withDeliveryFormat).show();
                $("#couponPriceShow").hide();

                $("#afterCouponStore").val(cartTotal.withDelivery);

                $("#couponPriceStore").val(cartTotal.couponStore);
                
                $("#couponPrice").val(cartTotal.withCouponFormat).show();




                // cartTotal.withDelivery=cartTotal.withDelivery-couponPrice;
                // cartTotal.withDeliveryFormat=formatter.format(cartTotal.withDelivery);
                // console.log(cartTotal.withDelivery);


                // if (!deliveryStatus) {
                //     updateSubTotalPrice(cartTotal.totalPrice,deliveryCharge,true);
                // }
                // else{
                //     updateSubTotalPrice(cartTotal.totalPrice,deliveryCharge,false);
                // }
                js.notify(response.data.msg,"warning");
                //chageDeliveryCost(deliveryCharge)
                //updatePrices(a,deliveryCharge,couponPrice,true);
            }else{
                $("#promo_code_succ").hide();
                $("#promo_code_war").show();

                js.notify(response.data.msg,"warning");
            }
        }).catch(function (error) {
            console.log(error);
        });

    });



}


function getUser() {
    var id = document.getElementById("mobile").value;
    $.ajax({
        type:'GET',
        url:'/getUser',
        'data': {id: id},
        success:function(data) {
            document.getElementById('name').value = data.data.name;
            document.getElementById('email').value = data.data.email;
        }
    });

}







$("#fborder_btn").click(function() {

    var address = $('#addressID').val();
    var comment = $('#comment').val();

    axios.post('/fb-order', {
        address: address,
        comment: comment
    })
        .then(function (response) {

            if(response.status){
                var text = response.data.msg;

                var fullLink = document.createElement('input');
                document.body.appendChild(fullLink);
                fullLink.value = text;
                fullLink.select();
                document.execCommand("copy", false);
                fullLink.remove();

                swal({
                    title: "Good job!",
                    text: "Order is submited in the system and copied in your clipboard. Next, messenger will open and you need to paste the order details there.",
                    icon: "success",
                    button: "Continue to messenger",
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        document.getElementById('order-form').submit();
                    }
                });

            }
        }).catch(function (error) {
        console.log(error);
    });
});

/**
 * Removes product from cart, and calls getCartConent
 * @param {Number} product_id
 */
function removeProductIfFromCart(product_id){
    axios.post('/cart-remove', {id:product_id}).then(function (response) {
        getCartContentAndTotalPrice();
    }).catch(function (error) {
        console.log(error);
    });
}

/**
 * Update the product quantity, and calls getCartConent
 * @param {Number} product_id
 */
function incCart(product_id){
    axios.get('/cartinc/'+product_id).then(function (response) {
        getCartContentAndTotalPrice();
    }).catch(function (error) {
        console.log(error);
    });
}


function decCart(product_id){
    axios.get('/cartdec/'+product_id).then(function (response) {
        getCartContentAndTotalPrice();
    }).catch(function (error) {
        console.log(error);
    });
}

//GET PAGES FOR FOOTER
function getPages(){
    axios.get('/footer-pages').then(function (response) {
        footerPages.pages=response.data.data;
    })
        .catch(function (error) {
            console.log(error);
        });

};

function dineTypeSwitch(mod){
    console.log("Change mod to "+mod);

    $('.tablepicker').hide();
    $('.takeaway_picker').hide();

    if(mod=="dinein"){
        $('.tablepicker').show();
        $('.takeaway_picker').hide();

        //phone
        $('#localorder_phone').hide();
    }

    if(mod=="takeaway"){
        $('.tablepicker').hide();
        $('.takeaway_picker').show();

        //phone
        $('#localorder_phone').show();
    }

}

function orderTypeSwither(mod){
    console.log("Change mod to "+mod);

    $('.delTime').hide();
    $('.picTime').hide();

    if(mod=="pickup"){
        updatePrices(cartTotal.totalPrice,null,couponPrice,false)
        $('.picTime').show();
        $('#addressBox').hide();
    }

    if(mod=="delivery"){
        $('.delTime').show();
        $('#addressBox').show();
        getCartContentAndTotalPrice();
    }
}

setTimeout(function(){
    if(typeof initialOrderType !== 'undefined'){
        console.log("Will change now to "+initialOrderType+" --");
        orderTypeSwither(initialOrderType);
    }else{
        console.log("No initialOrderType");
    }

},1000);

function chageDeliveryCost(deliveryCost){
    $("#deliveryCost").val(deliveryCost);
    deliveryCharge=deliveryCost;

    updatePrices(cartTotal.totalPrice,deliveryCharge,couponPrice,true);
    console.log(deliveryCharge);
    console.log("Done updatin delivery price");
}

//First we beed to capture the event of chaning of the address
function deliveryAddressSwithcer(){
    $("#addressID").change(function() {
        //The delivery cost
        var deliveryCost=$(this).find(':selected').data('cost');

        //We now need to pass this cost to some parrent funct for handling the delivery cost change
        chageDeliveryCost(deliveryCost);


    });

}

function deliveryTypeSwitcher(){
    $('.picTime').hide();
    $('input:radio[name="deliveryType"]').change(function() {
        orderTypeSwither($(this).val());
    })
}

function dineTypeSwitcher(){
    $('input:radio[name="dineType"]').change(function() {
        $('.delTimeTS').hide();
        $('.picTimeTS').show();
        dineTypeSwitch($(this).val());
    })
}

function paymentTypeSwitcher(){
    $('input:radio[name="paymentType"]').change(

        function(){
            //HIDE ALL
            $('#totalSubmitCOD').hide()
            $('#totalSubmitStripe').hide()
            $('#stripe-payment-form').hide()
            $('#paystack-payment-form').hide()
            $('#paypal-payment-form').hide()
            $('#mollie-payment-form').hide()

            if($(this).val()=="cod"){
                //SHOW COD
                $('#totalSubmitCOD').show();
            }else if($(this).val()=="stripe"){
                //SHOW STRIPE
                $('#totalSubmitStripe').show();
                $('#stripe-payment-form').show()
            }else if($(this).val()=="paystack"){
                $('#paystack-payment-form').show()
            }else if($(this).val()=="paypal"){
                $('#paypal-payment-form').show()
            }else if($(this).val()=="mollie"){
                $('#mollie-payment-form').show()
            }
        });
}

window.onload = function () {

    console.log("Cart function called");

    //VUE CART
    cartContent = new Vue({
        el: '#cartList',
        data: {
            items: [],
        },
        methods: {
            remove: function (product_id) {
                removeProductIfFromCart(product_id);
            },
            incQuantity: function (product_id){
                incCart(product_id)
            },
            decQuantity: function (product_id){
                decCart(product_id)
            },
        }
    })

    //GET PAGES FOR FOOTER
    getPages();

    //Payment Method switcher
    paymentTypeSwitcher();

    //Delivery type switcher
    deliveryTypeSwitcher();

    //For Dine in / takeout
    dineTypeSwitcher();

    //Activate address switcher
    deliveryAddressSwithcer();

    apply();


    //VUE FOOTER PAGES
    footerPages = new Vue({
        el: '#footer-pages',
        data: {
            pages: []
        }
    })

    //VUE COMPLETE ORDER TOTAL PRICE
    total = new Vue({
        el: '#totalSubmit',
        data: {
            totalPrice:0
        }
    })


    //VUE TOTAL
    cartTotal= new Vue({
        el: '#totalPrices',
        data: {
            totalPrice:0,
            minimalOrder:0,
            totalPriceFormat:"",
            deliveryPriceFormated:"",
            delivery:true,
            coupon:0,
        }
    })

    //Call to get the total price and items
    getCartContentAndTotalPrice();

    var addToCart1 =  new Vue({
        el:'#addToCart1',
        methods: {
            addToCartAct() {

                axios.post('/cart-add', {
                    id: $('#modalID').text(),
                    quantity: $('#quantity').val(),
                    extras:extrasSelected,
                    variantID:variantID
                })
                    .then(function (response) {
                        if(response.data.status){
                            $('#productModal').modal('hide');
                            getCartContentAndTotalPrice();

                            //$('#miniCart').addClass( "open" );
                            openNav();
                        }else{
                            $('#productModal').modal('hide');
                            js.notify(response.data.errMsg,"warning");
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },
    });
}
