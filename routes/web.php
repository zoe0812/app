<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\demotables;
use App\Models\fruits;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get("/hello", function(){
    return response("<h1>hello word</h1>",200)
        ->header('content-Type','text/plain');

});

Route::get("/posts/{id}",function($id){
    //dd($id);
    return response("Posts ".$id);
})->where('id',"[0-9]+");

Route::get("/search",function(Request $request){
    dd($request->name,$request->age);


});

Route::get('/', function () {


    return view('listings',[
        'heading'=>'lastes list',
        'listings'=>[
            [
                'id'=>1,
                'title'=>'Listing One',
                'description'=>'this is a good thing'
            ],
            [
                'id'=>2,
                'title'=>'Listing two',
                'description'=>'this is not a good thing'
            ]
        ]
    ]);
});

Route::get('/listing/{id}',function($id){

    $listings=[['id'=>1,
    'title'=>'Listing One',
    'description'=>'this is a good thing'],['id'=>2,
    'title'=>'Listing two',
    'description'=>'this is not a good thing']];

    foreach($listings as $listing){
        if($listing["id"]==$id){
            return $listing;
        }
    }
});


Route::get('/', function (){
    return view('listings',[
        'listings'=>Listing::all()
    ]);
});

Route::get('/listing/{id}',function($id){
    $listing=Listing::find($id);
    if($listing){
        return view('listing',[
            'listing'=>Listing::find($id)
        ]);
    }else{
        abort("404");
    }

});

Route::get("/form",function(){
    return view("form",[
        "demos"=>demotables::all()
    ]);
});

Route::get("/fruit",function(){
    // dd($request->name,$request->age);
    return view("fruits",[
        "fruits"=>fruits::all()
    ]);
    //SELECT * FROM fruits
});

Route::get("/search/{id}",function($id){
    
    return view("search",[
        "search"=>fruits::find($id)
    ]);
    //SELECT * FROM fruits WHERE id=$id
});

Route::get('/',[ListingController::class,'index']);

Route::get("/",[UserController::class,'index']);

Route::get("/register",[UserController::class,'register']);

Route::post("/autification",[UserController::class,'autification']);

Route::post("/createuser",[UserController::class,'createuser']);

Route::get('/',[ListingController::class,'index']);

Route::get('/listings/create',[ListingController::class,'create']);

Route::post('/listings',[ListingController::class,'store']);

Route::get('/listing/{listings}',[ListingController::class,'show']);