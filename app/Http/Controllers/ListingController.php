<?php

namespace App\Http\Controllers;

use App\Models\listings;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use TijsVerkoyen\CssToInlineStyles\Css\Rule\Rule as RuleRule;

class ListingController extends Controller
{
    //
    public function index() {
        return view('listings',[
            'listings'=>listings::latest()->filter(request(['tag','search']))->get()
        ]);
    }

    public function create(){
        return view("create");
    }

    public function store(Request $request){
        $formFields=$request->validate([
            'title'=>'required',
            'company'=>['required',Rule::unique('listings',"company")],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tag'=>'required',
            'description'=>'required'
        ]);

        listings::create($formFields);
        return redirect("/")->with('message','Listing created succesfully');
    }

    
}
