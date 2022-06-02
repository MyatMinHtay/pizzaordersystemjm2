<?php

namespace App\Http\Controllers\Admin;


use Laracsv\Export;
use App\Models\Pizza;
// use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class CategoryController  extends Controller
{
    

   

    //redirect add category
    public function addCategory(){
        
        return view('admin.category.addCategory');
    }

    public function createCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'category_name' => $request->name
        ];

        Category::create($data);
        return redirect()->route('admin#category')->with(['categorySuccess'=>"Category Added Successfully!"]);
    }

    // SELECT * FROM pizzas
    // LEFT JOIN categories
    // ON pizzas.category_id = categories.category_id
    // GROUP BY categories.category_id;
    //redirect category list
    public function category(){

        if(Session::has('CATEGORYSEARCH')){
            Session::forget('CATEGORYSEARCH');
        }
       $data = Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
                        ->leftJoin('pizzas','categories.category_id','pizzas.category_id')
                        ->groupBy('categories.category_id','pizza.categories.category_name','pizza.categories.created_at','pizza.categories.updated_at')
                        ->paginate(7);
    //    $datatwo = $data->groupby('categories.category_id');
        // dd($data->toArray());
    //    dd($datatwo->toArray());
        // $count = count($data); count of data in array 
        return view('admin.category.list')->with(['category'=>$data]);
    }

    
    //delete category
    public function deleteCategory($id){
        Category::where('category_id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category Delete Successful']);
    }

    //edit category
    public function editCategory($id){
        $data = Category::where('category_id',$id)->first();
       
        return view('admin.category.update')->with(['category'=>$data]);
    }

    //update category
    public function updateCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $b = Category::where('category_id',$request->id)->first();

        // dd($b->toArray());
        if($b->category_name == $request->name){
            return back()->with(['notupdateCategory'=>'you must do value changes']);
        }else{
            $updatedata = [
                'category_name' => $request->name
            ];
    
            Category::where('category_id',$request->id)->update($updatedata);
            return redirect()->route('admin#category')->with(['updatesuccess'=>"Categor Update Success"]);
        }
        
    }

    public function searchCategory(Request $request){
        
       
    //   $data = Category::where('category_name','like','%'.$request->searchData.'%')->paginate(5);

      $data = Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
      ->leftJoin('pizzas','categories.category_id','pizzas.category_id')
      ->where('categories.category_name','like','%'.$request->searchData.'%')
      ->groupBy('categories.category_id','pizza.categories.category_name','pizza.categories.created_at','pizza.categories.updated_at')
      ->paginate(5);

      Session::put('CATEGORYSEARCH',$request->searchData);

      $data->appends($request->all());
        // dd($data->toArray()); 

        return view('admin.category.list')->with(['category'=>$data]);
        //ဒီလိုသံဳးလည္းရတယ္။ DB ကို import လုပ္ရမယ္အေပၚကဟာနဲ႕ 
        // တူတူပဲႀကိဳက္တာသံုးလို႔ရတယ္ 
        // DB::table('categories')::where();
    }

    public function categoryDownload(){

        if(Session::has('CATEGORYSEARCH')){
            $category = Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
            ->leftJoin('pizzas','categories.category_id','pizzas.category_id')
            ->where('categories.category_name','like','%'.Session::get('CATEGORYSEARCH').'%')
            ->groupBy('categories.category_id','pizza.categories.category_name','pizza.categories.created_at','pizza.categories.updated_at')
            ->get();


        }else{
            $category = Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
            ->leftJoin('pizzas','categories.category_id','pizzas.category_id')
            ->groupBy('categories.category_id','pizza.categories.category_name','pizza.categories.created_at','pizza.categories.updated_at')
            ->get();
        }

       

        
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($category, [
            'category_id' => 'ID', 
            'category_name' => 'Name',
            'count' => 'Product Count',
            'created_at' => "Created_at",
            'updated_at' => "Updated_at"
        ])->download();
    
     
    }
}
