<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaStoreRequest;
use App\Http\Requests\Admin\MediaUpdateRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Plank\Mediable\Exceptions\MediaUploadException;
use Plank\Mediable\Facades\MediaUploader;
use Plank\Mediable\HandlesMediaUploadExceptions;

class MediaController extends Controller
{
    use HandlesMediaUploadExceptions;

    public function images(): JsonResource
    {
        return MediaResource::collection(
            Media::query()
                ->whereImages()
                ->whereIsOriginal()
                ->orderByDesc('created_at')
                ->paginate()
        );
    }

    public function files(): JsonResource
    {
        return MediaResource::collection(
            Media::query()
                ->whereNotImages()
                ->whereIsOriginal()
                ->orderByDesc('created_at')
                ->paginate()
        );
    }

    public function store(MediaStoreRequest $request): JsonResource
    {
        try {
            $media = MediaUploader::fromSource($request->file('file'))
                ->upload();

            return MediaResource::make($media);
        } catch (MediaUploadException $e) {
            throw $this->transformMediaUploadException($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Media         $media
     * @return \Illuminate\Http\Response
     */
    public function update(MediaUpdateRequest $request, Media $media): JsonResource
    {
        $media->update($request->validated());

        return MediaResource::make($media);
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
