<?php
namespace user;

use Auth\Auth;
use Fuel\Core\Validation;
use Fuel\Core\Security;

class Controller_Api_Auth extends \Fuel\Core\Controller_Rest
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
            'username' => Security::xss_clean(\Input::post('username')),
            'password' => Security::xss_clean(\Input::post('password')),
        );

        try
        {
            // validate login
            $val = self::loginValidation($request);
            if (!$val->run())
            {
                foreach($val->error() as $key => $e) {
                    $error[$key] = $e->get_message();
                }
                throw new \Exception(implode('<br />', $error));
            }
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
     * Signup API
     *
     * @return object
     */
    public function action_signup()
    {
        $request = array(
            'username' => Security::xss_clean(\Input::post('username')),
            'password' => Security::xss_clean(\Input::post('password')),
            'email' => Security::xss_clean(\Input::post('email')),
            'fullname' => Security::xss_clean(\Input::post('fullname')),
        );

        try
        {
            // validate sign up
            $val = self::signupValidation($request);
            if (!$val->run())
            {
                foreach($val->error() as $key => $e) {
                    $error[$key] = $e->get_message();
                }
                throw new \Exception(implode('<br />', $error));
            }
            // create user with auth class
            Auth::create_user(
                $request['username'],
                $request['password'],
                $request['email'],
                1,
                array(
                    'fullname' => $request['fullname']
                )
            );
            $data = array(
                'success' => true,
            );
        }
        catch (\Exception $e)
        {
            // duplicate email
            if ($e->getCode() === 2) {
                $data = array(
                    'success' => false,
                    'message' => 'Email is exist'
                );
            }
            // duplicate username
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
     * Validate login user
     *
     * @param $request
     * @return Validation
     */
    public static function loginValidation($request)
    {
        // validate form login
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

        // custom message
        $val->set_message('required', 'The :label is required');
        $val->set_message('min_length', 'The :label min length is :param:1');
        $val->set_message('max_length', 'The :label max length is :param:1');

        return $val;

    }

    /**
     * Validate user sigup such username, password, email, fullname
     *
     * @param $request
     * @return Validation
     */
    public static function signupValidation($request)
    {
        // validate form signup
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

        // custom message
        $val->set_message('required', 'The :label is required');
        $val->set_message('min_length', 'The :label min length is :param:1');
        $val->set_message('max_length', 'The :label max length is :param:1');
        $val->set_message('valid_string', 'The :label is not valid');
        $val->set_message('valid_email', 'The :label is not format');

        return $val;
    }
}