<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    public function categoryList(){
        $category = Category::get();

        $response = [
            'status' => 200,
            'message' => 'success',
            'data' => $category
        ];
        return Response::json($response);
    }

    public function createCategory(Request $request){
        // dd($request->header('API-KEY')); // HEADER ထဲက တန္ဖိုးကို ဖမ္းတာ
        // dd($request->all()); // BODY ထဲမွာပါလာတဲ့ VALUE ေတြကို ဖမ္းတာ

        $data = [
            'category_name' => $request->categoryName,
            'created_at' => Carbon::now(),
            'update_at' => Carbon::now(),
        ];

        Category::create($data);

        $response = [
            'status' => '200',
            'message' => 'success'
        ];

        return Response::json($response);
    }

    public function categoryDetails($id){
     

        $data = Category::where('category_id',$id)->first();

        // dd($data);
        if(!empty($data)){
            return Response::json([
                'status' => '200',
                'message' => 'success',
                'data' => $data
            ]);
        }

        return Response::json([
            'status' => '200',
            'message' => 'fail',
            'data' => $data
        ]);
    }

    public function deleteCategory($id){

        $data = Category::where('category_id',$id)->first();

        if(empty($data)){
            return Response::json([
                'status' => '200',
                'message' => 'There is no such data in table',
                
            ]);
        }


        Category::where('category_id',$id)->delete();

        return Response::json([
            'status' => '200',
            'message' => 'success',
        ]);


    }

    public function categoryUpdate(Request $request){
        // $id = $request->id;
        $updateData = [
            'category_id' => $request->id,
            'category_name' => $request->category_name,
            'updated_at' => Carbon::now(),
            
        ];


        $check = Category::where('category_id',$request->id)->first();

        if(!empty($check)){
            Category::where('category_id',$request->id)->update($updateData);
            return Response::json([
                'status' => '200',
                'message' => 'success',
            ]);
        }

        return Response::json([
            'status' => '200',
            'message' => 'There is no such data in table',
            
        ]);

    }
}
