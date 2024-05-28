<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function index()
    {
        if (Gate::denies('access-admin')) {
            return response()->view('errors.403', [], 403);
        }
        $users = User::all();
        return view('AdminPages.userA', ['users' => $users]);
    }

    public function indexUser($id)
    {
        $currentUser = Auth::user();

        if ($currentUser->id != $id) {
            return response()->view('errors.403', [], 403);
        }

        $user = User::findOrFail($id);

        $offers = Offer::with('photo')->where('user_id', $user->id)->get();

        return view('UserElements.user', ['user' => $user, 'offers' => $offers]);
    }

    public function store(CreateUserRequest $request)
    {
        if (Gate::denies('access-admin')) {
            return response()->view('errors.403', [], 403);
        }

        $permission = $request->input('permission');

        if (!in_array($permission, ['1', '2'])) {
            return response()->view('errors.400', [], 400);
        }

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

    public function registerPage()
    {
        if (Gate::allows('is-logged-in')) {
            return response()->view('errors.403', [], 403);
        }
        return view('PageFunctions.register');
    }

    public function register(RegisterRequest $request)
    {
        if (Gate::allows('is-logged-in')) {
            return response()->view('errors.403', [], 403);
        }
        try {
            $input = $request->validated();
            $input['permission'] = 2;
            User::create($input);

            return redirect()->route('mainPage');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }


    public function show($id)
    {
        if (Gate::denies('access-admin')) {
            return response()->view('errors.403', [], 403);
        }
        $user = User::findOrFail($id);
        return view('AdminPages.userEditA', ['user' => $user]);
    }

    public function showSettings($id)
    {
        $currentUser = Auth::user();

        if ($currentUser->id != $id) {
            return response()->view('errors.403', [], 403);
        }

        $user = User::with('offers')->findOrFail($id);

        return view('UserElements.userEdit', ['user' => $user, 'offers' => $user->offers]);
    }

    public function update(UpdateUserRequest $request, $id)
    {

        if (Gate::denies('access-admin')) {
            return response()->view('errors.403', [], 403);
        }

        $permission = $request->input('permission');

        if (!in_array($permission, ['1', '2'])) {
            return response()->view('errors.400', [], 400);
        }

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
        $currentUser = Auth::user();

        if ($currentUser->id != $id) {
            return response()->view('errors.403', [], 403);
        }

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
        if (Gate::denies('access-admin')) {
            return response()->view('errors.403', [], 403);
        }
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
