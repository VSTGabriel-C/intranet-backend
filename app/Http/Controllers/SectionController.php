<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function create(Request $request)
    {

        $section = (new Section)->create_model($request);

        return $section;
    }

    public function update(Request $request, $id)
    {
        $equipment = (new Section)->update_model($request, $id);

        return $equipment;
    }

    public function show_section()
    {
        $section = (new Section)->show_model();

        return $section;
    }

    public function delete_section($id)
    {
        $section = (new Section)->delete_model($id);

        return $section;
    }
}
