<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class profilController extends Controller
{
    public function edit()
    {
        try {
            $user = Auth::user();
            return view('dashboard.profile.edit', [
                'user' => $user,
                'countries' => Countries::getNames(),
                'locale' => Languages::getNames(),
            ]);
        } catch (\Exception $e) {
        }
    }
    public function update(Request $request)
    {
        try {

            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'birth_date' => ['nullable', 'date', 'before:today'],
                'gender' => ['in:male,female'],
                'country' => ['required', 'string', 'size:2'],
            ]);
            $user = $request->user();
            $user->profile->fill($request->all())->save();
            return redirect()->route('profile.edit')->with('success', 'profile update');
        } catch (\Exception $e) {
        }
        // $profile = $user->profile;
        // if ($profile->user_id) {
        //     $profile->update($request->all());
        // } else {
        //     $user->profile->create($request->all());
        // }
    }
}