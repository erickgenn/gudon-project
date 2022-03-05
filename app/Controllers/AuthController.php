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
        // helper(['form']);
        return view('auth/forgot_password');
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
    if (isset($_POST['forgot-password'])) {
        $email = $_POST['email'];

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
        
        if (count($errors) == 0) {
            
        }

        $sql 

    }





}
