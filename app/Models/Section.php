<?php

namespace App\Models;

use App\Traits\HttpResponses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory, HttpResponses;

    protected $fillable = [
        'name', 'order'
    ];

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function create_model($request)
    {
        $request->validated($request->all());

        $section = Section::create([
            'name' => $request->name,
            'order' => $request->order,
        ]);

        return $this->succes([
            'section' => $section,
        ], 'Section created successfully');
    }

    public function show_model()
    {
        $response = Section::all()->take(10);

        return $this->succes([
            'section' => $response
        ], 'List sections successfully');
    }

    public function update_model($request, $id)
    {
        $card = Section::where('id', $id)->first();

        if (!$card) {
            return $this->error('', 'Id do not match', 401);
        }

        $card->update($request->all());

        return $this->succes([
            'section' => $card
        ], 'section updated successfully');
    }

    public function delete_model($id)
    {
        $user = Section::where('id', $id)->first();
        if (!$user) {
            return $this->error('', 'Id not found', 401);
        }

        $user->delete();

        return $this->succes('', 'Section deleted successfully');
    }
}
