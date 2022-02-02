<?php namespace App\Controllers;


class AuthController extends BaseController
{

    //forms
    public function login()
    {

        return view('auth/login');
    }

    public function loginAuth()
    {
        $data = $this->request->getPost();
        $email = $data['email'];
        $password = md5($data['password']);

        $authModel = new \App\Models\AuthModel();

        $user = $authModel->where('email', $email)->where('password', $password)->first();

        if(isset($user)){
            return view('dashboard');
        } else {
            return view('auth/login');
        }

    }

}
