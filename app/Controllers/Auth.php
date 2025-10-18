<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function showLogin()
    {
        return view('login');
    }

    public function login()
    {
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (!$username || !$password) {
            return redirect()->to('/login')->with('error', 'Please provide both username and password.');
        }

        $users = new UserModel();
        $user = $users->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password_hash'] ?? '')) {
            return redirect()->to('/login')->with('error', 'Invalid username or password.');
        }

        // Set session
        $session->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'role' => strtolower($user['role'] ?? ''),
            'logged_in' => true,
        ]);

        // Redirect by role
        $role = strtolower($user['role'] ?? '');
        if ($role === 'student') {
            return redirect()->to('/announcements');
        }
        if ($role === 'teacher') {
            return redirect()->to('/teacher/dashboard');
        }
        if ($role === 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->to('/dashboard');
    }
}
