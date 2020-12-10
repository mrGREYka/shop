$(document).ready(function () {
    if ($('.sms_balance').length) {
       $.ajax({
            url: '/smsbalance/get',
            type: 'GET',
            success: function (res) {
                $('.sms_balance').text(res);
            }, error: function () {
                $('.sms_balance').text("error!!!");
            }
       });
    }
});