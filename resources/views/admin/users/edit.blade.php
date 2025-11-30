@extends('layouts.admin')

@section('title', 'ইউজার এডিট')

@section('header', 'ইউজার এডিট: ' . $user->name)

@section('actions')
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> ফিরে যান
    </a>
@endsection

@section('admin-content')
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="col-span-2 md:col-span-1">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">নাম <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required 
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white dark:bg-slate-900 text-gray-900 dark:text-white">
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div class="col-span-2 md:col-span-1">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ইমেইল <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required 
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white dark:bg-slate-900 text-gray-900 dark:text-white">
                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Phone -->
                <div class="col-span-2 md:col-span-1">
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ফোন নাম্বার</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" 
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white dark:bg-slate-900 text-gray-900 dark:text-white">
                    @error('phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Role -->
                <div class="col-span-2 md:col-span-1">
                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">রোল <span class="text-red-500">*</span></label>
                    <select name="role" id="role" required 
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white dark:bg-slate-900 text-gray-900 dark:text-white">
                        @foreach($roles as $role)
                            <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                        @endforeach
                    </select>
                    @error('role') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Password (Optional) -->
                <div class="col-span-2 md:col-span-1">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">নতুন পাসওয়ার্ড (পরিবর্তন করতে চাইলে)</label>
                    <input type="password" name="password" id="password" 
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white dark:bg-slate-900 text-gray-900 dark:text-white">
                    @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Confirm Password -->
                <div class="col-span-2 md:col-span-1">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">পাসওয়ার্ড নিশ্চিত করুন</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white dark:bg-slate-900 text-gray-900 dark:text-white">
                </div>

                <!-- Status -->
                <div class="col-span-2 md:col-span-1">
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">স্ট্যাটাস <span class="text-red-500">*</span></label>
                    <select name="status" id="status" required 
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white dark:bg-slate-900 text-gray-900 dark:text-white">
                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active (সক্রিয়)</option>
                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive (নিষ্ক্রিয়)</option>
                        <option value="banned" {{ old('status', $user->status) == 'banned' ? 'selected' : '' }}>Banned (নিষিদ্ধ)</option>
                    </select>
                    @error('status') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Profile Photo -->
                <div class="col-span-2 md:col-span-1">
                    <label for="profile_photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">প্রোফাইল ছবি</label>
                    <div class="mt-1 flex items-center">
                        <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100 dark:bg-slate-700 mr-4">
                            @if($user->avatar)
                                <img src="{{ asset('storage/'.$user->avatar) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                            @else
                                <svg class="h-full w-full text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            @endif
                        </span>
                        <input type="file" name="profile_photo" id="profile_photo" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-700 dark:file:text-gray-300">
                    </div>
                    @error('profile_photo') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Address -->
                <div class="col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ঠিকানা</label>
                    <textarea name="address" id="address" rows="2" 
                              class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white dark:bg-slate-900 text-gray-900 dark:text-white">{{ old('address', $user->address) }}</textarea>
                    @error('address') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Bio -->
                <div class="col-span-2">
                    <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">বায়ো</label>
                    <textarea name="bio" id="bio" rows="3" 
                              class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white dark:bg-slate-900 text-gray-900 dark:text-white">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <i class="fas fa-save mr-2"></i> আপডেট করুন
                </button>
            </div>
        </form>
    </div>
@endsection