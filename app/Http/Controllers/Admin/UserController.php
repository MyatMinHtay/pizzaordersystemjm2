<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function userlist(){
        $userData = User::where('role','user')->paginate(7);
        // dd($userData->toArray());
        return view('admin.user.userlist')->with(['user'=>$userData]);
    }

    public function adminlist(){
        $adminData = User::where('role','admin')->paginate(7);
        // dd($userData->toArray());
        return view('admin.user.adminlist')->with(['admin'=>$adminData]);
    }

    public function usersearch(Request $request){

        $response = $this->search('user',$request);
        // $key = $request->searchData;

        // $searchData = User::where('role','user')->where(function($query) use($key) {
        //     $query->orWhere('name','like','%'.$key.'%')->orWhere('email','like','%'.$key.'%')->orWhere('phone','like','%'.$key.'%')->orWhere('address','like','%'.$key.'%');
        // })->paginate(7);
       
        // $searchData->appends($request->all());

        return view('admin.user.userlist')->with(['user'=>$response]);
    }

    public function userdelete($id){
        User::where('id',$id)->delete();

        return back()->with(['deletesuccess'=>'delete success']);
    }

    public function searchadmin(Request $request){
        // $key = $request->searchData;
       $response = $this->search('admin',$request);
        

       
       
        

        return view('admin.user.adminlist')->with(['admin'=>$response]);
    }

    public function deleteadmin($id){
        
    }

    private function search($role,$request){
        

        $searchData = User::where('role', $role)->where(function($query) use($request) {
            $query->orWhere('name','like','%'.$request->searchData.'%')->orWhere('email','like','%'.$request->searchData.'%')->orWhere('phone','like','%'.$request->searchData.'%')->orWhere('address','like','%'.$request->searchData.'%');
        })->paginate(7);

        $searchData->appends($request->all());

        return $searchData;

    }
}
