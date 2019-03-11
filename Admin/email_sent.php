<?php
include "include/shi-config.php";

include "include/functions.php";

$maindatabase = "user_registration";	


if(isset($_REQUEST['q']))
{

//$id_id = bease64_decode($_REQUEST['q']);

$id_id = $_REQUEST['q'];


$check_user = select_query($con, $maindatabase, ""," `id`='$id_id'","","");
//echo $check_user['nr'];

if($check_user['nr']>0)
{

foreach($check_user['result'] as $u_key=>$user_value)
{
}

$user_id = $user_value['user_id'];

$user_name = $user_value['name'];

$password = $user_value['password'];

$reg_date = $entry_value['reg_date'];

$location_result = select_query($con,"cities_current",""," id='$user_value[current_location]' ");

foreach ($location_result['result'] as $key => $user_location) {}


$select_pay_his = mysqli_query($con,"select * from `payment_history` where `payment_request_id` ='$entry_value[payment_request_id]' and `payment_id`='$entry_value[payment_id]' ") or die(mysqli_error($con));

$select_pay_his1 = mysqli_fetch_array($select_pay_his);

$orderid = 'C2C'.$select_pay_his1['id'];

/////////////////////////////////////////////////////////////// Email Start ////////////////////////////////////////////////////////////
		

		$message = "<html xmlns='https://www.w3.org/1999/xhtml'>



<head>

    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

    <meta name='viewport' content='width=device-width, initial-scale=1.0'>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>



    <head>

        <!--[if gte mso 12]>

> <style type='text/css'>

> [a.btn {

	padding:15px 22px !important;

	display:inline-block !important;

}]

> </style>

> <![endif]-->

         <title>Registration Confirmation</title>

        <style type='text/css'>

            div,

            p,

            a,

            li,

            td {

                -webkit-text-size-adjust: none;

            }

            

            .ReadMsgBody {

                width: 100%;

                background-color: #d1d1d1;

            }

            

            .ExternalClass {

                width: 100%;

                background-color: #d1d1d1;

                line-height: 100%;

            }

            

            body {

                width: 100%;

                height: 100%;

                /*background-color: #d1d1d1;*/

                margin: 0;

                padding: 0;

                -webkit-font-smoothing: antialiased;

                -webkit-text-size-adjust: 100%;

            }

            

            html {

                width: 100%;

            }

            

            img {

                -ms-interpolation-mode: bicubic;

            }

            

            table[class=full] {

                padding: 0 !important;

                border: none !important;

            }

            

            table td img[class=imgresponsive] {

                width: 100% !important;

                height: auto !important;

                display: block !important;

            }

            

            @media only screen and (max-width: 800px) {

                body {

                    width: auto!important;

                }

                table[class=full] {

                    width: 100%!important;

                }

                table[class=devicewidth] {

                    width: 100% !important;

                    padding-left: 20px !important;

                    padding-right: 20px!important;

                }

                table td img.responsiveimg {

                    width: 100% !important;

                    height: auto !important;

                    display: block !important;

                }

            }

            

            @media only screen and (max-width: 640px) {

                table[class=devicewidth] {

                    width: 100% !important;

                }

                table[class=inner] {

                    width: 100%!important;

                    text-align: center!important;

                    clear: both;

                }

                table td a[class=top-button] {

                    width: 160px !important;

                    font-size: 14px !important;

                    line-height: 37px !important;

                }

                table td[class=readmore-button] {

                    text-align: center !important;

                }

                table td[class=readmore-button] a {

                    float: none !important;

                    display: inline-block !important;

                }

                .hide {

                    display: none !important;

                }

                table td[class=smallfont] {

                    border: none !important;

                    font-size: 26px !important;

                }

                table td[class=sidespace] {

                    width: 10px !important;

                }

            }

            

            @media only screen and (max-width: 520px) {}

            

            @media only screen and (max-width: 480px) {

                table {

                    border-collapse: collapse;

                }

                table td[class=template-img] img {

                    width: 100% !important;

                    display: block !important;

                }

            }

            

            @media only screen and (max-width: 320px) {}

			.rw_1

			 {

				font: 17px Arial, Helvetica, sans-serif;

				text-align: left;

				color: #47494a;

				line-height: 24px;

			}

			.rw_2

			 {

				font: 17px Arial, Helvetica, sans-serif;

				text-align: left;

				font-weight:bold;

				color: #47494a;

				line-height: 24px;

			}

			.rw_3

			 {

				font: 17px Arial, Helvetica, sans-serif;

				text-align: left;

				color: #47494a;

				font-style:italic;

				line-height: 24px;

			}

.btn_tmpl {

    background-color: #1a356d;

    border: none;

    color: #fff !important;

    padding: 9px 32px;

    text-align: center;

    text-decoration: none;

    display: inline-block;

    font-size: 16px;

    font-weight: bold;

    text-transform: uppercase;

}        </style>

    </head>



    <body>

        <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' class='full'>

            <tr>

                <td height='1'>&nbsp;</td>

            </tr>

        </table>

        <table width='100%' border='0' cellspacing='0' cellpadding='0' class='full'>

            <tr>

                <td align='center'>

                    <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' class='devicewidth'>

                        <tr>

                            <td>

                                <table width='100%' bgcolor='#fbfbfb' border='0' cellspacing='0' cellpadding='0' align='center' class='full' style='border-radius:5px 5px 0 0; background-color:#fbfbfb;'>



                                    <tr>

                                        <td>

                                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='left' class='inner' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'>

                                                <tr>



                                                    <td height='40' align='center' class='inner' valign='middle'>

                                                       <a  href='https://www.Image Network.com/' target='_blank'> <img class='logo' src='".MAIN_URL."email/images/logo.png' width='60%' alt='Logo'></a>

                                                    </td>

                                                </tr>

                                            </table>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td height='3' style='border-bottom:1px solid #f1f1f1;'>&nbsp;</td>

                                    </tr>

                                </table>

                            </td>

                        </tr>

                    </table>

                </td>

            </tr>

        </table>

        <table width='100%' border='0' cellspacing='0' cellpadding='0' class='full'>

            <tr>

                <td align='center'>

                    <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' class='devicewidth'>

                        <tr>

                            <td>

                                <table width='100%' bgcolor='#fbfbfb' border='0' cellspacing='0' cellpadding='0' align='center' class='full' style='background-color:#fbfbfb;'>

                                    <tr>

                                        <td height='3'>&nbsp;</td>

                                    </tr>

                                    <tr>

                                        <td style='padding:0 10px;'>

                                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>

                                                <tr>



                                                    <td>

                                                        <table width='100%' border='0' cellspacing='0' cellpadding='0' align='left' class='inner' id='banner' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'>

                                                            <tr>

                                                               <td class='rw_2'>Dear ".$user_name."</td>

                                                            </tr>

														   <tr>

															

                                                                <td class='smallfont rw_1'>

                                                             

                                                                </td>

																

                                                            </tr>

															 <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' class=''>

															<tr>



																<td>

															<tr>

                                                                <td height='20'>&nbsp;</td>

                                                            </tr>

																	<tr class='smallfont rw_2'>

																		<td>Login Details</td>

																	</tr>

																	

																	<tr class='smallfont rw_1'>

																		<td>User Name </td>

																		<td>".$user_id."</td>

																	</tr>

																	<tr class='smallfont rw_1'>

																		<td>Password </td>

																		<td>".$password."</td>

																	</tr>

																	

																</td>

															</tr>		

                                                            <tr>

                                                                <td height='20'>&nbsp;</td>

                                                            </tr>

                                                        </table>



                                                </tr>

                                            </table>

                                          

                                           

                                            </td>

                                    </tr>



                                </table>

                                </td>

                        </tr>

                    </table>

                    </td>

            </tr>

        </table>

        <table width='100%' border='0' cellspacing='0' cellpadding='0' class='full'>

            <tr>

                <td align='center'>

                    <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' class='devicewidth' >

                        <tr>

                            <td >

                                <table width='100%' bgcolor='#fbfbfb' border='0' cellspacing='0' cellpadding='0' align='center' class='full' >

                                    

                               

                                      

                                       

                                      

                                        

										

                                        

                                        <tr>

                                            <td>

                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='padding: 0 10px;'>

                                                    <tr>

                                                        

                                                  

                                                        <td align='center' style='font:300 15px 'Open Sans', Arial, Helvetica, sans-serif;color:#ffffff;'>

														<a href='".MAIN_URL."userarea/' class='btn_tmpl'>Login </a>

														</td>

                                                        

                                                    </tr>

													

                                                </table>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td height='25'>&nbsp;</td>

                                        </tr>

                                        

                                       

                                </table>

                            </td>

                            </tr>

                    </table>

                </td>

                </tr>

        </table>

      

		

    </body>



</html>";





$from = 'info@corehrconnect.com';



$to  = $user_value['email'];
//$to  = 'help@cwd.co.in,pandian@tiia.co.in';


$subject = "Your Core Connect Login Details";





$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From: '.$from. "\r\n".   'Reply-To:'.$from. "\r\n" .     'X-Mailer: PHP/' . phpversion();





$result_mail = @mail($to, $subject, $message, $headers);

/////////////////////////////////////////////////////////////////// Confirmation /////////////////////////////////////////////////////////////////


}
else
{

echo 'Invalid Information';
}

}

?>