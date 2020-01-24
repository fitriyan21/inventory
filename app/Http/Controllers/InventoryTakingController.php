<?php

namespace App\Http\Controllers;

use App\Models\InventoryTaking;
use App\Models\InventoryTakingDetail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Response\ApiBaseResponse;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InventoryTakingController extends Controller
{
    private $response;
    private $model;

    public function __construct()
    {
        $this->model = new InventoryTaking();
        $this->response = new ApiBaseResponse();
    }

    public function index()
    {
        $data = $this->model
            ->with(['inventoryTakingDetail'])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return response()->json($this->response->singleData($data, []), 200);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $validationRules = [
                'transaction_code' => 'required',
                'date' => 'required',
                'products' => 'required|array',
                'products.*.product_id' => 'required',
                'products.*.final_qty' => 'required|numeric',
                'products.*.note' => 'required',
            ];
            $validator = Validator::make($input, $validationRules);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $data = $this->model;

            $data->transaction_code = $request->transaction_code;
            $data->date = $request->date;
            $data->user_id = Auth::user()->id;
            $data->save();

            foreach ($request->products as $product) {
                $detail = new InventoryTakingDetail();
                $initialQty = Product::where('id', '=', $product['product_id'])->first()->stock;
                $detail->inventory_taking_id = $data->id;
                $detail->product_id = $product['product_id'];
                $detail->initial_qty = $initialQty;
                $detail->final_qty = $product['final_qty'];
                $detail->difference = $initialQty - $product['final_qty'];
                $detail->note = $product['note'];
                $detail->save();
            }

            DB::commit();
            return response()->json($this->response->singleData($data, []), 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($this->response->status("ERROR", $e->getMessage(), null), 500);
        }
    }

    public function show($id)
    {
        $data = $this->model->with(['inventoryTakingDetail'])->findOrFail($id);
        return response()->json($this->response->singleData($data, []), 200);
    }

    public function delete($id)
    {
        $data = $this->model->findOrFail($id);
        $data->delete();
        return response()->json($this->response->status(200, "Success Deleted", null), 200);
    }
}
