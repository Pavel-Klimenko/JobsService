<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RuntimeException;


//use App\Models\Roles;

use App\Constants;

class Helper
{
    private const PAGE_LIMIT = 20;
    private const PAGE = 1;

    public static function getPaginationParams(Request $request): array
    {
        $page = self::PAGE;
        $pageLimit = self::PAGE_LIMIT;

        if (!empty($request->get('page'))) {
            $page = $request->get('page');
        }
        if (!empty($request->get('limit_page'))) {
            $pageLimit = $request->get('limit_page');
        }

        return ['page' => (int)$page, 'limit_page' => (int)$pageLimit];
    }

    public static function successResponse($data, string $message = 'Success server`s response'): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'message' => $message,
            'info' => $data
        ]);
    }

    public static function failedResponse(string $errorMessage = 'error'): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $errorMessage,
        ]);
    }

    public static function checkElementExisting($model, $elementId):void
    {
        if ($elementId) {
            if (!$model::find($elementId)) {
                throw new RuntimeException(Str::camel(class_basename($model))." with id = $elementId not found");
            }
        }
    }

}
