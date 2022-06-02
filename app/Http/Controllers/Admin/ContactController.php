<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function createContact(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
            
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = $this->requestData($request);
        Contact::create($data);

        return back()->with(['contactSuccess'=>'Message Send Successfully']);
    }

    public function contactlist(){
        $data = Contact::orderBy('contact_id','desc')->paginate(7);
        if(count($data) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus = 1;
        }

        
        return view('admin.contact.list')->with(['contact'=>$data,'status'=>$emptyStatus]);
    }

    public function contactSearch(Request $request)
    {
        
        $data = Contact::orwhere('name','like','%'.$request->searchData.'%')
                        ->orwhere('email','like','%'.$request->searchData.'%')
                        ->orwhere('message','like','%'.$request->searchData.'%')
                        ->paginate(7);
            
        $data->appends($request->all());

        if(count($data) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus = 1;
        }
        

       

        return view('admin.contact.list')->with(['contact'=>$data,'status'=>$emptyStatus]);
    }

    private function requestData($request){
        return [
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'message' =>$request->message
        ];
    }
}
