<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Show the About Us page.
     */
    public function about()
    {
        return view('frontend.about');
    }

    /**
     * Show the Contact Us page.
     */
    public function contact()
    {
        return view('frontend.contact');
    }

    /**
     * Show the Mentor Profile page.
     */
    public function mentor()
    {
        return view('frontend.mentor');
    }

    /**
     * Show Success Stories page.
     */
    public function success()
    {
        return view('frontend.success');
    }

    /**
     * Show Blog page.
     */
    public function blog()
    {
        return view('frontend.blog');
    }

    /**
     * Show FAQ page.
     */
    public function faq()
    {
        return view('frontend.faq');
    }

    // ================= Policy Pages =================

    /**
     * Show Privacy Policy page.
     */
    public function privacy()
    {
        return view('frontend.policy.privacy');
    }

    /**
     * Show Terms & Conditions page.
     */
    public function terms()
    {
        return view('frontend.policy.terms');
    }

    /**
     * Show Refund Policy page.
     */
    public function refund()
    {
        return view('frontend.policy.refund');
    }
}