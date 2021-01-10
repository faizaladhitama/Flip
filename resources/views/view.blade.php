<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>

    <div class="container">
      <h2>Send Disbursement</h2>
      <form id="send_disbursement">
        <div class="form-group">
          <label for="bank_code">Bank Code:</label>
          <input type="text" class="form-control" id="bank_code" name="bank_code" required>
        </div>
        <div class="form-group">
          <label for="account_number">Account Number:</label>
          <input type="text" class="form-control" id="account_number" name="account_number" required>
        </div>
        <div class="form-group">
          <label for="amount">Amount:</label>
          <input type="number" class="form-control" id="amount" name="amount" required>
        </div>
        <div class="form-group">
          <label for="remark">Remark:</label>
          <input type="text" class="form-control" id="remark" name="remark" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <br/>
      <br/>

      <h2>Get Disbursement</h2>
      <form id="get_disbursement">
        <div class="form-group">
          <label for="transaction_id">Transaction ID:</label>
          <input type="text" class="form-control" id="transaction_id" name="transaction_id" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

      <br/>
      <br/>

      <div id="get_data">

      </div>
    </div>
    <script>
      $("#send_disbursement").on("submit", function(){
        console.log('send disbursement');
        var data = $('form#send_disbursement').serialize();
        console.log(data);

        $.ajax({
          url: 'api/disbursement',
          type: 'post',
          dataType: 'json',
          data: data,
          success: function(response) {
            var data = response.data;
            console.log(data); 
          },
          error: function(jqXHR, exception) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                alert('Time out error.');
            } else if (exception === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }
            console.log(exception);
          }
        });
        return false;
      })

      $("#get_disbursement").on("submit", function(){
        console.log('get disbursement');
        var data = $('form#get_disbursement').find('input[name="transaction_id"]').val();;
        console.log(data);

        $.ajax({
          url: 'api/disbursement/' + data,
          type: 'get',
          success: function(response) {
            var data = response.data;
            console.log(data);

            $("#get_data").empty();
            $('#get_data').append(`<table class="table">
              <thead>
                <tr>
                  <th scope="col">Field</th>
                  <th scope="col">Value</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">ID</th>
                  <td>${data.disbursement_id}</td>
                </tr>
                <tr>
                  <th scope="row">Amount</th>
                  <td>${data.amount}</td>
                </tr>
                <tr>
                  <th scope="row">Status</th>
                  <td>${data.status}</td>
                </tr>
                <tr>
                  <th scope="row">Time Stamp</th>
                  <td>${data.disbursement_timestamp}</td>
                </tr>
                <tr>
                  <th scope="row">Bank Code</th>
                  <td>${data.bank_code}</td>
                </tr>
                <tr>
                  <th scope="row">Account Number</th>
                  <td>${data.account_number}</td>
                </tr>
                <tr>
                  <th scope="row">Beneficiary Name</th>
                  <td>${data.beneficiary_name}</td>
                </tr>
                <tr>
                  <th scope="row">Remark</th>
                  <td>${data.remark}</td>
                </tr>
                <tr>
                  <th scope="row">Receipt</th>
                  <td>${data.receipt}</td>
                </tr>
                <tr>
                  <th scope="row">Time Served</th>
                  <td>${data.time_served}</td>
                </tr>
                <tr>
                  <th scope="row">Fee</th>
                  <td>${data.fee}</td>
                </tr>
              </tbody>
            </table>`);
          },
          error: function(jqXHR, exception) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                alert('Time out error.');
            } else if (exception === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }
            console.log(exception);
          }
        });
        return false;
      });
    </script>
    </body>
</html>
