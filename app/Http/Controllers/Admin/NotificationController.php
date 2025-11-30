<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * নোটিফিকেশন তালিকা
     */
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * সব নোটিফিকেশন রিড হিসেবে মার্ক করা
     */
    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true, 
                'read_at' => now()
            ]);

        return back()->with('success', 'সব নোটিফিকেশন পড়া হয়েছে হিসেবে মার্ক করা হয়েছে।');
    }

    /**
     * নির্দিষ্ট নোটিফিকেশন দেখা
     */
    public function show($id)
    {
        $notification = Notification::where('user_id', Auth::id())->findOrFail($id);
        
        // ১. রিড মার্ক করা (যদি না থাকে)
        if (!$notification->is_read) {
            $notification->update([
                'is_read' => true,
                'read_at' => now()
            ]);
        }

        // [পরিবর্তন] অটো-রিডাইরেক্ট বন্ধ করা হয়েছে। 
        // এখন সরাসরি বিস্তারিত পেজ দেখাবে। সেখান থেকে ইউজার লিংকে যেতে পারবে।
        
        /*
        if (!empty($notification->data) && isset($notification->data['url'])) {
            return redirect($notification->data['url']);
        }
        */
        
        // ৩. লিংক না থাকলে বা অটো-রিডাইরেক্ট বন্ধ থাকলে বিস্তারিত ভিউ দেখান
        return view('admin.notifications.show', compact('notification'));
    }

    /**
     * নোটিফিকেশন ডিলিট করা
     */
    public function destroy($id)
    {
        $notification = Notification::where('user_id', Auth::id())->findOrFail($id);
        $notification->delete();

        return redirect()->route('admin.notifications.index')->with('success', 'নোটিফিকেশন মুছে ফেলা হয়েছে।');
    }
}