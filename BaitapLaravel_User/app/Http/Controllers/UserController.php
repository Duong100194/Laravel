<?php
namespace App\Http\Controllers;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        //$users= DB::table('users')->orderBy('id', 'desc')->paginate(15);
        $users = User::orderBy('id', 'desc')->paginate(15);
        return view('user-list-view', compact('users'));
    }

    public function create()
    {
        return view('user-insert-view');

    }

    public function store(UserRequest $request)
    {
        $user = new User;
        DB::transaction(function () use ($user, $request)
        {
            $user->user = $request->user;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->save();

        });
        return response()->json(['success' => 'User Created']);
    }

    public function edit($id)
    {
        return view('user-edit-view', ['user' => User::findOrFail($id)]);
    }

    public function update(UserRequest $request)
    {

            $user = User::find($request->id);
            DB::transaction(function () use ($user, $request)
            {

            $user->id = $request->id;
            $user->user = $request->user;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->update();

            });
        return response()->json(['success' => 'User Updated']);
    }
    public function search(Request $request)
    {
        if ($request->keyword != '') {
            // $data = User::FullTextSearch('user', $request->keyword)->get();
            //$data = User::search($request->keyword)->get();
            $data = User::select("username", "email", "user", "address")
                ->where("username", "LIKE", "%{$request->keyword}%")
                ->orWhere("address", "LIKE", "%{$request->keyword}%")
                ->orWhere("user", "LIKE", "%{$request->keyword}%")
                ->orWhere("email", "LIKE", "%{$request->keyword}%")
                ->get();
            return $data;
        }

    }
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        #return redirect()->route('show_list');
        return response()->json(['success' => 'Deleted']);
    }

}


