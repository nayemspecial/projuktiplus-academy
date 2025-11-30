<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * হোম পেজ দেখানোর মেথড
     * পারফরমেন্স টিপ: ভবিষ্যতে এখানে Cache::remember() ব্যবহার করে ডাটা ক্যাশ করা হবে।
     */
    public function index()
    {
        // ভবিষ্যতে এখানে কোর্স বা টেস্টিমোনিয়াল ডাটাবেস থেকে আনবেন
        // আপাতত শুধু ভিউ রিটার্ন করছি
        return view('frontend.home');
    }
}