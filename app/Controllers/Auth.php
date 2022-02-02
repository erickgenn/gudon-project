<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }
    public function index()
    {
        return view('auth/login');
    }
    public function register()
    {
        $data=[];
        $data1 = $this->request->getPost();
        if ($this->request->getMethod() == 'post'){
            $rules = [
                'firstname' => 'required|min-length[3]|max-length[25]',
                'email' => 'required|valid_email|is_unique[user.email]',
                'password'=>'required|min_length[5]|max_length[12]',
                'rpassword'=>'required|min_length[5]|max_length[12]|matches[password]'
            ];
            dd($data1);
            die();
            if (! $this->validate($rules)){
                $data['validation'] = $this->validatior; 
            }else{

            }
        }

        return view('auth/register');
    }
    // public function save()
    // {
    //     $validation = $this->validate([
    //         'name'=>'required',
    //         'email'=>'required|valid_email|is_unique[user.email]',
    //         'password'=>'required|min_length[5]|max_length[12]',
    //         'rpassword'=>'required|min_length[5]|max_length[12]|matches[password]'
    //     ]);

    //     if(!$validation){
    //         return view('auth/register',['validation'=>$this->validator]);
    //     }else{
    //         echo 'Form validated succesfully';
    //     }
    // }
   
}
