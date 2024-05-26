<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Używamy do hashowania haseł
use Illuminate\Support\Facades\Validator; // Używamy do walidacji
use Illuminate\Support\Facades\DB;
use App\Models\Photo;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('AdminPages.userA', ['users' => $users]);
    }

    public function indexUser($id)
    {
        $user = User::with('offers')->findOrFail($id);

        return view('UserElements.user', ['user' => $user, 'offers' => $user->offers]);
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $input = $request->validated();
            User::create($input);

            return redirect()->route('userIndex')->with('success', 'Oferta została pomyślnie utworzona.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'surname' => 'required|string|max:25',
            'email' => 'required|email|max:40|unique:users,email',
            'phone_number' => 'required|string|max:20',
            'login' => 'required|string|max:30|unique:users,login',
            'password' => 'required|string|max:100',
            'commitPassword' => 'required|string|max:100|same:password'
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['commitPassword' => 'Hasła nie są takie same!'])->withInput();
        }

        User::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'login' => $request->input('login'),
            'password' => Hash::make($request->input('password')),
            'permission' => 2
        ]);

        return redirect()->route('mainPage');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('AdminPages.userEditA', ['user' => $user]);
    }

    public function showSettings($id)
    {
        $user = User::with('offers')->findOrFail($id);

        return view('UserElements.userEdit', ['user' => $user, 'offers' => $user->offers]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = User::find($id);
            $input = $request->all();
            $user->update($input);

            return redirect()->route('userIndex')->with('success', 'Oferta została pomyślnie utworzona.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }

    public function updateInSettings(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'login' => $request->input('login'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('profile', ['id' => $id]);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $user = User::with('offers.photo')->findOrFail($id);
            foreach ($user->offers as $offer) {
                $offer->photo()->delete();

                $offer->delete();
            }

            $user->delete();
        });
        return $this->index();
    }

}
