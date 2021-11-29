<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        if ($request->ajax()){

            $data = DB::table('members')->get();


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function ($row){
                    $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
                          <a href="'.route('member.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete_member"><i class="fas fa-trash"></i></a>';

                    return $actionbtn;

                })->rawColumns(['action'])
                ->make(true) ;

        }

        return view('admin.members.index');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'member_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        Member::create([
            'member_id' => $request->member_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json('Member Added Successfully!');
    }

    public function edit($id){

        $data = DB::table('members')->where('id','=',$id)->first();
        return view('admin.members.edit',compact('data'));
    }
    public function update(Request $request){
        $data = array(
            'member_id' => $request->member_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        );

        DB::table('members')->where('id', '=',$request->id)->update($data);
        return response()->json('Member Updated Successfully!');
    }
    public function destroy($id)
    {
        DB::table('members')->where('id', '=',$id)->delete();
        return response()->json('Member Deleted!');
    }
}
