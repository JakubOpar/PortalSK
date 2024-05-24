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

    public function MainPageindex()
    {
        $offers = Offer::all();
        return view('index', ['offers' => $offers]);
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
        $offer->delete();
        return $this->index();
    }

}
