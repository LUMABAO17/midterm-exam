<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $role = strtolower((string) ($session->get('role') ?? ''));

        $path = trim($request->getUri()->getPath(), '/');

        // Determine requested area by prefix (PHP 7 compatible)
        $isAdminRoute = strpos($path, 'admin') === 0;
        $isTeacherRoute = strpos($path, 'teacher') === 0;
        $isStudentRoute = strpos($path, 'student') === 0;
        $isAnnouncements = ($path === 'announcements');

        // If no role set, deny access to protected routes
        if ($role === '') {
            return redirect()->to('/announcements')->with('error', 'Access Denied: Insufficient Permissions');
        }

        // Admin: allow /admin/*, deny teacher/student protected areas
        if ($isAdminRoute && $role !== 'admin') {
            return redirect()->to('/announcements')->with('error', 'Access Denied: Insufficient Permissions');
        }

        // Teacher: only allow /teacher/*
        if ($isTeacherRoute && $role !== 'teacher') {
            return redirect()->to('/announcements')->with('error', 'Access Denied: Insufficient Permissions');
        }

        // Student: only allow /student/* and /announcements when filter is applied to those
        if (($isStudentRoute || $isAnnouncements) && $role !== 'student') {
            return redirect()->to('/announcements')->with('error', 'Access Denied: Insufficient Permissions');
        }

        // Default: allow
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No post-processing needed
    }
}
