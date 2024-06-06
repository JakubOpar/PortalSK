<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserInSettingsRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function index()
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }
        $users = User::all();
        return view('AdminPages.userA', ['users' => $users]);
    }

    public function indexUser($id)
    {

        if (Gate::denies('is-logged-in')) {
            abort(401);
        }

        $currentUser = Auth::user();

        if ($currentUser->id != $id) {
            abort(403);
        }

        $user = User::findOrFail($id);

        $offers = Offer::with('photo')->where('user_id', $user->id)->get();

        return view('UserElements.user', ['user' => $user, 'offers' => $offers]);
    }

    public function store(CreateUserRequest $request)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        $permission = $request->input('permission');

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
           abort(403);
        }
        return view('PageFunctions.register');
    }

    public function register(RegisterRequest $request)
    {
        if (Gate::allows('is-logged-in')) {
            abort(403);
        }
        try {
            $input = $request->validated();
            $input['permission'] = 2;
            User::create($input);

            return redirect()->route('loginPage');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }


    public function show($id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }
        $user = User::findOrFail($id);
        return view('AdminPages.userEditA', ['user' => $user]);
    }

    public function showSettings($id)
    {
        if (Gate::denies('is-logged-in')) {
            abort(401);
        }

        $currentUser = Auth::user();

        if ($currentUser->id != $id) {
           abort(403);
        }

        $user = User::with('offers')->findOrFail($id);

        return view('UserElements.userEdit', ['user' => $user, 'offers' => $user->offers]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        try {
            $user = User::findOrFail($id);
            $input = $request->all();

            if (empty($input['password'])) {
                unset($input['password']);
            } else {
                $input['password'] = Hash::make($input['password']);
            }

            $user->update($input);

            return redirect()->route('userIndex');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }


    public function updateInSettings(UpdateUserInSettingsRequest $request, $id)
    {
        $currentUser = Auth::user();

        if ($currentUser->id != $id) {
            abort(403);
        }

        try {
            $user = User::find($id);
            $input = $request->all();
            $user->update($input);

            return redirect()->route('profile', $id);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
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
