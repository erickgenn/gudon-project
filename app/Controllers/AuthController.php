<?php namespace App\Controllers;


class AuthController extends BaseController
{

    //forms
    public function login()
    {

        return view('auth/login');
    }

    public function register(){
        return view('auth/register');
    }

    public function store(){
        $data = $this->request->getPost();
        $authModel = new \App\Models\AuthModel();

        $email = $data['email'];

        $user = $authModel->where('email', $email)->first();

        if(! isset($user)){
            $data_insert = [
                'name' => $data['fullname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => md5($data['password']),
                'level_id' => 1
            ];

            $authModel->insert($data_insert);
            return view('auth/login');
            
        }

    }

    public function loginAuth()
    {
        $data = $this->request->getPost();
        $email = $data['email'];
        $password = md5($data['password']);

        $authModel = new \App\Models\AuthModel();

        $user = $authModel->where('email', $email)->where('password', $password)->first();

        if(isset($user)){
            return redirect()->to('/');
        } else {
            return view('auth/login');
        }

    }

}
