<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCardRequest;
use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function create(CreateCardRequest $request)
    {
        $card = (new Card)->create_model($request);

        return $card;
    }

    public function update(Request $request, $id)
    {
        $equipment = (new Card)->update_model($request, $id);

        return $equipment;
    }

    public function show_card($id)
    {
        $card = (new Card)->show_card($id);

        return $card;
    }

    public function delete_card($id)
    {
        $card = (new Card)->delete_model($id);

        return $card;
    }
}
