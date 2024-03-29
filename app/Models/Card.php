<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HttpResponses;

class Card extends Model
{
    use HasFactory, HttpResponses;

    protected $fillable = [
        'name', 'position', 'email', 'cellphone', 'card_id', 'photo','fk_parent', 'fk_section'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function create_model($request)
    {

        $photo = null;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->getClientOriginalName();
            $request->file('image')->storeAs('public/images/', $photo);
        }

        $card = Card::create([
            'name' => $request->name,
            'position' => $request->position,
            'email' => $request->email,
            'cellphone' => $request->cellphone,
            'card_id' => $request->card_id,
            'fk_section' => $request->fk_section,
            'fk_parent' => $request->fk_parent,
            'photo' => $photo,
        ]);

        return $this->succes([
            'card' => $card
        ], 'card created successfully');
    }

    public function show_model()
    {
        $response = Card::all();

        return $this->succes([
            'cards' => $response
        ], 'List cards successfully');
    }

    public function update_model($request, $id)
    {
        $card = Card::where('id', $id)->first();

        if (!$card) {
            return $this->error('', 'Id do not match', 401);
        }

        $card->update($request->all());

        return $this->succes([
            'card' => $card
        ], 'card updated successfully');
    }

    public function delete_model($id)
    {
        $card = Card::where('id', $id)->first();

        if (!$card) {
            return $this->error('', 'Id do not match', 401);
        }

        $card->delete();

        return $this->succes('', 'card deleted successfully');
    }

}
