<?php 
include "include/shi-config.php";
include "include/functions.php";


$result = select_query($con,'payment_history',"","`id` = '$_REQUEST[payment_id]'");
foreach ($result['result'] as $key => $payment_history) {}

$result = select_query($con,'user_registration',"","`user_id` = '$payment_history[user_id]'");
foreach ($result['result'] as $key => $user) {}

$result = select_query($con,'cities_current',"","`id` = '$user[current_location]'");
foreach ($result['result'] as $key => $user_location) {}	


	   

		

echo $message1 = "
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>

        <!--[if gte mso 12]>

> <style type='text/css'>

> [a.btn {

	padding:15px 22px !important;

	display:inline-block !important;

}]

> </style>

> <![endif]-->

         <title>Payment Completed</title>

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

    color: white;

    padding: 9px 32px;

    text-align: center;

    text-decoration: none;

    display: inline-block;

    font-size: 16px;

    font-weight: bold;

    text-transform: uppercase;

}        </style>

   
	

	
	<div id='invoice_print'>
        <table  width='100%' border='0' cellspacing='0' cellpadding='0' align='center' class='full'>

            <tr>

                <td height='1'>&nbsp;</td>

            </tr>

        </table>

        <table width='100%' border='0' cellspacing='0' cellpadding='0' class='full'>

            <tr>

                <td align='center'>

                    <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' class='devicewidth'>

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

                                        

										 <td height='40' align='center' style='border-bottom:1px solid #f1f1f1;font-size: 24px;font-weight: 500;color: #0f9d58;'>GST INVOICE/RECEIPT <span style='font-size:12px;color:#FF5722;'> GSTIN:33AAHCC7241D1Z1</span></td>

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

                    <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' class='devicewidth'>

                        <tr>

                            <td>

                                <table width='100%' bgcolor='#fbfbfb' border='0' cellspacing='0' cellpadding='0' align='center' class='full' style='background-color:#fbfbfb;'>

                                    <tr>

                                      

									   <td height='3' align='center' style=''>&nbsp;</td>

                                    </tr>

                                    <tr>

                                        <td style='padding:0 10px;'>

                                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>

                                                <tr>



                                                    <td>

                                                        <table width='100%' border='0' cellspacing='0' cellpadding='0' align='left' class='inner' id='banner' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'>

                                                            <tr>

																

                                                               <td >

																	<table width='100%' border='0' cellspacing='0' cellpadding='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'>

																		<tr>

																			<td style='width: 50%;' class='rw_2'>ORDER ID : #C2C".$user['id']."</td>

																			<td class='rw_2' style='width: 50%;text-align:right'>".date('d/m/Y')."</td>

																		</tr>

																	</table>

															   </td>

															    

                                                            </tr>

															<tr><td height='3' align='center' style=''>&nbsp;</td></tr>

														   <tr>

															

                                                                <td class='smallfont rw_1'>

                                                                  <table width='100%' border='0' cellspacing='0' cellpadding='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'>

																		<tr>

																			<td style='width: 50%;' class='rw_2'>TO : </td>

																			

																		</tr>

																		<tr><td style='padding-left:50px;font-weight: normal;' class='rw_2'>".$user['name']."</td></tr>

																		<tr><td style='padding-left:50px;font-weight: normal;' class='rw_2'>".$user['mobile']."</td></tr>

																		<tr><td style='padding-left:50px;font-weight: normal;' class='rw_2'>".$user['email']."</td></tr>

																		<tr><td style='padding-left:50px;font-weight: normal;' class='rw_2'>".$user_location['name']."</td></tr>

																		

																		

																	</table>

                                                                </td>

																

                                                            </tr>

															 

															<tr><td height='3' align='center' style=''>&nbsp;</td></tr>

															 

															<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' class=''>

															<tr>



																<td>

																	<table class='' border='1' cellspacing='0' cellpadding='6' style='border: 1px solid #0f9d58;width: 100%;'>

																		<thead>

																		<tr>

																		<th class=''  scope='col' style='color: #253f74;'>Subscription Details</th>

																		<th class=''  scope='col' style='color: #253f74;'>Validity</th>

																		<th class='' scope='col' style='color: #253f74;'>Amount</th>

																		</tr>

																		</thead>

																		<tbody>

																		<tr class=''>

																		<td class='' style=''>Core Connect</td>

																		<td class='' style=''>36 Months</td>

																		<td class='' ><span class=''><span class=''>Rs. </span>350.00</span>

																		</td>

																		</tr>

																		</tbody>

																		<tfoot>

																		<tr>

																		<th class='' style='color: #253f74;' colspan='2' scope='row'>CGST 9% </th>

																		<td class='' style=''><span class=''><span class=''>Rs. </span>31.50</span>

																		</td>

																		</tr>

																		<tr>

																		<th class='' style='color: #253f74;' colspan='2' scope='row'>SGST 9% </th>

																		<td class='' style=''><span class=''><span class=''>Rs. </span>31.50</span>

																		</td>

																		</tr>





																		<tr>

																		<th class='' style='color: #FF5722;' colspan='2' scope='row'>Net Total</th>

																		<td class='' style='color: #FF5722;'><strong><span class=''><span class=''>Rs. </span>413.00</span></strong></td>

																		</tr>

																		<tr>

																	

																		<td colspan='3' class='' style='color: #1a356d;'>

																		<strong><span>Rupees : </span>Four Hundred and Thirteen Rupees<span> Only</span></strong></td>

																		</tr>

																		</tfoot>

																		</table>

																	

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

       

      

		<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' class='full'>

            <tr>

                <td align='center'>

                    <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' class='devicewidth'>

                        <tr>

                            <td>

                                <table width='100%' bgcolor='#0f9d58' border='0' cellspacing='0' cellpadding='0' align='center' class='full' style='border-radius:0 0 7px 7px;background-color:#0f9d58;'>

                                    

									<tr><td style='text-align:center;color:#fff;font-size:17px;' class='rw_2'>CORE IND HR CONNECT PVT LTD</td></tr>	

									<!-- <tr><td style='text-align:center;color:#fff;' class='rw_1'>CORE IND HR CONNECT PVT LTD</td> -->

									<tr><td align='center' style='font:13px Helvetica,  Arial, sans-serif; color:#FFEB3B;'>Toll Free: <a style='color:#fff; text-decoration:none;' href='tel:1800 419 9522 '>1800 419 9522 </a>&nbsp; </td></tr>

									

									</tr>	

                                    

                                </table>

                            </td>

                        </tr>

                        <tr>

                            <td height='20'>&nbsp;</td>

                        </tr>

                    </table>

                </td>

            </tr>

        </table>
    </div>";

?>
<script>
function printDiv() 
{

  var divToPrint=document.getElementById('invoice_print');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
</script>