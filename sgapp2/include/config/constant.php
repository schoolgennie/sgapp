<?
# WEBSITE CONSTANTS 
//$constants=new query('setting');
//$constants->DisplayAll();
//while($constant=$constants->GetObjectFromRecord()):
	//define("$constant->key", $constant->value, true);
//endwhile;
define("ADMIN_EMAIL","admin@schoolgennie.com");
define("SUPPORT_EMAIL","admin@schoolgennie.com");
define("BCC_EMAIL","admin@schoolgennie.com");
define("ERROR_EMAIL","admin@schoolgennie.com");
define("SITE_NAME","SchoolGennie");

# Email subjects.
define("SUBJECT_CONFIRM_EMAIL",SITE_NAME." : Login details");
define("SUBJECT_REGISTER_EMAIL",SITE_NAME." : Please confirm your email address.");
define("SUBJECT_FORGOT_PASSWORD_EMAIL",SITE_NAME." : Your login details.");
define("SUBJECT_CHANGE_PASSWORD_EMAIL",SITE_NAME." : Your new login details.");
define("SUBJECT_PRODUCT_TO_FRIEND_EMAIL",SITE_NAME." : Your friend has recommeded you a product.");
define("SUBJECT_ONLINE_ENQUIRY",SITE_NAME." : Online enquiry regarding ");
define("SUBJECT_FREE_SAMPLE",SITE_NAME." : Free Sample Request of ");
define("SUBJECT_FREE_CALLBACK",SITE_NAME." : Free callback request.");
define("SUBJECT_NEW_ORDER",SITE_NAME." : New Order Received.");


# PHP Validation types
define('VALIDATE_REQUIRED', "req", true);
define('VALIDATE_EMAIL',"email", true);
define("VALIDATE_MAX_LENGTH","maxlength");
define("VALIDATE_MIN_LENGTH","minlength");
define("VALIDATE_NUMERIC","num");
define("VALIDATE_ALPHA","alpha");
define("VALIDATE_ALPHANUM","alphanum");
define("TEMPLATE","default");

# VAT 
//define("CART_VAT", 0);
//define("CART_VAT_PERCENT", "17.5");
//define("CATEGORY_PAGE_SIZE", "20");
//define("PRODUCT_PAGE_SIZE", "20");
//define("ADMIN_CATEGORY_PAGE_SIZE", "20");
//
//#cart options
//define("CART_STOCK", 1);
//define("ALLOW_REPEAT_PRODUCT", 1);
//define("CHECK_STOCK_WITH_ATTRIBUTE", 1);
//define("ALLOW_BUY_IF_OUT_OF_STOCK", 0);
//define("MAX_PRODUCT", 500);

define("ADMIN_FOLDER",'control');
//
//# some basic modules
//define("USE_PRODUCT_ATTRIBUTE", true);
//define("USE_USER_REVIEW", true);
//define("USE_RELATED_PRODUCT", true);
//define("USE_MOVE_PRODUCT", true);
//define("USE_COPY_PRODUCT", true);
//define("USE_PRODUCT_CSV_DOWNLOAD", true);
//define("USE_ORDER_CSV_DOWNLOAD", true);
//
define("ADD_ATTRIBUTE_PRICE_TO_PRODUCT_PRICE", true);
define("ATTRIBUTE_PRICE_OVERLAP", false);
//
//define('AUTO_LOGIN_ON_REGISTER', true);
//define('VERIFY_EMAIL_ON_REGISTER', false);
//define('USE_ADDRESS_BOOK', true);
//
//define("ENABLE_VOUCHER_CODE", true);
//
//define("THUMB_HEIGHT", 100);
//define("THUMB_WIDTH", 100);

#Paging format values.
define("PAGING_FORMAT_NUMBERED","Numbered",true);
define("PAGING_FORMAT_PREVNEXT","PrevNext",true);
define("PAGING_FORMAT_BOTH","Both",true);



$AllowedImageTypes=array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/jpg', 'image/png');
# new allowed photo mime type array.
$conf_allowed_photo_mime_type=array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/jpg', 'image/png');



?>
