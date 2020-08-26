<?php

namespace App\Http\Controllers;

use App\Services\Admin\HomeService;
use App\Services\Admin\IssueService;
use App\Services\Admin\LogService;
use App\Services\Admin\OrderService;
use App\Services\Admin\PackageService;
use App\Services\Admin\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected $userService;
    protected $issueService;
    protected $packageService;
    protected $homeService;
    protected $orderService;
    protected $logService;

    /**
     * Create a new controller instance.
     *
     * @param UserService    $userService
     * @param IssueService   $issueService
     * @param PackageService $packageService
     * @param HomeService    $homeService
     * @param OrderService   $orderService
     * @param LogService     $logService
     *
     * @return void
     */
    public function __construct(UserService $userService, IssueService $issueService, PackageService $packageService, HomeService $homeService, OrderService $orderService, LogService $logService)
    {
        $this->middleware('auth');
        $this->middleware('is_admin');

        $this->userService = $userService;
        $this->issueService = $issueService;
        $this->packageService = $packageService;
        $this->homeService = $homeService;
        $this->orderService = $orderService;
        $this->logService = $logService;
    }
}
