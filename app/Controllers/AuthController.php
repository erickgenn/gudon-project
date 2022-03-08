<?php

namespace App\Controllers;

use App\Models\MembershipModel;
use App\Models\Subscription;
use DateInterval;
use DateTime;


class AuthController extends BaseController
{

    //forms
    public function login()
    {

        return view('auth/login');
    }

    public function loginAdmin()
    {

        return view('auth/loginadmin');
    }

    public function register()
    {
        helper(['form']);
        return view('auth/register');
    }

    public function forgot_password()
    {
        return view('auth/forgot_password');
    }

    public function auth_changepass($token)
    {
        return view('auth/change_password', compact('token'));
    }

    
    public function new_password($token)
    {
        $session=session();
        $data = $this->request->getPost();

            $encrypted_email = md5($data['email']);
            if ($token == $encrypted_email) {
                $data_update = [
                    'password' => md5($data["password"]),
                ];
                $userModel = new \App\Models\AuthModel();
                $user = $userModel->where('email', $data['email'])->first();
           
                $userModel->update($user['id'], $data_update);
        
                return redirect()->to('login');
                
            }else{
                $session->setFlashdata('msg', 'Email is incorrect!');
                return redirect()->to('forgot_password/forgot/changepass/'.$token);           
            }

 
        
    }

    public function auth_forgotpass() {
        $session = session();
        $data = $this->request->getPost();
        $email = $data['email'];
        $authModel = new \App\Models\AuthModel();
        $user = $authModel->where('email', $email)->first();
        if($user == null) {
            $session->setFlashdata('msg', 'User Not Found!');
            return view('auth/login');
        } else { 
            $encrypted_token = md5($user['email']);
            $url_changepass = base_url('forgot_password/forgot/changepass')."/".$encrypted_token;
            $email = \Config\Services::email();
            $email->setFrom('gudon.adm@gmail.com', "GuDon Admin");
            $email->setTo($user['email']);
            $email->setSubject('Reset Passsword GuDon');
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
                                                            <img class="img-fluid" src="https://drive.google.com/uc?export=view&id=1MhwB2pLXtUv4oejYg30KB7_vmo7X3CPy" allow="autoplay" alt="GuDon" style="width: 5vw; height: auto; line-height: 100%; outline: none; text-decoration: none; display: block; max-width: 100%; border-style: none; border-width: 0;" width="100%">
                                                            <div style="margin: 22px 0 0 15px;">
                                                            <h2 style="font-weight: bold; font-size: 2.5vw; padding-top: 0; padding-bottom: 0; vertical-align: center; line-height: 38.4px; margin: 0;" align="LEFT">GUDON</h2>
                                                            </div>
                                                        </div>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </div>
                                                </div>
                                                <table class="p-4" role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                    <td style="line-height: 24px; font-size: 16px; margin: 0; padding: 16px;" align="left">
                                                        <div class="">
                                                        <h5 class="text-muted" style="font-size: 2vw; color: #718096; padding-top: 0; padding-bottom: 0; font-weight: 500; vertical-align: baseline; line-height: 24px; margin: 0;" align="left">Reset Password</h5>
                                                        <table class="s-2 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                                                            <tbody>
                                                            <tr>
                                                                <td style="line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left" width="100%" height="8">
                                                                &#160;
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        <p style="font-size: 1.2vw; line-height: 24px; width: 100%; margin: 0;" align="left">Hello '.$user['name'].', Your GuDon account has just requested a password change, please click the button below to continue</p>
                                                        <br>
                                                        <table class="btn" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important;">
                                                            <tbody>
                                                            <tr>
                                                                <td style="line-height: 24px; font-size: 16px; border-radius: 6px; margin: 0;" align="center">
                                                                <a href="'.$url_changepass.'" style="font-size: 2vh; background-color: #5cc5e6; color: #FFFFFF; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 6px; line-height: 20px; display: block; font-weight: normal; white-space: nowrap; padding: 8px 12px; border: 1px solid transparent;">
                                                                    Reset Password Anda
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
            if($email->send()) {
                $session->setFlashdata('msg', 'Please check your Email!');
                return view('auth/login');
            } else {
                $session->setFlashdata('msg', 'Email failed to be sent, Please try again later!');
                return view('auth/login');
            }


            // $headers[] = 'MIME-Version: 1.0';
            // $headers[] = 'Content-type: text/html; charset=iso-8859-1';

            // // Additional headers
            // $headers[] = 'From: GuDon Admin <admin@gudon.com>';

            // $url_changepass = base_url('forgot/changepass').$encrypted_token;
            // $to = $user['email'];
            // $subject = 'Reset Passsword GuDon';
            // $message = '
            // <html>
            //     <head>
            //     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            //     <style>
            //         /* Add custom classes and styles that you want inlined here */
            //     </style>
            //     </head>
            //     <body class="bg-light">
            //     <div class="container-fluid">
            //         <div class="card my-5">
            //         <div class="card-body">
            //             <div style="background-color:#5cc5e6;padding: 20px 0px 20px 20px; color:#FFFFFF;">
            //             <div class="row">
            //                 <div style="display:flex">
            //                 <img class="img-fluid" src="https://drive.google.com/thumbnail?id=1MhwB2pLXtUv4oejYg30KB7_vmo7X3CPy" 
            //                 alt="GuDon" style="width:75;"/>
            //                 <div style="margin:22px 0 0 15px"><h2 style="font-weight:bold; font-size:5vw">GUDON</h2></div>
            //                 </div>
            //             </div>
            //             </div>
            //             <div class="p-4">
            //                 <h5 class="text-muted mb-2" style="font-size:3.5vw">Reset Password</h5>
            //                 <p style="font-size: 2.5vh">Halo '.$user['name'].', akun GuDon anda baru saja mengajukan perubahan password, silahkan klik tombol dibawah ini untuk melanjutkan</p>
            //                 <br>
            //             <a href="'.$url_changepass.'" class="btn" style="font-size: 2vh;background-color:#5cc5e6;color:#FFFFFF">
            //             Reset Password Anda
            //                 </a>
            //             </div>
            //                 <h5 class="text-muted mb-2 text-center" style="font-size:1.5vh">© GuDon</h5>
            //         </div>
            //         </div>
            //     </div>
            //     </body>
            // </html>
            // ';
            // mail($to, $subject, $message, implode("\r\n", $headers));
            $session->setFlashdata('msg', 'Please check your Email!');
            return view('auth/login');
        }
    }

    public function store()
    {
        helper(['form']);
        $rules = [
            'fullname'          => 'required|min_length[2]|max_length[50]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[mst_customer.email]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'phone'         => 'required|min_length[7]|max_length[18]',
            'confirm_password'  => 'required|matches[password]'
        ];

        if ($this->validate($rules)) {
            $authModel = new \App\Models\AuthModel();
            $data_post = $this->request->getPost();

            $data_insert = [
                'name' => $data_post['fullname'],
                'email' => $data_post['email'],
                'phone' => $data_post['phone'],
                'password' => md5($data_post['password'])
            ];
            $authModel->insert($data_insert);
            return view('auth/login');
        } else {
            $data['validation'] = $this->validator;
            echo view('auth/register', $data);
        }
    }

    public function loginAuth()
    {
        $session = session();
        $data = $this->request->getPost();
        $email = $data['email'];
        $password = md5($data['password']);

        $authModel = new \App\Models\AuthModel();

        $user = $authModel->where('email', $email)->where('password', $password)->first();
        
        // get user current subs
        $subsModel = new Subscription();
        $subs = $subsModel->where('cust_id', $user['id'])->where('is_active', 1)->first();
        if(!$subs) {
            $level['name'] = 'NOT RATED';
            $time_left= 0;
            $percentage_left = 0;
            $subs['level_id'] = 0;
        } else {
            $subscription_date = $subs['subscription_date'];
            $date = new DateTime($subscription_date);
            $date->add(new DateInterval('P30D'));
            $time_left = round((strtotime($date->format('Y-m-d')) - time()) / (60 * 60 * 24));
            $percentage_left = round($time_left/30*100);

            // get user membership level name
            $levelModel = new MembershipModel();
            $level = $levelModel->where('id',$subs['level_id'])->first();
        }
        
        if(isset($user)){
            $session_data = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'level_id' => $subs['level_id'],
                'level' => $level['name'],
                'time_left' => $time_left,
                'percentage_left' => $percentage_left,
                'isLoggedIn' => TRUE,
                'role' => 'customer'
            ];
            $session->set($session_data);
            return redirect()->to('home');
        } else {
            $session->setFlashdata('msg', 'Email or Password is incorrect!');
            return view('auth/login');
        }
    }

    public function loginAuthAdmin()
    {
        $session = session();
        $data = $this->request->getPost();
        $email = $data['email'];
        $password = md5($data['password']);

        $authModel = new \App\Models\AdminModel();

        $user = $authModel->where('email', $email)->where('password', $password)->first();

        if (isset($user)) {
            $session_data = [
                'id' => $user['id'],
                'email' => $user['email'],
                'isLoggedIn' => TRUE,
                'role' => 'admin'
            ];
            $session->set($session_data);
            return redirect()->to('admin/index');
        } else {
            $session->setFlashdata('msg', 'Email or Password is incorrect!');
            return view('auth/loginadmin');
        }
    }

    public function logout()
    {
        session_destroy();
        return redirect()->to(base_url('login'));
    }

    

    // if user clicks on the forgot passwordnya
    // if (isset($_POST['forgot-password'])) {
    //     $email = $_POST['email'];

    //     if ($this->validate($rules)) {
    //         $authModel = new \App\Models\AuthModel();
    //         $data_post = $this->request->getPost();

    //         $data_insert = [
    //             'name' => $data_post['fullname'],
    //             'email' => $data_post['email'],
    //             'phone' => $data_post['phone'],
    //             'password' => md5($data_post['password'])
    //         ];
    //         $authModel->insert($data_insert);
    //         return view('auth/login');
    //     } else {
    //         $data['validation'] = $this->validator;
    //         echo view('auth/register', $data);
    //     }
        
    //     if (count($errors) == 0) {
            
    //     }

    //     $sql 

    // }





}
