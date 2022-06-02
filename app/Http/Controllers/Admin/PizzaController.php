<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
   //redirect pizza list
    public function pizza(){

        if(Session::has('PIZZASEARCH')){
            Session::forget('PIZZASEARCH');
        }

        $data = Pizza::paginate(5);

        if(count($data) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus = 1;
        }
        // dd($data->toArray());
        return view('admin.pizza.list')->with(['pizza'=>$data,'status'=> $emptyStatus]);
    }

    public function createpizza(){
        $category = Category::get();
        // dd($category->toArray());
        return view('admin.pizza.create')->with(['category'=>$category]);
    }
    
    // insert pizza 
    public function insertPizza(Request $request){
        // dd($request->all());
        

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image'=> 'required',
            'price'=> 'required',
            'publish'=>'required',
            'category'=>'required',
            'discount'=>'required',
            'buyonegetone'=>'required',
            'waitingtime'=>'required',
            'description'=>'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $file = $request->file('image');

        $filename = uniqid().'_'.$file->getClientOriginalName();
        
        $file->move(public_path().'/uploads/',$filename); 
       
      
            $data = $this->requestPizza($request,$filename);
       
            Pizza::create($data);

            return redirect()->route('admin#pizza')->with(['createPizza'=>"Pizza Created Successfully"]);
        
       
    }

    //delete pizza
    public function deletePizza($id){
        // database ထဲက မဖ်က္ခင္ ပံုနာမည္ကို variable နဲ႕ သိမ္းလိုက္မယ္ 
        $data = Pizza::select('image')->where('pizza_id',$id)->first();
        $filename = $data['image'];
        //project delete
        if(File::exists(public_path().'/uploads/'.$filename)){
            File::delete(public_path().'/uploads/'.$filename);
        }
        Pizza::where('pizza_id',$id)->delete(); //database delete
        return back()->with(['deleteSuccess'=>'Delete Success']);
    }

    public function pizzainfo($id){
        $data = Pizza::where('pizza_id',$id)->first();
        return view('admin.pizza.info')->with(['pizza'=>$data]);
    }

    //edit pizza page
    public function editPizza($id){
        $category = Category::get();
        $data = Pizza::select('pizzas.*','categories.category_id','categories.category_name')->join('categories','pizzas.category_id','=','categories.category_id')->where('pizza_id',$id)->first();

                
        return view('admin.pizza.edit')->with(['pizza'=>$data,'category'=>$category]);
    }

    public function updatePizza(Request $request,$id){
        // $this->checkValidation($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price'=> 'required',
            'publish'=>'required',
            'category'=>'required',
            'discount'=>'required',
            'buyonegetone'=>'required',
            'waitingtime'=>'required',
            'description'=>'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $updatedata = $this->requestUpdatePizzaData($request);

        if(isset($updatedata['image'])){
            //get old image from database
            $data = Pizza::select('image')->where('pizza_id',$id)->first();
            $filename = $data['image'];
            
            //delete old image
            if(File::exists(public_path().'/uploads/'.$filename)){
                File::delete(public_path().'/uploads/'.$filename);
            }

            

            $file = $request->file('image');

            $filename = uniqid().'_'.$file->getClientOriginalName();
            // dd($filename);
            $file->move(public_path().'/uploads/',$filename); 

            $updatedata['image'] = $filename;

            


        }

        //update database data
        Pizza::where('pizza_id',$id)->update($updatedata);
            
        return redirect()->route('admin#pizza')->with(['updatesuccess'=>'Pizza data updated']);
            
    }

    //search pizza
    public function searchPizza(Request $request){
        $searchKey = $request->table_search;
        
        $searchData = Pizza::orWhere('pizza_name','like','%'.$searchKey.'%')->orWhere('price','like','%'.$searchKey.'%')->paginate(5);
        
        $searchData->appends($request->all());

        Session::put('PIZZASEARCH',$searchKey);

        if(count($searchData) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus = 1;
        }

        return view('admin.pizza.list')->with(['pizza'=>$searchData,'status'=>$emptyStatus]);


    }

    public function categoryItem($id){
        $data = Pizza::where('category_id',$id)->paginate(5);
        // dd($data->toArray());
                // ->join('categories','categories.category_id','pizzas.category_id')
                // ->where('category_id',$id)
                // ->paginate(5);

        return view('admin.category.item')->with(['pizza'=>$data]);
    }

    public function pizzaDownload(){
        if(Session::has('PIZZASEARCH')){
            
            $pizza = Pizza::orWhere('pizza_name','like','%'.Session::get('PIZZASEARCH').'%')
                            ->orWhere('price','like','%'.Session::get('PIZZASEARCH').'%')
                            ->get();

        }else{
            $pizza = Pizza::get();
        }

       

        
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($pizza, [
            'pizza_id' => 'No', 
            'pizza_name' => 'Pizza Name',
            'price' => 'Pizza Price',
            'publish_status' => 'Publish Date',
            'buy_one_get_one_status' => 'Buy One Get One',
            'created_at' => "Created_at",
            'updated_at' => "Updated_at"
        ])->download();
    }
    

    private function requestUpdatePizzaData($request){
        $arr = [
            'pizza_name' => $request->name, 
            'price'=> $request->price,
            'publish_status'=>$request->publish,
            'category_id'=>$request->category,
            'discount_price'=>$request->discount,
            'buy_one_get_one_status'=>$request->buyonegetone,
            'waiting_time'=>$request->waitingtime,
            'description'=>$request->description,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ];

        // dd($arr);
        if(isset($request->image)){
            $arr['image'] = $request->image;
            // dd($request->image);
        }

        return $arr;
    }

    // request pizza data 
    private function requestPizza($request,$filename){
        return [
            'pizza_name' => $request->name,
            'image'=> $filename,
            'price'=> $request->price,
            'publish_status'=>$request->publish,
            'category_id'=>$request->category,
            'discount_price'=>$request->discount,
            'buy_one_get_one_status'=>$request->buyonegetone,
            'waiting_time'=>$request->waitingtime,
            'description'=>$request->description,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ];
    }       

    
}
