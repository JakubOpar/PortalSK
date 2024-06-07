<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPhotoRequest;
use App\Models\Offer;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PhotoController extends Controller
{
    public function store(AddPhotoRequest $request, $id)
    {
        if (Gate::denies('is-logged-in')) {
            abort(401);
        }

        $offer = Offer::findOrFail($id);

        $currentUser = Auth::user();

        if ($currentUser->id != $offer->user_id) {
            abort(403);
        }

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

        return redirect()->route('offerEditWithPhotos', $id);
    }

    private function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }


    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        $offer = Offer::findOrFail($photo->offer_id);

        $currentUser = Auth::user();

        if ($currentUser->id != $offer->user_id) {
            abort(403);
        }

        $photo = Photo::find($id);
        $photo->delete();
        return redirect()->back();
    }
}
