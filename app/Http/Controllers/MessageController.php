<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use App\Services\UploadsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessageController extends Controller
{
    private $uploadsService;

    public function __construct(UploadsService $uploadsService)
    {
        $this->uploadsService = $uploadsService;
    }

    public function store(StoreMessageRequest $request): JsonResponse
    {
        $fileName = md5($request->attachment->getFileName()) . ".jpg";
        $this->uploadsService->storeImage($request->attachment, $fileName);

        Message::query()
            ->updateOrCreate(
                [ 'id' => $request->id ],
                array_merge(request()->all(), ['attachment' => "$fileName"])
            );

        return response()->json([], Response::HTTP_CREATED);
    }
}
