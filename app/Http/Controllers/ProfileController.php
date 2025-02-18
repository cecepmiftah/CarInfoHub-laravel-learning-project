<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        return view('profile.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
       if(Gate::denies('update-user', $user)) {
        abort(403);
       }

       $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'phone' => 'required|min:10|numeric',
       ]);

        $user->fill($validated);

    if ($user->isDirty()) {
        $user->save();
        return redirect()->route('user.edit', $user)->with('success', 'Profile updated successfully');
    }

    if($user->isClean()) {
        return redirect()->route('user.edit', $user)->with('error', 'No changes were made');
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updatePassword(Request $request, User $user) 
    {
        if(Gate::denies('update-user', $user)) {
            abort(403);
           }

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('user.edit', $user)->with('success', 'Password updated successfully');
    }
}
