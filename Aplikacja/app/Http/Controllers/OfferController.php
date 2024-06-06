<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOfferByUserRequest;
use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Models\Offer;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

//charts.js

class OfferController extends Controller
{
    public function index()
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }
        $offers = Offer::all();
        return view('AdminPages.offerA', ['offers' => $offers]);
    }

    public function MainPageindex(Request $request)
    {
        $AllCount = Offer::count();
        session()->put('AllCount', $AllCount);

        $amount = $request->session()->get('amount', 4);

        $offers = Offer::with(['photo', 'user'])->inRandomOrder()->take($amount)->get();

        return view('index', ['offers' => $offers, 'AllCount' => $AllCount]);
    }

    public function showMoreOffers(Request $request)
    {
        $AllCount = $request->session()->get('AllCount');
        if (!$request->session()->has('amount')) {
            $request->session()->put('amount', 4);
        }
        $count = $request->session()->get('amount');

        if ($count >= $AllCount) {
            return redirect()->route('mainPage')->with('status', 'Brak większej ilości ofert.');
        } else {
            $request->session()->increment('amount', 4);

            $offers = Offer::with('photo')->inRandomOrder()->take($count + 4)->get();

            return redirect()->route('mainPage', ['offers' => $offers]);
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $offers = Offer::where('name', 'like', "%$query%")
            ->orWhere('tags', 'like', "%$query%")
            ->get();

        $AllCount = Offer::count();

        return view('index', ['offers' => $offers, 'AllCount' => $AllCount]);
    }


    public function store(CreateOfferRequest $request)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        try {
            $validatedData = $request->validated();
            Offer::create($validatedData);

            return redirect()->route('offerIndex');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }


    public function storeByUser(CreateOfferByUserRequest $request)
    {
        if (Gate::denies('is-logged-in')) {
            abort(401);
        }

        try {
            $user = Auth::user();
            $input = $request->validated();
            $input['user_id'] = $user->id;
            $input['status'] = 'aktualna';
            $input['publication_date'] = Carbon::now();

            $offer = Offer::create($input);

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $filename = $this->generateRandomString() . '.' . $photo->getClientOriginalExtension();
                    $photo->storeAs('public/photos', $filename);

                    Photo::create([
                        'file' => $filename,
                        'description' => '',
                        'offer_id' => $offer->id,
                    ]);
                }
            }

            return redirect()->route('profile', $user);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }

    private function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }



    public function show($id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }
        $offer = Offer::findOrFail($id);
        return view('AdminPages.offerEditA', ['offer' => $offer]);
    }

    public function showWithPhotos($id)
    {
        $offer = Offer::with(['photo', 'user'])->findOrFail($id);
        return view('UserElements.offerShow', ['offer' => $offer, 'photos' => $offer->photo]);
    }

    public function editWithPhotos($id)
    {
        if (Gate::denies('is-logged-in')) {
            abort(401);
        }

        $offer = Offer::with('photo')->findOrFail($id);
        $user = Auth::user();
        if ($user->id != $offer->user_id) {
            abort(403);
        }
        return view('UserElements.offerEdit', ['offer' => $offer, 'photos' => $offer->photo]);
    }

    public function showAddOffer()
    {
        if (Gate::denies('is-logged-in')) {
            abort(401);
        }
        return view('UserElements.offerAdd');
    }

    public function update(UpdateOfferRequest $request, $id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }

        try {
            $offer = Offer::findOrFail($id);
            $input = $request->all();
            $offer->update($input);

            return redirect()->route('offerIndex');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }

    public function updateByUser(UpdateOfferRequest $request, $id)
    {
        try {
            $offer = Offer::findOrFail($id);
            $input = $request->all();
            $offer->update($input);

            return redirect()->route('profile', Auth::user()->id);
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
        $offer = Offer::findOrFail($id);

        $offer->photo()->delete();

        $offer->delete();

        return $this->index();
    }

    public function destroyByUser($id)
    {
        if (Gate::denies('is-logged-in')) {
            abort(401);
        }
        $offer = Offer::findOrFail($id);

        $offer->photo()->delete();

        $offer->delete();

        return redirect()->back();
    }
}
