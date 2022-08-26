<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class DonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $donation = DB::table('donations')->orderByDesc('created_at')->paginate(10);
        $user = User::all();
        $number = DB::table('donations')->sum('amount');

        return view('donations.index', ["donations"=>$donation], compact('user', 'number'));
    }

    public function store()
    {
        $data = request()->validate([
            'amount' => 'required',
            'user_id' => 'required',
        ]);

        Donation::create([
            'amount' => $data['amount'],
            'user_id' => $data['user_id'],
        ]);

        return redirect("/donations")->with('success','Thank you for your donation! We will use it to help these
        endangered animals wisely.');
    }

}
