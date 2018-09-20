<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Ipay Integration</title>
     <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" type="text/css" />
</head>
<body>

<div id="container">
    <?php
/*
CODED BY mutethiaisaiah@gmail.com

This is a sample PHP script of how you would ideally integrate with iPay Payments Gateway and also handling the
callback from iPay and doing the IPN check
----------------------------------------------------------------------------------------------------
            ************(A.) INTEGRATING WITH iPAY ***********************************************
----------------------------------------------------------------------------------------------------
*/
//Data needed by iPay a fair share of it obtained from the user from a form e.g email, number etc...
$fields = array("live"=> "0", //SHOULD be ) when testing and 1 While in production
                "oid"=> "112",//ORDER ID from your MERCHANT WEBSITE
                "inv"=> "112020102292999",  //invoice number/ if you dont have, you the orderID
                "ttl"=> "900", //amount of money to be transacted by the customer
                "tel"=> "256712375678",//telephone number of the customer
                "eml"=> "kajuej@gmailo.com",//email address of the customer
                "vid"=> "demo", //the MERCHANT ID assigned by the IPAY
                "curr"=> "KES", //CURRENY in USE
                "p1"=> "airtel",
                "p2"=> "020102292999",
                "p3"=> "",
                "p4"=> "900",
                "cbk"=> $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"],
                "cst"=> "1",
                "crl"=> "2"
                );
/*
----------------------------------------------------------------------------------------------------
************(b.) GENERATING THE HASH PARAMETER FROM THE DATASTRING *********************************
----------------------------------------------------------------------------------------------------
The datastring IS concatenated from the data above
*/
$datastring =  $fields['live'].$fields['oid'].$fields['inv'].$fields['ttl'].$fields['tel'].$fields['eml'].$fields['vid'].$fields['curr'].$fields['p1'].$fields['p2'].$fields['p3'].$fields['p4'].$fields['cbk'].$fields['cst'].$fields['crl'];

$hashkey ="demo";/* On the Hashkey, provide the key provided from the IPAY Team, ensure no spaces provided */

/********************************************************************************************************
* Generating the HashString sample
*/
$generated_hash = hash_hmac('sha1',$datastring , $hashkey);

?>
<!--    Generate the form BELOW   -->
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-4">
             <form method="post" action="https://payments.ipayafrica.com/v3/ke">
                     <fieldset>
                  <legend>User Registration Form</legend>
                           <div class="form-group">
                    <?php
 foreach ($fields as $key => $value) {
      echo '<label for="">'.$key.'</label>';
     echo '&nbsp;:<input name="'.$key.'" type="text" class="form-control" value="'.$value.'"></br>';
 }
?>
                 </div>
                 <div class="form-group">
                      <label for="">Hash</label>
<input name="hsh" type="text" class="form-control" value="<?php echo $generated_hash ?>" >
                 </div>
                     </fieldset>


<div class="row">
    <div class="col-md-4">
        <button type="submit" class="btn btn-info">&nbsp;Lipa with IPAY&nbsp;</button>
    </div>
</div>
</form>
        </div>
    </div>
</div>

</div>

</body>
</html>