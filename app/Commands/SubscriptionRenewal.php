<?php

namespace App\Commands;

use App\Models\Subscription;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

use DateTime;
use DateInterval;
use Exception;

class SubscriptionRenewal extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Email Service';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'Email:SubscriptionRenewal';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'A service for sending emails to remind GUDON user subscription renewal';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'Email:SubscriptionRenewal [arguments] [options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        try {
            $modelSubscription= new Subscription();
            $all_subs = $modelSubscription->getSubscriptions();


            for($i=0;$i<count($all_subs);$i++) {
                $date = new DateTime($all_subs[$i]['subscription_date']);
                $date->add(new DateInterval('P30D'));
                $all_subs[$i]['subscription_date'] = $date->format('Y-m-d');
                if(ceil((strtotime($date->format('Y-m-d')) - time()) / (60 * 60 * 24)) <= 5) {
                    $low_subs[] = $all_subs[$i];
                } 
            }
            if(isset($low_subs)) {
                for($i=0;$i<count($low_subs);$i++) {
                    $email = \Config\Services::email();
                    $url_changepass = base_url('membership/upgrade');
                    $email->setFrom('gudon.adm@gmail.com', "GuDon Admin");
                    $email->setTo($low_subs[$i]['cust_email']);
                    $email->setSubject('Subscription Renewal GUDON');
                    $email->setMessage('
                    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
                        <html>
                            <head>
                                <!-- Compiled with Bootstrap Email version: 1.1.2 --><meta http-equiv="x-ua-compatible" content="ie=edge">
                                <meta name="x-apple-disable-message-reformatting">
                                <meta name="viewport" content="width=device-width, initial-scale=1">
                                <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                <style type="text/css">
                                body,table,td{font-family:Helvetica,Arial,sans-serif !important}.ExternalClass{width:100%}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height:150%}a{text-decoration:none}*{color:inherit}a[x-apple-data-detectors],u+#body a,#MessageViewBody a{color:inherit;text-decoration:none;font-size:inherit;font-family:inherit;font-weight:inherit;line-height:inherit}img{-ms-interpolation-mode:bicubic}table:not([class^=s-]){font-family:Helvetica,Arial,sans-serif;mso-table-lspace:0pt;mso-table-rspace:0pt;border-spacing:0px;border-collapse:collapse}table:not([class^=s-]) td{border-spacing:0px;border-collapse:collapse}@media screen and (max-width: 600px){.w-full,.w-full>tbody>tr>td{width:100% !important}.p-4:not(table),.p-4:not(.btn)>tbody>tr>td,.p-4.btn td a{padding:16px !important}*[class*=s-lg-]>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-2>tbody>tr>td{font-size:8px !important;line-height:8px !important;height:8px !important}.s-5>tbody>tr>td{font-size:20px !important;line-height:20px !important;height:20px !important}}
                                </style>
                                <link rel="preconnect" href="https://fonts.googleapis.com">
                                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                                <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
                            </head>
                            <body class="bg-light" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc">
                                <table class="bg-light body" valign="top" role="presentation" border="0" cellpadding="0" cellspacing="0" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc">
                                <tbody>
                                    <tr>
                                    <td valign="top" style="line-height: 24px; font-size: 16px; margin: 0;" align="left" bgcolor="#f7fafc">
                                        <table class="container-fluid" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                        <tbody>
                                            <tr>
                                            <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 0 16px;" align="left">
                                                <table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                                <tbody>
                                                    <tr>
                                                    <td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">
                                                        &#160;
                                                    </td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                                <table class="card" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important; width: 100%; overflow: hidden; border: 1px solid #e2e8f0;" bgcolor="#ffffff">
                                                <tbody>
                                                    <tr>
                                                    <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0;" align="left" bgcolor="#ffffff">
                                                        <table class="card-body" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                        <tbody>
                                                            <tr>
                                                            <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 20px;" align="left">
                                                                <div style="background-color: #5cc5e6; color: #FFFFFF; padding: 20px 0px 20px 20px;">
                                                                <div class="row" style="margin-right: -24px;">
                                                                    <table class="" role="presentation" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed; width: 100%;" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                        <div style="display: flex;">
                                                                            <img class="img-fluid" src="https://drive.google.com/uc?export=view&id=1MhwB2pLXtUv4oejYg30KB7_vmo7X3CPy" allow="autoplay" alt="GuDon" style="display: block; width: auto; height: 100px; max-width: 100%; max-height: 90%; line-height: 100%; outline: none; text-decoration: none; display: block; border-style: none; border-width: 0;">
                                                                            <div style="margin: auto 0; width: 50%; padding:25px">
                                                                            <h2 style="font-weight: bold; font-size: 4vmin; padding-top: 0; padding-bottom: 0; vertical-align: center; line-height: 38.4px; margin: 0;" align="LEFT">GUDON</h2>
                                                                            </div>
                                                                        </div>
                                                                        </tr>
                                                                    </tbody>
                                                                    </table>
                                                                </div>
                                                                </div>
                                                                <table class="p-4" role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                                <tbody style="font-family: Roboto, sans-serif;">
                                                                    <tr>
                                                                    <td style="line-height: 24px; font-size: 16px; margin: 0; padding: 16px;" align="left">
                                                                        <div class="">
                                                                        <h5 class="text-muted" style="font-size: 2vmin; color: #718096; padding-top: 0; padding-bottom: 0; font-weight: 500; vertical-align: baseline; line-height: 24px; margin: 0;" align="left">Subscription Renewal</h5>
                                                                        <table class="s-2 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td style="line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left" width="100%" height="8">
                                                                                &#160;
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <p style="font-size: 1.8vmin; line-height: 24px; width: 100%; margin: 0;" align="left">Hello  '.ucwords($low_subs[$i]['cust_name']).', Your GuDon account subscription is about to end! Your subscription is still valid until '.$low_subs[$i]['subscription_date'].'. Please click the button below to extend your subscription.</p>
                                                                        <br>
                                                                        <table class="btn" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important;">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td style="line-height: 24px; font-size: 16px; border-radius: 6px; margin: 0;" align="center">
                                                                                <a href='.$url_changepass.' style="font-size: 2vh; background-color: #5cc5e6; color: #FFFFFF; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 6px; line-height: 20px; display: block; font-weight: normal; white-space: nowrap; padding: 8px 12px; border: 1px solid transparent;">
                                                                                    Renew Your Subscription
                                                                                </a>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        </div>
                                                                    </td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                                <h5 class="text-muted  text-center" style="font-size: 1.5vh; color: #718096; padding-top: 0; padding-bottom: 0; font-weight: 500; vertical-align: baseline; line-height: 24px; margin: 0;" align="center">&#169; GuDon</h5>
                                                                <table class="s-2 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                                                <tbody>
                                                                    <tr>
                                                                    <td style="line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left" width="100%" height="8">
                                                                        &#160;
                                                                    </td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                            </td>
                                                            </tr>
                                                        </tbody>
                                                        </table>
                                                    </td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                                <table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                                <tbody>
                                                    <tr>
                                                    <td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">
                                                        &#160;
                                                    </td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </td>
                                    </tr>
                                </tbody>
                                </table>
                            </body>
                        </html>
                    ');
                    if ($email->send()) {
                        CLI::newLine( 1 );
                        CLI::write( 'Email Subscription Renewal for '.ucwords($low_subs[$i]['cust_name']).' ('.$low_subs[$i]['cust_email'].') Successful', 'black', 'green' );
                    } else {
                        CLI::newLine( 1 );
                        CLI::write( 'Email Subscription Renewal for '.ucwords($low_subs[$i]['cust_name']).' ('.$low_subs[$i]['cust_email'].') Failed', 'white', 'red' );
                    }
                }
            }
            else {
                CLI::newLine( 1 );
                CLI::write( 'All users still on subscription', 'black', 'yellow' );
                CLI::newLine( 1 );
            }
        } catch (Exception) {
            CLI::newLine( 1 );
            CLI::write( 'Something wrong with function, please try again' );
            CLI::newLine( 1 );
        }
        
    }
}
