<?php

namespace App\Http\Controllers\Testimonial;

use App\Http\Controllers\Controller;
use App\Model\Testimonial\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('id','desc')->get();
        return view('backend.testimonial.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image'=> 'required|mimes:jpeg,jpg,png,gif|required|max:10000',
            'description' => 'required'
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->organization = $request->organization;
        $testimonial->description = $request->description;

        $randVal = rand(1111, 9999);
        $image = $request->image;
        $testimonial->image = $randVal.time().$image->getClientOriginalName();
        $image->move(public_path().'/images/'.'testimonialImage', $testimonial->image);

        if($testimonial->save()){
            session()->flash('success_msg','Testimonial Created Successfully');
            return redirect()->action('Testimonial\TestimonialController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Testimonial\TestimonialController@index');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image'=> 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'description' => 'required'
        ]);
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->organization = $request->organization;
        $testimonial->description = $request->description;

        $randVal = rand(1111, 9999);
        $image = $request->image;
        $testimonial->image = $randVal.time().$image->getClientOriginalName();
        $image->move(public_path().'/images/'.'testimonialImage', $testimonial->image);

        if($testimonial->save()){
            session()->flash('success_msg','Testimonial Updated Successfully');
            return redirect()->action('Testimonial\TestimonialController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Testimonial\TestimonialController@index');
        }
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if($testimonial->delete())
        {
            session()->flash('success_msg','Testimonial Deleted Successfully');
            return redirect()->action('Testimonial\TestimonialController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Testimonial\TestimonialController@index');
        }
    }
}
