<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // قواعد التحقق للصورة
        ]);
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            // تخزين الصورة في مجلد 'public/avatars'
            // 'avatars' هو اسم المجلد داخل مجلد 'storage/app/public'
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            // $avatarPath سيحتوي على المسار مثل 'avatars/random_filename.jpg'
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatarPath, // حفظ المسار في قاعدة البيانات
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
