<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Models\Offer;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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

        $offers = Offer::with('photo')->inRandomOrder()->take($amount)->get();

        return view('index', ['offers' => $offers]);
    }

    public function showMoreOffers(Request $request)
    {
        $AllCount = $request->session()->get('AllCount');
        if (!$request->session()->has('amount')) {
            $request->session()->put('amount', 4);
        }
        $count = $request->session()->get('amount');

        if ($count >= $AllCount) {
            return redirect()->route('mainPage')->with('status', 'Brak większej ilości ofert');
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

        return view('index', compact('offers'));
    }

    public function store(CreateOfferRequest $request)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }
        try {
            $input = $request->validated();
            Offer::create($input);

            return redirect()->route('offerIndex')->with('success', 'Oferta została pomyślnie utworzona.');
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
        $offer = Offer::find($id);
        return view('AdminPages.offerEditA', ['offer' => $offer]);
    }

    public function showWithPhotos($id)
    {
        $offer = Offer::with('photo')->findOrFail($id);

        return view('UserElements.offerShow', ['offer' => $offer, 'photos' => $offer->photo]);
    }

    public function update(UpdateOfferRequest $request, $id)
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }
        try {
            $offer = Offer::find($id);
            $input = $request->all();
            $offer->update($input);

            return redirect()->route('offerIndex')->with('success', 'Oferta została pomyślnie utworzona.');
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
}
