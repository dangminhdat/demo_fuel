<?php

class Controller_Auth extends Controller_Template
{
    /**
     * Login for UI
     *
     * @return mixed
     * @throws Exception
     */
    public function action_login()
    {
        $data['data'] = array(
            'username' => Session::get_flash('username'),
            'password' => Session::get_flash('password')
        );
        $this->template->title = 'Login';
        $this->template->content = View::forge('auth/login', $data);
    }

    /**
     * Index Authenication
     */
    public function action_index()
    {
        $this->template->set_global('username', Auth::get_screen_name());
        $this->template->title = 'Index';
        $this->template->content = View::forge('auth/index');
    }

    /**
     * Signup function
     *
     * @return mixed
     */
    public function action_signup()
    {
        // render view register
        $data["data"] =  array(
            'username' => Session::get_flash('username'),
            'email' => Session::get_flash('email'),
            'password' => Session::get_flash('password'),
            'fullname' => Session::get_flash('fullname'),
        );
        $this->template->title = 'Signup';
        $this->template->content = View::forge('auth/signup', $data);
    }

}
