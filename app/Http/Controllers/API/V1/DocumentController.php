<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    public function store(Request $request)
    {
        $document = new Document();
        $document->save();

        return json_encode([
            'document' => $document
        ]);
    }
}
