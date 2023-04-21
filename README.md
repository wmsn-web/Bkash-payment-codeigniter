![status: archive](https://github.com/GIScience/badges/raw/master/status/archive.svg)

# Bkash Payment gateway integration in Codeigniter
	The merchant SDK can be used for integrating with the Tokenize APIs.

## Manage Config file
- Create a file name *bkash.php* in your *config folder*.

``` php
    defined('BASEPATH') OR exit('No direct script access allowed');

	$config['credentials'] = array(
		"base_url" => "https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized",
		"username" => "sandboxTokenizedUser02",
		"password" => "sandboxTokenizedUser02@12345",
		"app_key" => "4f6o0cjiki2rfm34kfdadl1eqq",
		"app_secret" => "2is7hdktrekvrbljjh44ll3d9l1dtjo4pasmjvs5vl5qr3fug4b"
	);
```
- Load *bkash* config at *autoload.php*

``` php
	$autoload['config'] = array('bkash');
```
- Open Controller directory add Controllers
- Manage Callback Data

## Support
> Please contact [Technical Support](wmsn.web@gmail.com) for any live or account issues.

## Bkash Documentations 
> For full Documentation [Visit Here](https://developer.bka.sh/docs/checkout-url-process-overview)

## Testing Credentials
	Testing wallet numbers are

- 01770618575
- 01929918378
- 01770618576
- 01877722345
- 01619777282

* 123456 OTP/Verification code.
*PIN 12121