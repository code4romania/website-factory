<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\JsonResponse;
use Plank\Mediable\Exceptions\MediaUploadException;
use Plank\Mediable\Facades\MediaUploader;
use Plank\Mediable\HandlesMediaUploadExceptions;
use Plank\Mediable\Jobs\CreateImageVariants;

class MediaController extends Controller
{
    use HandlesMediaUploadExceptions;

    public function index(): JsonResponse
    {
        return response()->json(
            MediaResource::collection(
                Media::query()
                    ->whereIsOriginal()
                    ->orderByDesc('created_at')
                    ->get()
            )
        );
    }

    public function store(MediaRequest $request): JsonResponse
    {
        try {
            $media = MediaUploader::fromSource($request->file('file'))
                ->upload();

            CreateImageVariants::dispatchSync($media, ['thumb']);
        } catch (MediaUploadException $e) {
            throw $this->transformMediaUploadException($e);
        }

        return response()->json(
            MediaResource::make($media)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Media         $media
     * @return \Illuminate\Http\Response
     */
    public function update(MediaRequest $request, Media $media): JsonResponse
    {
        return response()->json(); // TODO
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media         $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media): JsonResponse
    {
        $media->getAllVariants()->map->delete();

        $media->delete();

        return response()->json('ok');
    }
}
