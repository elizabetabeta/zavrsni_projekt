<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = DB::table('users')->orderBy('name')->paginate(10);
        if(auth()->user()->role !== "Admin"){
            abort('403', 'Niste admin!');
        }

        return view('users.index', ["users"=>$user]);
    }

    public function profile(User $user)
    {
        $donations = Donation::all()->where('user_id', '=', $user->id);

        return view('users.profile', compact('user', 'donations'));
    }

    public function edit(User $user)
    {
        if(auth()->user()->id !== $user->id){
            return abort('403', "Niste vlasnik profila!");
        }
        return view("users.editprofile", compact('user'));
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if (request()->hasFile('profile_image')) {
            $imagePath = request('profile_image')->store('uploads', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
            $image->save();

            $user->profile_image = $imagePath;

        }

        $user->update();

        return redirect("/profile{$user->id}")->with('success', 'Uspješno ste uredili svoje informacije.');

    }

    public function add(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect('/users')->withErrors($validator)->withInput();
        } else {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            return redirect("/users")->with('success','Uspješno ste dodali novog korisnika.');
        }
    }

    public function search(Request $request)
    {
        if (auth()->user()->role != "Admin"){
            abort('403', 'Samo admin ima pristup ovom dijelu sustava.');
        }
        $search = $request->input('search');

        $users = User::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orderBy('name')
            ->paginate(10);

        return view('users.search', compact('users', 'search'));
    }
}
