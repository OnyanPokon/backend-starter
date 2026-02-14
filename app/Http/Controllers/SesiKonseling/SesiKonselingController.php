<?php

namespace App\Http\Controllers\SesiKonseling;

use App\Http\Controllers\Controller;
use App\Http\Requests\SesiKonselingRequest;
use App\Http\Resources\SesiKonselingResources;
use App\Http\Services\SesiKonselingService;
use App\Http\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class SesiKonselingController extends Controller
{
    use ApiResponse;

    protected $sesiKonselingService;

    public function __construct(SesiKonselingService $sesiKonselingService)
    {
        $this->sesiKonselingService = $sesiKonselingService;
    }

    public function index(Request $request)
    {
        try {
            $data = $this->sesiKonselingService->getAll($request);

            return $this->successResponseWithDataIndex(
                $data,
                SesiKonselingResources::collection($data),
                'Data sesi konseling berhasil diambil',
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function store(SesiKonselingRequest $request)
    {
        try {
            $this->sesiKonselingService->store($request);

            return $this->successResponse(
                'Berhasil menambah data sesi konseling',
                Response::HTTP_CREATED
            );
        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                Response::HTTP_BAD_REQUEST
            );
        } catch (ValidationException $e) {
            return $this->errorResponse(
                $e->errors(),
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function show($id)
    {
        try {
            $data = $this->sesiKonselingService->show($id);

            return $this->successResponseWithData(
                SesiKonselingResources::make($data),
                'Data sesi konseling berhasil diambil',
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function update(SesiKonselingRequest $request, $id)
    {
        try {
            $this->sesiKonselingService->update($request, $id);

            return $this->successResponse(
                'Berhasil mengubah data sesi konseling',
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                Response::HTTP_BAD_REQUEST
            );
        } catch (ValidationException $e) {
            return $this->errorResponse(
                $e->errors(),
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function destroy($id)
    {
        try {
            $this->sesiKonselingService->destroy($id);

            return $this->successResponse(
                'Berhasil menghapus data sesi konseling',
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function multiDestroy(Request $request)
    {
        try {
            $this->sesiKonselingService->multiDestroy($request->ids);

            return $this->successResponse(
                'Berhasil menghapus data sesi konseling',
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
