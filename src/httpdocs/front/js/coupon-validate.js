/**
 * Coupon validate Service
 *
 */
var attachCouponCheckEvent = function(couponInputId, couponResponseContainerId, couponClientUuid) {
    var inputField = $('#' + couponInputId);
    var responseContainer = $('#' + couponResponseContainerId);
    var csUri = 'http://coupon.localhost/' + couponClientUuid;

    responseContainer.html("");

    //
    inputField.focusin(function(){
        // attach focus in event
        responseContainer.html("get focusin fire");
    }).focusout(function(){
        // attach focus out event
        responseContainer.html("get focusout fire");
        var couponCode =  inputField.val();
        var requestUrl = csUri + "/" + couponCode;

        console.log("Connecting " + requestUrl);
        $.get(requestUrl, function(data) {
            alert('success');
        }).done(function(){
            alert('done');
        }).always(function(){
            alert('always');
        }).fail(function(){
            alert('faield');
        });
        console.log('used coupon code = ' + couponCode);
    });

};


