<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\IssuedBook;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //admin after login
    public function admin(){
        $member = Member::count();
        $book = Book::count();
        $issued = IssuedBook::where('return_status',0)->count();
        $returned = IssuedBook::where('return_status',1)->count();
        return view('admin.home',compact('member','book','issued','returned'));
    }

    //admin custom logout
    public function logout(){

        Auth::logout();
        $notification = array('message'=>'Logged Out Successfully', 'alert-type' => 'success');
        return redirect()->route('admin.login')->with($notification);
    }
}
