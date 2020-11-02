<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use App\Model\About\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::all();
        if(count($about)>0){
            $about = $about->first();
        }else{
            $about = [];
        }
        return view('backend.about.index', compact('about'));
    }

    public function create()
    {
        $about = About::all();
        if(count($about)>0){
            $about = $about->first();
        }else{
            $about = [];
        }
        return view('backend.about.add', compact('about'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'about_content' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);

        $about = new About();
        $about->content = $request->about_content;

        $about->facebook = $request->facebook;
        $about->instagram = $request->instagram;
        $about->twitter = $request->twitter;
        $about->linkedin = $request->linkedin;
        $about->google = $request->google;

        $randVal = rand(1111, 9999);
        $image = $request->image;
        $about->image = $randVal.time().$image->getClientOriginalName();
        $image->move(public_path().'/images/'.'serviceImage', $about->image);

        if($about->save()){
            session()->flash('success_msg','Created Successfully');
            return redirect()->action('About\AboutController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('About\AboutController@index');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'about_content' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        $about = About::findOrFail($id);
        $about->content = $request->about_content;

        $about->facebook = $request->facebook;
        $about->instagram = $request->instagram;
        $about->twitter = $request->twitter;
        $about->linkedin = $request->linkedin;
        $about->google = $request->google;

        if($request->image){
            $randVal = rand(1111, 9999);
            $image = $request->image;
            $about->image = $randVal.time().$image->getClientOriginalName();
            $image->move(public_path().'/images/'.'serviceImage', $about->image);
        }

        if($about->save()){
            session()->flash('success_msg','Updated Successfully');
            return redirect()->action('About\AboutController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('About\AboutController@index');
        }
    }

    public function destroy($id)
    {
        $about = About::findOrFail($id);
        if($about->delete())
        {
            session()->flash('success_msg','Deleted Successfully');
            return redirect()->action('About\AboutController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('About\AboutController@index');
        }
    }
}
