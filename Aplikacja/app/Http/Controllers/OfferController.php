<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Closure;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
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

    public function store(Request $request)
    {

        Offer::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'negotiation' => $request->input('negotiation'),
            'type' => $request->input('type'),
            'publication_date' => $request->input('publication_date'),
            'status' => $request->input('status'),
            'tags' => $request->input('tags'),
            'user_id' => $request->input('user_id')
        ]);

        return $this->index();
    }

    public function show($id)
    {
        $offer = Offer::findOrFail($id);
        return view('AdminPages.offerEditA', compact('offer'));
    }

    public function showWithPhotos($id)
    {
        $offer = Offer::with('photo')->findOrFail($id);

        return view('UserElements.offerShow', ['offer' => $offer, 'photos' => $offer->photo]);
    }

    public function update(Request $request, $id)
    {

        $offer = Offer::findOrFail($id);
        $offer->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'negotiation' => $request->input('negotiation'),
            'type' => $request->input('type'),
            'publication_date' => $request->input('publication_date'),
            'status' => $request->input('status'),
            'tags' => $request->input('tags'),
            'user_id' => $request->input('user_id')
        ]);

        return $this->index();
    }

    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);

        $offer->photo()->delete();

        $offer->delete();

        return $this->index();
    }
}
