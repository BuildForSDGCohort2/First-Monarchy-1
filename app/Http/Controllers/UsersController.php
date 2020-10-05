<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      if (!$request->hasFile('avatar')) {
        $validated = $request->validate([
          	  'first_name' => ['required', 'string', 'max:255'],
              'last_name' => ['required', 'string', 'max:255'],
              'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ]);
        $user->update($validated);
      }
        if ($request->hasFile('avatar')) {
          $request->validate([
             'avatar' =>['required','image','mimes:jpeg,jpg,png','max:2048'],
          ]);
          Storage::delete($user->avatar);
           $avatarPath = $request->file('avatar')->store('public/UserAvatars');
           $user->update(['avatar' => $avatarPath]);
        }
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       $user->favourite_rentals()->detach();
       $user->favourite_hostels()->detach();
       $user->favourite_communities()->detach();
       $user->favourite_standalones()->detach();
       $user->favourite_workspaces()->detach();
       $user->diaryEntries()->detach();
        Storage::delete($user->avatar);
        $user->delete();
    }
}
