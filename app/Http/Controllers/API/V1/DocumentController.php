<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    /**
     * создаем документ
     *
     * @param Request $request
     * @return json
     */
    public function store(Request $request)
    {
        $document = new Document();
        $document->save();

        $response = [
            'document' => $document
        ];

        return response()->json($response, 200);
    }

    /**
     * получаем документ по id
     *
     * @param Document $document
     * @return json
     */
    public function show(Document $document)
    {
        $result = [
            'document' => $document
        ];

        return response()->json($result, 200);
    }


    public function update(Document $document, Request $request)
    {

        $newData = $request->input('document');
        $oldDate = $document->payload;

        $resultDate = array_merge(json_decode($oldDate, TRUE), $newData);

        $document->payload = $resultDate;
        $document->save();

        $result = [
            'document' => $document
        ];

        return response()->json($result, 200);
    }

}
