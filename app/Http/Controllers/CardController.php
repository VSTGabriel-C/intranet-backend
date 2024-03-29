<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCardRequest;
use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function create(Request $request)
    {
        $card = (new Card)->create_model($request);

        return $card;
    }

    public function update(Request $request, $id)
    {
        $equipment = (new Card)->update_model($request, $id);

        return $equipment;
    }

    public function show_card()
    {
        $card = (new Card)->show_model();

        $data = $card->getData();
        $data = $data->data;
        $hierarchicalData = [];

        // Mapear números de seção para nomes correspondentes
        $sectionNames = [
            1 => "social",
            2 => "adm/fin",
            3 => "comercial"
        ];

        foreach ($data->cards as $item) {
            if (!isset($hierarchicalData[$item->fk_section])) {
                $hierarchicalData[$item->fk_section] = [];
            }

            if ($item->fk_parent === null) {
                $hierarchicalData[$item->fk_section][$item->card_id] = [
                    'name' => $item->name,
                    'id' => $item->card_id,
                    'children' => [],
                    'parent_id' => $item->fk_parent
                ];
            } else {
                $parentId = $item->fk_parent;
                $parent = &$hierarchicalData[$item->fk_section][$parentId];
                $parent['children'][] = [
                    'name' => $item->name,
                    'id' => $item->card_id,
                    'children' => [],
                    'parent_id' => $item->fk_parent
                ];
            }
        }

        $response = '';
        foreach ($hierarchicalData as $section => $sectionData) {
            $sectionName = $sectionNames[$section] ?? "Seção Desconhecida";
            $response .= "$sectionName : " . json_encode(['children' => array_values($sectionData)]) . "\n";
        }

        return $response;
    }


    public function delete_card($id)
    {
        $card = (new Card)->delete_model($id);

        return $card;
    }
}
