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
      <form action="api/disbursement" id="send_disbursement">
        <div class="form-group">
          <label for="bank_code">Bank Code:</label>
          <input type="text" class="form-control" id="bank_code" name="bank_code">
        </div>
        <div class="form-group">
          <label for="account_number">Account Number:</label>
          <input type="text" class="form-control" id="account_number" name="account_number">
        </div>
        <div class="form-group">
          <label for="amount">Amount:</label>
          <input type="number" class="form-control" id="amount" name="amount">
        </div>
        <div class="form-group">
          <label for="remark">Remark:</label>
          <input type="text" class="form-control" id="remark" name="remark">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <br/>
      <br/>

      <h2>Get Disbursement</h2>
      <form action="#" onsubmit="return false" id="get_disbursement">
        <div class="form-group">
          <label for="transaction_id">Transaction ID:</label>
          <input type="text" class="form-control" id="transaction_id" name="transaction_id">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

    </body>
</html>
