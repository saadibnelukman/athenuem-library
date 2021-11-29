<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\IssuedBook;
use App\Models\Member;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        if ($request->ajax()){

            $data = DB::table('books')->get();


            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('description',function($row){
                    return Str::limit($row->description, 200);

                })
                ->addColumn('action',function ($row){
                    $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
                          <a href="'.route('book.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete_member"><i class="fas fa-trash"></i></a>';

                    return $actionbtn;

                })->rawColumns(['action','description'])
                ->make(true) ;

        }

        return view('admin.books.index');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'book_id' => 'required',
            'title' => 'required',
            'author' => 'required',
            'number_of_copies' => 'required',
        ]);

        Book::create([
            'book_id' => $request->book_id,
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'number_of_copies' => $request->number_of_copies,
        ]);

        return response()->json('Book Added Successfully!');
    }

    public function edit($id){

        $data = Book::where('id','=',$id)->first();
        return view('admin.books.edit',compact('data'));
    }
    public function update(Request $request){
        $validated = $request->validate([
            'book_id' => 'required',
            'title' => 'required',
            'author' => 'required',
            'number_of_copies' => 'required',
        ]);

        $data = array(
            'book_id' => $request->book_id,
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'number_of_copies' => $request->number_of_copies,
        );

        DB::table('books')->where('id', '=',$request->id)->update($data);
        return response()->json('Book Updated Successfully!');
    }
    public function destroy($id)
    {
        DB::table('books')->where('id', '=',$id)->delete();
        return response()->json('Book Deleted!');
    }

    public function issueBook(){
        $members = Member::all();
        $books = Book::all();
        return view('admin.issued_books.create',compact('members','books'));
    }

    public function issueBookList(){
        $data = IssuedBook::latest()->get();
        return view('admin.issued_books.index',compact('data'));
    }

    public function storeIssuedBook(Request $request){
        $validated = $request->validate([
            'member_id' => 'required',
            'book_id' => 'required',
            'returning_date' => 'required'
        ]);

        $issuing_date = Carbon::now()->toDateString();

        IssuedBook::create([
           'member_id' => $request->member_id,
           'book_id' => $request->book_id,
           'issuing_date' => $issuing_date,
           'returning_date' => $request->returning_date,
            'return_status' => 0,
            'issued_by' => Auth::user()->id,
        ]);

        $notification = array('message'=>'Book Issued Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function returnBook(){
        $data = IssuedBook::where('return_status',0)->get();
        return view('admin.issued_books.return',compact('data'));
    }

    public function returnBookStore(Request $request){
        $issuedBook = IssuedBook::where('id',$request->issued_book_id)->first();

        $issuedBook->returning_date = Carbon::now()->toDateString();
        $issuedBook->return_status = 1;

        $issuedBook->save();
        $notification = array('message'=>'Book Returned Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }
}
