<?php

namespace App\Http\Controllers;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\File;

class AreaPhotoController extends Controller
{
    use ResponseAPI;
    /**
     * @OA\Delete(
     *  path="/api/v1/area-photos/{id}",
     *  summary="Delete a area",
     *  description="Delete a area by id",
     *  operationId="Delete",
     *  tags={"AreaPhotos"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of areaPhoto to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Delete areaPhoto success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Delete areaPhoto success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="1"),
     *          @OA\Property(property="name", type="email", example="example"),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *         ),
     *        )
     *  ),
     * )
     */

    public function destroy($id)
    {
        try {
            $areaPhoto = \App\Models\AreaPhoto::findOrFail($id);
            $image_path = $areaPhoto->url;
            $areaPhoto->delete();
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            return $this->success('Delete areaPhoto success', \App\Http\Resources\AreaPhotoResource::make($areaPhoto), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
