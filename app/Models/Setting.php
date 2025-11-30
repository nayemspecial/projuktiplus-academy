<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    /**
     * সেটিংস পাওয়ার জন্য হেল্পার মেথড (ক্যাশ সহ)
     * ব্যবহার: Setting::get('site_name', 'Default Name')
     */
    public static function get($key, $default = null)
    {
        $settings = Cache::rememberForever('settings', function () {
            return self::all()->pluck('value', 'key');
        });

        return $settings[$key] ?? $default;
    }

    /**
     * সেটিংস সেভ বা আপডেট করার জন্য হেল্পার মেথড
     * ব্যবহার: Setting::set('site_name', 'New Name')
     */
    public static function set($key, $value = null)
    {
        $setting = self::updateOrCreate(['key' => $key], ['value' => $value]);
        
        // আপডেট হলে ক্যাশ ক্লিয়ার করতে হবে যাতে নতুন ডাটা পাওয়া যায়
        Cache::forget('settings');
        
        return $setting;
    }
}