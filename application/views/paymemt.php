<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bkash Payment</title>
</head>
<body>
	<div style="margin:15%">
		<center>
			<div style="border:solid 1px #ccc; padding: 15px 30px;">
				<form action="<?= base_url('BkashPay/create'); ?>" method="post">
					<label>Amount</label><br>
					<input type="text" name="amount"><br><br>
					<button>Pay with Bkash</button>
				</form>
			</div>
		</center>
	</div>
</body>
</html>