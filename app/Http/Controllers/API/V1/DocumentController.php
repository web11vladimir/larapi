<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * показ списка документов
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Document $document)
    {

        $allDocument = Document::simplePaginate(15);

        $result = [
            'document' => $allDocument
        ];

        return response()->json($result, 200);
    }

    /**
     * создание нового документа
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * показ отдельного документа
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        $result = [
            'document' => $document
        ];

        return response()->json($result, 200);
    }

    /**
     * обновление документа
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $oldData = json_decode($document->payload, true); // старые данные
        $newData = $request->input('document')['payload']; // новые данные
        $resultData = array_merge($oldData, $newData); // обновленные данные

        // обновляем данные
        $document->payload = $resultData;
        $document->save();

        $result = [
            'document' => $document
        ];

        return response()->json($result, 200);
    }

    /**
     * публикация документа
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request, Document $document)
    {
        // меняем статус на опубликован
        $document->status = 'published';
        $document->save();

        $result = [
            'document' => $document
        ];

        return response()->json($result, 200);
    }
}
