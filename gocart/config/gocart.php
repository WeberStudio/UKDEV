<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// GoCart Theme

//$config['theme']            = 'default';

$config['theme']			= 'UKOCNewDesign';



// SSL support

$config['ssl_support']		= false;



// Business information

$config['company_name']		= 'UKOpenCollege';

$config['address1']			= 'lahore';

$config['address2']			= 'lahore';

$config['country']			= 'Pakistan'; // use proper country codes only

$config['city']				= 'lahore'; 

$config['state']			= 'Alberta';

$config['zip']				= '54000';

$config['email']			= 'weprosol@gmail.com';
$config['bcc_email']		= 'khalil.junaid@gmail.com';
$config['email_template']	= 'default';


// Store currency

$config['currency']						= 'GBP';  // USD, EUR, etc

$config['currency_symbol']				= '£';

$config['currency_symbol_side']			= 'left'; // anything that is not "left" is automatically right

$config['currency_decimal']				= '.';

$config['currency_thousands_separator']	= ',';



// Shipping config units

$config['weight_unit']	    = 'LB'; // LB, KG, etc

$config['dimension_unit']   = 'IN'; // FT, CM, etc



// site logo path (for packing slip)

$config['site_logo']		= '/assets/img/logo.png';



//change the name of the admin controller folder 

$config['admin_folder']		= 'admin';



//file upload size limit

$config['size_limit']		= intval(ini_get('upload_max_filesize'))*1024;



//are new registrations automatically approved (true/false)

$config['new_customer_status']	= true;



//do we require customers to log in 

$config['require_login']		= false;



//default order status

$config['order_status']			= 'Pending';



// default Status for non-shippable orders (downloads)

$config['nonship_status'] = 'Delivered';



$config['order_statuses']	= array(

	'Pending'  				=> 'Pending',

	'Processing'    		=> 'Processing',	

	'Cancelled'				=> 'Cancelled',

	'Delivered'				=> 'Delivered'

);



// enable inventory control ?

$config['inventory_enabled']	= true;



// allow customers to purchase inventory flagged as out of stock?

$config['allow_os_purchase'] 	= true;



//do we tax according to shipping or billing address (acceptable strings are 'ship' or 'bill')

$config['tax_address']		= 'ship';



//do we tax the cost of shipping?

$config['tax_shipping']		= false;