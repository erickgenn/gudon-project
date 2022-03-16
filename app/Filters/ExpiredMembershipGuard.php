<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ExpiredMembershipGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if ($_SESSION['time_left'] <= 0) {
            return redirect()
                ->to('expiredmembership');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
