let token = document.querySelector("meta[name=token]").content;

$(document).on('click', '.balanceRecharge', function () {
   var amount = $('#idFormRecharge input[name=amount]').val();

   fetch("accounts/payu/info", {
      method: 'POST',
      headers: {
         "X-CSRF-TOKEN": token,
         'Accept': 'application/json',
         'Content-Type': 'application/json'
      },
      body: JSON.stringify({
         amount: amount
      })
   })
   .then((response) => response.json())
   .then(function(result) {
      var data = result.data;

      $('#idFormRecharge input[name=merchantId]').val(data.merchant_id);
      $('#idFormRecharge input[name=accountId]').val(data.account_id);
      $('#idFormRecharge input[name=description]').val(data.description);
      $('#idFormRecharge input[name=referenceCode]').val(data.reference);
      $('#idFormRecharge input[name=tax]').val(data.tax);
      $('#idFormRecharge input[name=taxReturnBase]').val(data.tax_return_base);
      $('#idFormRecharge input[name=amount]').val(data.amount);
      $('#idFormRecharge input[name=currency]').val(data.currency);
      $('#idFormRecharge input[name=signature]').val(data.signature);
      $('#idFormRecharge input[name=test]').val(data.test);
      $('#idFormRecharge input[name=buyerEmail]').val(data.buyer_email);
      $('#idFormRecharge input[name=responseUrl]').val(data.response_url);
      $('#idFormRecharge input[name=confirmationUrl]').val(data.confirmation_url);
      $('#idFormRecharge input[name=extra1]').val(data.extra_one);

      document.getElementById('idFormRecharge').submit();
   })
   .catch(function(error) {
      console.log("error");
      console.log(error);
   });
});
