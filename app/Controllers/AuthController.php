<?php namespace App\Controllers;


class AuthController extends BaseController
{

    //forms
    public function login()
    {

        return view('auth/login');
    }

    public function register(){
        helper(['form']);
        return view('auth/register');
    }

    public function store(){
        helper(['form']);
        $rules = [
            'fullname'          => 'required|min_length[2]|max_length[50]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[mst_customer.email]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'phone'         => 'required|min_length[7]|max_length[18]',
            'confirm_password'  => 'required|matches[password]'
        ];
        
        if($this->validate($rules)){
            $authModel = new \App\Models\AuthModel();
            $data_post = $this->request->getPost();

            $data_insert = [
                'name' => $data_post['fullname'],
                'email' => $data_post['email'],
                'phone' => $data_post['phone'],
                'password' => md5($data_post['password']),
                'level_id' => 1
            ];
            $authModel->insert($data_insert);
            return view('auth/login');
        }else{
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
        
        if(isset($user)){
            $session_data = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'level_id' => $user['level_id'],
                'isLoggedIn' => TRUE
            ];
            $session->set($session_data);
            return redirect()->to('home');
        } else {
            $session->setFlashdata('msg', 'Email or Password is incorrect!');
            return view('auth/login');
        }

    }

    public function logout()
    {
        session_destroy();
        return redirect()->to(base_url('login'));
    }

}
