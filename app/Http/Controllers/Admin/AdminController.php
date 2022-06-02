<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //redirect admin profile
    public function profile(){
        $id = auth()->user()->id;
        $userData = User::where('id',$id)->first();
        return view('admin.profile.index')->with(['user'=>$userData]);
    }

    public function updateProfile(Request $request,$id){


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        
        $updateData = $this->requestUserData($request);

        User::where('id',$id)->update($updateData);

        return back()->with(['updatesuccess'=>'User information updated']);
    }

    public function changepassword($id,Request $request){
 
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required'
            
            
        ]);
 
        if ($validator->fails()) {
            return back()
                       ->withErrors($validator)
                       ->withInput();
        }

        $data = User::where('id',$id)->first();

        $oldpassword = $request->oldpassword;
        $newpassword = $request->newpassword;
        $confirmpassword = $request->confirmpassword;
        
       
        $hashValue = $data['password'];

        if(Hash::check($oldpassword,$hashValue)){  //db same password
            if($newpassword != $confirmpassword ){
                return back()->with(['notsameerror'=>"Password Confirmatoin do not match not same"]);
            }else{ 
                if(strlen($newpassword) <= 6 || strlen($confirmpassword) <= 6){
                    return back()->with(['lengtherror'=>'Password must be longer than 6 character']);
                }else{
                    $hash = Hash::make($newpassword);

                    User::where('id',$id)->update([
                        'password'=> $hash
                    ]);
    
                    return back()->with(['success'=>"Password Changed"]);
                }
                
            }
            
        }else{
            return back()->with(['notmatcherror'=>'Password do not math try again']);
        }

    }

    public function changepasswordpage(){
        return view('admin.profile.changepassword');
    }

    private function requestUserData($request){
        return [
            'name'=>$request->name,
            'email'=> $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }




}
