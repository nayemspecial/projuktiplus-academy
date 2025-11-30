<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    /**
     * ইমেইল টেমপ্লেট তালিকা
     */
    public function index()
    {
        $templates = EmailTemplate::all();
        return view('admin.email_templates.index', compact('templates'));
    }

    /**
     * টেমপ্লেট এডিট ফর্ম
     */
    public function edit($id)
    {
        $template = EmailTemplate::findOrFail($id);
        return view('admin.email_templates.edit', compact('template'));
    }

    /**
     * টেমপ্লেট আপডেট
     */
    public function update(Request $request, $id)
    {
        $template = EmailTemplate::findOrFail($id);

        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $template->update([
            'subject' => $request->subject,
            'body' => $request->body,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.email-templates.index')
            ->with('success', 'ইমেইল টেমপ্লেট সফলভাবে আপডেট করা হয়েছে।');
    }
    
    // create, store, destroy মেথডগুলো সাধারণত সিস্টেম টেমপ্লেটের জন্য লাগে না,
    // কারণ কী-ওয়ার্ড (Key) গুলো কোডে ফিক্সড থাকে। তবে চাইলে যোগ করা যায়।
}