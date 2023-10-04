<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // show all listings
    public function index(){
        // dd(request('tag'));
        return view('listings.index',[
            'listings' => Listing::latest()->filter(request(['tag','search']))->paginate(4)
        ]);
    }

    // show one single listing
    public function show(Listing $id){
        return view('listings.show',[
            'listing' => $id
        ]);
    }

    // show create listing form
    public function create(){
        return view('listings.create');
    }

    // store method for job entry
    public function store(Request $request){
        
        $formData = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings','company')],
            'location' => 'required',
            'email' => ['required','email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'

        ]);
        
        if($request->hasFile('logo')){
            $formData['logo'] = $request->file('logo')->store('logos','public');
        }
        $formData['user_id'] = auth()->id();

        Listing::create($formData);
        return redirect('/')->with('message','Listing Created Successfully!');
    }

    // edit method for job entry => shows the edit page
    public function edit(Listing $id){
        return view('listings.edit',['listing'=>$id]);
    }

    // actual database update
    public function update(Request $request, Listing $id){

        // Login status check
        if($id->user_id != auth()->id()){
            abort(403, 'Unauthorized action');
        }
        else{
        $formData = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'email' => ['required','email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'

        ]);
        
        if($request->hasFile('logo')){
            $formData['logo'] = $request->file('logo')->store('logos','public');
        }

        $id->update($formData);
        return redirect('/')->with('message','Listing Updated Successfully!');
        }
    }
    
    // Delete listing
    public function destroy(Listing $id){
        if($id->user_id != auth()->id()){
            abort(403, 'Unauthorized action');
        }
        $id->delete();
        return redirect('/')->with('message','Listing deleted successfully');
    }

    // Manage Listings Function
    public function manage(){
        return view('listings.manage', ['listings' => auth()->user()->Listings()->get()]);
    }
}
