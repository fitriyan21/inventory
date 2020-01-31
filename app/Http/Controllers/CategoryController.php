<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Response\ApiBaseResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $response;
    private $model;

    public function __construct()
    {
        $this->model = new Category();
        $this->response = new ApiBaseResponse();
    }

    public function index()
    {
        try {
            $data = $this->model->orderBy('created_at', 'DESC')->paginate(10);
            return response()->json($this->response->singleData($data, []), 200);
        } catch (\Exception $e) {
            return $this->response->badRequest($e->getMessage());
        }

    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $input = $request->all();
            $validationRules = [
                'code' => 'required',
                'name' => 'required',
            ];
            $validator = Validator::make($input, $validationRules);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $data = $this->model->create($input);
            DB::commit();
            return response()->json($this->response->singleData($data, []), 200);
        }catch (\Exception $e){
            DB::rollBack();
            return $this->response->badRequest($e->getMessage());
        }
    }

    public function show($id)
    {
        try{
            $data = $this->model->findOrFail($id);
            return response()->json($this->response->singleData($data, []), 200);
        }catch (\Exception $e){
            return $this->response->badRequest($e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        DB::beginTransaction();
        try{
            $input = $request->all();
            $validationRules = [
                'code' => 'required',
                'name' => 'required',
            ];
            $validator = Validator::make($input, $validationRules);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $data = $this->model->findOrFail($id);
            $data->fill($input);
            $data->save();
            DB::commit();
            return response()->json($this->response->singleData($data, []), 200);
        }catch (\Exception $e){
            DB::rollBack();
            return $this->response->badRequest($e->getMessage());
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try{
            $data = $this->model->findOrFail($id);
            $data->delete();
            DB::commit();
            return response()->json($this->response
                ->status(200, "Success Deleted", null), 200);
        }catch (\Exception $e){
            DB::rollBack();
            return $this->response->badRequest($e->getMessage());
        }
    }
}
