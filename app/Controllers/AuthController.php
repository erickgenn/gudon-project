<?php namespace App\Controllers;


class AuthController extends BaseController
{

    //forms
    public function login()
    {

        $authModel = new \App\Models\AuthModel();


        $user = $authModel->findAll();
        // $user = $authModel->where('deleted', 0)->first();


        dd($user);
        die();
        return view('auth/login');
    }

    // public function loginAuth()
    // {
    //     // $data = $this->request->getPost();
    //     // $email = $data['email'];
    //     // $password = md5($data['password']);

    //     $authModel = new AuthModel();

    //     $user = $authModel->findAll();
    //     // $user = $authModel->where('deleted', 0)->first();


    //     dd($user);
    //     die();
    //     // $array = ['email' => $name, 'title' => $title, 'status' => $status];
    //     // $builder->where($array);

    // }

}
