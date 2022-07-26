<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function index()
    {
        $donation = DB::table('donations')->orderBy('created_at')->paginate(10);
        $user = User::all();

        return view('donations.index', ["donations"=>$donation], compact('user'));
    }
}
