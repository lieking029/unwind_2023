<?php

namespace App\Http\Controllers\Web;

use App\Models\TemporaryFiles;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;


class UploadController extends Controller
{

    public function __invoke(Request $request): JsonResponse
    {
        if ($request->has('featured_media')) {
            $file = $request->file('featured_media');
            $fileName = $file->getClientOriginalName();
            $folder =  uniqid() . '-' . now()->timestamp;
            $file->storeAs('temporary/' . $folder, $fileName);

            TemporaryFiles::create(['folder' => $folder, 'file_name' => $fileName]);

            return response()->json($folder, Response::HTTP_CREATED);
        }

        return response()->json(null, Response::HTTP_BAD_REQUEST);
    }

}
