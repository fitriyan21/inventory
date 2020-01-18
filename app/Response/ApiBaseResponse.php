<?php


namespace App\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiBaseResponse
{
    protected $LIMIT = 10;
    public function listPaginate($paged)
    {
        $return = [];

        $return['meta']['error'] = 0;
        $return['meta']['status'] = 200;
        $return['meta']['message'] = trans('message.api.success');
        $return['meta']['total'] = $paged->total();
        $return['meta']['per_page'] = $paged->perPage();
        $return['meta']['current_page'] = $paged->currentPage();
        $return['meta']['last_page'] = $paged->lastPage();
        $return['meta']['has_more_pages'] = $paged->hasMorePages();
        $return['meta']['from'] = $paged->firstItem();
        $return['meta']['to'] = $paged->lastItem();
        $return['links']['self'] = url()->full();
        $return['links']['next'] = $paged->nextPageUrl();
        $return['links']['prev'] = $paged->previousPageUrl();
        $return['data'] = $paged->items();
        return $return;
    }

    public function singleData($data, array $relations)
    {
        $return = [];
        $return['meta']['error'] = 0;
        $return['meta']['status'] = 200;
        $return['meta']['message'] = trans('message.api.success');
        $return['data'] = $data;
        $return = $this->generateRelations($return, $relations);
        return $return;
    }

    public function error(\Exception $e)
    {
        $return = [];
        $return['meta']['code'] = JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        $return['meta']['message'] = trans('message.api.error');
        $return['meta']['error'] = $e->getMessage();
        $return['data'] = (object) [];
        return $return;
    }

    private function generateRelations($return, $relations)
    {
        if (isset($relations)) {
            foreach ($relations as $key => $relation) {
                $return['data'][$key] = $relation;
            }
        }
        return $return;
    }

    public function successResponse($id)
    {
        $return = [];
        $return['meta']['error'] = 0;
        $return['meta']['status'] = 200;
        $return['meta']['message'] = trans('message.api.success');
        $return['data']['id'] = $id;
        return $return;
    }

    public function errorResponse(\Exception $e)
    {
        $return = [];
        $return['meta']['status'] = 500;
        $return['meta']['message'] = trans('message.api.error');
        $return['meta']['error'] = $e->getMessage();
        return $return;
    }

    public function notFoundResponse()
    {
        $return = [];
        $return['meta']['status'] = 404;
        $return['meta']['message'] = trans('message.api.notFound');
        return $return;
    }

    public function validationFailResponse($errors)
    {
        $return = [];
        $return['meta']['status'] = 400;
        $return['meta']['message'] = trans('message.api.badRequest');
        $return['data'] = $errors;
        return $return;
    }

    public function unauthorizedResponse()
    {
        $return = [];
        $return['meta']['status'] = 401;
        $return['meta']['message'] = trans('message.api.unauthorized');
        return $return;
    }

    public function whereDoYouGo()
    {
        $return = [];
        $return['meta']['status'] = 401;
        $return['meta']['message'] = trans('message.api.whereDoYouGo');
        return $return;
    }

    public function badRequest($errors)
    {
        $return = [];
        $return['meta']['status'] = 400;
        $return['meta']['message'] = trans('message.api.badRequest');
        $return['data'] = $errors;
        return $return;
    }

    public function invalidToken($errors)
    {
        $return = [];
        $return['meta']['status'] = 401;
        $return['meta']['message'] = trans('message.api.invalidToken');
        $return['data'] = $errors;
        return $return;
    }

    public function unProcessableEntity($errors)
    {
        $return = [];
        $return['meta']['status'] = 422;
        $return['meta']['message'] = trans('message.api.unProcessableEntity');
        $return['data'] = $errors;
        return $return;
    }

    public function status($status, $message, $data)
    {
        $return = [];
        $return['meta']['status'] = $status;
        $return['meta']['message'] = $message;
        $return['data'] = $data;
        return $return;
    }

    public function statusWithoutData($status, $message)
    {
        $return = [];
        $return['meta']['status'] = $status;
        $return['meta']['message'] = $message;
        return $return;
    }

    public function success()
    {
        $return = [];
        $return['meta']['code'] = JsonResponse::HTTP_OK;
        $return['meta']['message'] = trans('message.api.success');
        $return['data'] = (object) [];
        return $return;
    }


    public function validationFail($errors)
    {
        $return = [];
        $return['meta']['code'] = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;
        $return['meta']['message'] = trans('message.api.error');
        $return['meta']['errors'] = $errors;
        $return['data'] = (object) [];
        return $return;
    }
}
