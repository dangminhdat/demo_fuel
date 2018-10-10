<?php
namespace user;

use Auth\Auth;
use Fuel\Core\Validation;
use Fuel\Core\Security;

class Controller_Api_Login extends \Fuel\Core\Controller_Rest
{
    protected $format = "json";

    /**
     * Login API
     *
     * @return object
     */
    public function action_login()
    {
        // get parameter
        $request = array(
            'username' => Security::xss_clean(\Input::json('username')),
            'password' => Security::xss_clean(\Input::json('password')),
        );

        try
        {
            // check database
            $user = Auth::login($request['username'], $request['password']);
            if ($user) {
                $data = array(
                    'success' => true,
                    'authenication' => Security::generate_token()
                );
            }
            // if not found
            else
            {
                throw new \Exception(\user\Constant_const::ERROR_LOGIN_INVALID);
            }
        }
        catch (\Exception $e) {
            $data = array(
                'success' => false,
                'message' => $e->getMessage()
            );
        }
        return $this->response(
            $data
        );
    }

    /**
     * API Signup
     */
    public function action_signup()
    {
        $request = array(
            'username' => Security::xss_clean(\Input::json('username')),
            'password' => Security::xss_clean(\Input::json('password')),
            'email' => Security::xss_clean(\Input::json('email')),
            'fullname' => Security::xss_clean(\Input::json('fullname')),
        );

        try
        {
            Auth::create_user(
                'admin',
                '123456',
                'dangminhdat.qnam@gmail.com',
                1,
                array(
                    'fullname' => 'DAT'
                )
            );
            $data = array(
                'success' => true,
            );
        }
        catch (\Exception $e)
        {
            if ($e->getCode() === 2) {
                $data = array(
                    'success' => false,
                    'message' => 'Email is exist'
                );
            }
            else if ($e->getCode() === 3) {
                $data = array(
                    'success' => false,
                    'message' => 'Username is exist'
                );
            }
            else {
                $data = array(
                    'success' => false,
                    'message' => $e->getMessage()
                );
            }
        }

        return $this->response(
            $data
        );
    }

    /**
     * Validate user sigup such username, password, email, fullname
     *
     * @param $request
     * @return Validation
     */
    public static function signupValidation($request)
    {
        // validate form register
        $val = Validation::forge();

        // validate username
        $val->add('username', 'Username')
            ->add_rule('required')
            ->add_rule('min_length', 6)
            ->add_rule('max_length', 32)
            ->add_rule('valid_string', array('alpha', 'numeric'));

        // validate password
        $val->add('password', 'Password')
            ->add_rule('required')
            ->add_rule('min_length', 6)
            ->add_rule('max_length', 32);

        // validate email
        $val->add('email', 'Email')
            ->add_rule('required')
            ->add_rule('min_length', 6)
            ->add_rule('max_length', 32)
            ->add_rule('valid_email');

        // validate fullname
        $val->add('fullname', 'Fullname')
            ->add_rule('required')
            ->add_rule('max_length', 32)
            ->add_rule('valid_string', array('alpha', 'specials'));

        // custom message field
        $val->set_message('required', 'The :label is required');
        $val->set_message('min_length', 'The :label min length is :param:1');
        $val->set_message('max_length', 'The :label max length is :param:1');
        $val->set_message('valid_string', 'The :label is not valid');
        $val->set_message('valid_email', 'The :label is not format');
        return $val;
    }
}