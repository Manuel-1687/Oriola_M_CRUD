<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller
{
    public function login()
    {
        if ($this->is_authenticated()) {
            redirect('/products');
        }

        $this->call->view('auth/login', ['error' => null]);
    }

    public function authenticate()
    {
        $username = trim((string) $this->request->post('username'));
        $password = (string) $this->request->post('password');

        if ($username === 'admin' && $password === 'admin') {
            $this->session->regenerate_on_login();
            $this->session->set_userdata('authenticated', true);
            $this->session->set_userdata('username', 'admin');
            redirect('/products');
        }

        $this->call->view('auth/login', ['error' => 'Invalid username or password.']);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/login');
    }

    private function is_authenticated()
    {
        return $this->session->userdata('authenticated') === true;
    }
}
