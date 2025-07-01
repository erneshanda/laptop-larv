<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Laptop;
use function PHPUnit\Framework\returnArgument;

class LaptopController extends Controller
{
    public function index()
    {
        $laptops = Laptop::all();
        return response()->json(array('message'=>'Data retrieved succesfully', 'data'=>$laptops), 200);
    }

    public function store(Request $request) 
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:laptops',
                'price' => 'required|min:0',
            ]);

            if ($validator->fails()) {
                throw new HttpException(400, $validator->messages()->first());
            }

            $laptop = new Laptop();
            $laptop->fill($request->all())->save();

            return response()->json(array('message'=>'Saved successfully', 'data'=>$laptop), 200);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    public function show($id) 
    {
        $laptop = Laptop::findOrFail($id);
        return response()->json(array('message'=>'Saved successfully', 'data'=>$laptop), 200);
    }

    public function update(Request $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, 'Invalid ID');
        }

        $laptop = Laptop::find($id);
        if(!$laptop) {
            throw new HttpException(400, 'Laptop not found');
        }

        try {
            $laptop->fill($request->all())->save();
            return response()->json(array('message'=>'Updated successfully', 'data'=>$laptop), 200);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Failed update data - {$exception->getMessage()}");
        }
    } 

    public function destroy($id)
    {
        $laptop = Laptop::findOrFail($id);
        $laptop->delete();

        return response()->json(array('message'=>'Deleted successfully', 'data'=>$laptop), 204);   
    }
}
