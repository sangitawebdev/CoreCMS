<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Option;

class SiteController extends Controller
{
    public function home()
    {
        // Example: fetch menu items or posts later
        $site_name = Option::get('site_name');
        $logo_url = Option::get('site_logo');

        $this->view('frontend/home', [
            'site_name' => $site_name,
            'logo_url'  => $logo_url
        ]);
    }
}
