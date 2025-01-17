<?php

namespace App;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RuntimeException;

class Helper
{
    private const PAGE_LIMIT = 20;
    private const PAGE = 1;
    public const REQUEST_SUCCESS_STATUS = 'ok';
    public const REQUEST_ERROR_STATUS = 'error';

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

    public static function successResponse($data = [], string $message = 'Success server`s response', $responseCode = false): JsonResponse
    {
        $responseCode = ($responseCode) ? $responseCode: Response::HTTP_OK;
        return response()->json([
            'status' => self::REQUEST_SUCCESS_STATUS,
            'message' => $message,
            'info' => $data
        ], $responseCode);
    }

    public static function failedResponse(string $errorMessage = 'error', $trace = '', $responseCode = false): JsonResponse
    {
        $responseCode = ($responseCode) ? $responseCode: Response::HTTP_INTERNAL_SERVER_ERROR;
        return response()->json([
            'status' => self::REQUEST_ERROR_STATUS,
            'message' => $errorMessage,
            'trace' => $trace
        ], $responseCode);
    }

    public static function checkElementExistense($model, $elementId)
    {
        if ($elementId) {
            if (!$element = $model::find($elementId)) {
                throw new RuntimeException(Str::camel(class_basename($model))." with id = $elementId not found");
            }
        }

        return (isset($element)) ? $element : false;
    }


    public static function onlyExistedValues(array $arParams): array
    {
        $arResult = [];
        foreach ($arParams as $field => $value) {
            if ($value !== null) $arResult[$field] = $value;
        }

        return $arResult;
    }

}
