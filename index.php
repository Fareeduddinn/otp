
<?php
$err ="";
$ses = "";


if (isset($_POST['btn'])) {

$otp = rand(1111,9999);

$no = $_POST['num'];
if(preg_match("/^\d+\.?\d*$/",$no) && strlen($no)==10){

$fields = array(
"variables_values" => "$otp",
"route" => "otp",
"numbers" => "$no",
);

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_SSL_VERIFYHOST => 0,
CURLOPT_SSL_VERIFYPEER => 0,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => json_encode($fields),
CURLOPT_HTTPHEADER => array(
"authorization: your_api_key",
"accept: */*",
"cache-control: no-cache",
"content-type: application/json"
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
$data = json_decode($response);
$sts = $data->return;
if ($sts == false) {
$err = "OTP is Send";
}else{
$ses = "OTP is send";
}
}


}else{
$err = "Invalied Mobile Number";
}

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Php send sms</title>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"></head>
<link href="css/style.css" rel="stylesheet"/>
<body>
    <div>
<div class="sms">
    <div class="container">
    <p class=" text-center text-success"><?php echo $err; ?></p>
    <p class=" text-center text-success"><?php echo $ses; ?></p>
        <form action="" method="post" class="mt-5">
            <div class="form-heading">Login</div>
            <div class="form-row">
                <input type="number" class="form-input" name="num" placeholder="Enter 10 Digit Mobile Number">
            </div>
            <button name="btn" class="btnsubmit" type="submit">Send OTP</button>
        </form>
    </div>
    </div>
</div>

</body>

</html>