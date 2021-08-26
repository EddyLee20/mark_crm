<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

trait AdminResponse
{
    /**
     * 201
     *
     * @author
     * @param string $content
     * @return Response
     */
    protected function created($content = '')
    {
        return new Response($content, Response::HTTP_CREATED);
    }

    /**
     * 202
     *
     * @author
     * @return Response
     */
    protected function accepted()
    {
        return new Response('', Response::HTTP_ACCEPTED);
    }

    /**
     * 204
     *
     * @author
     * @return Response
     */
    protected function noContent()
    {
        return new Response('', Response::HTTP_NO_CONTENT);
    }

    /**
     * 400
     *
     * @author
     * @param $message
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    protected function badRequest($message, array $headers = [], $options = 0)
    {
        return response()->json([
            'message' => $message
        ], Response::HTTP_BAD_REQUEST, $headers, $options);
    }

    /**
     * 401
     *
     * @author
     * @param string $message
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    protected function unauthorized($message = '', array $headers = [], $options = 0)
    {
        return response()->json([
            'message' => $message ? $message : 'Token Signature could not be verified.'
        ], Response::HTTP_UNAUTHORIZED, $headers, $options);
    }

    /**
     * 403
     *
     * @author
     * @param string $message
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    protected function forbidden($message = '', array $headers = [], $options = 0)
    {
        return response()->json([
            'message' => $message ? $message : 'Insufficient permissions.'
        ], Response::HTTP_FORBIDDEN, $headers, $options);
    }

    /**
     * 422
     *
     * @author
     * @param array $errors
     * @param array $headers
     * @param string $message
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    protected function unprocesableEtity(array $errors = [], array $headers = [], $message = '', $options = 0)
    {
        return response()->json([
            'message' => $message ? $message : '422 Unprocessable Entity',
            'errors' => $errors
        ], Response::HTTP_UNPROCESSABLE_ENTITY, $headers, $options);
    }

    /**
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($message = '成功', array $data = [])
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function fail($message = '失败', array $data = [])
    {
        return response()->json([
            'status' => 'fail',
            'message' => $message,
            'data' => $data
        ]);
    }
}
