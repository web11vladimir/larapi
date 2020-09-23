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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function index(Document $document, Request $request)
    {
        // количество документов для показа
        $perPage = (int) $request->input('perPage') ?? 0;

        $paginator = Document::paginate($perPage);

        $result = [
            'document' => $paginator->items(),
            'pagination' => [
                'page' => $paginator->currentPage(),
                'perPage' => $paginator->perPage(),
                'total' => $paginator->total()
            ]
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

        return response()->json(['document' => $document], 200);
    }

    /**
     * показ отдельного документа
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        return response()->json(['document' => $document], 200);
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
        // запрещаем обновление уже опубликованного документа
        if ($document->status === 'published') {
            return response()->json(['document' => $document], 400);
        }

        // запрещаем обновление если в запросе нет поля payload
        if (empty($request->input('document')['payload'])) {
            return response()->json(['document' => $document], 400); 
        }

        $oldData = json_decode($document->payload, true); // старые данные
        $newData = $request->input('document')['payload']; // новые данные
        $resultData = array_merge($oldData, $newData); // обновленные данные

        // обновляем данные
        $document->payload = $resultData;
        $document->save();

        return response()->json(['document' => $document], 200);
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
        // проверяем на  повторную публикацию
        if ($document->status === 'published') {
            return response()->json(['document' => $document], 200); 
        }

        // меняем статус на опубликован
        $document->status = 'published';
        $document->save();

        return response()->json(['document' => $document], 200);
    }
}
