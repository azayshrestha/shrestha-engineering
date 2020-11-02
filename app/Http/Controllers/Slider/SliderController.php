<?php

namespace App\Http\Controllers\Slider;

use App\Http\Controllers\Controller;
use App\Model\Slider\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('id','desc')->get();
        return view('backend.slider.index',compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'status' => 'required',
        ]);

        $slider = new Slider();
        $slider->title = $request->title;

        $randVal = rand(1111, 9999);
        $image = $request->image;
        $slider->image = $randVal.time().$image->getClientOriginalName();
        $image->move(public_path().'/images/'.'sliderImage', $slider->image);

        $slider->url = $request->url;
        $slider->status = $request->status;
        $slider->description = $request->description;

        if($slider->save())
        {
            $request->session()->flash('success_msg','Image Added Successfully in Slider');
            return redirect()->action('Slider\SliderController@index');
        }else{
            $request->session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Slider\SliderController@index');
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'status' => 'required',
        ]);

        $slider = Slider::findOrFail($id);
        $slider->title = $request->title;
        $slider->description = $request->description;

        if($request->image){
            $randVal = rand(1111, 9999);
            $image = $request->image;
            $slider->image = $randVal.time().$image->getClientOriginalName();
            $image->move(public_path().'/images/'.'sliderImage', $slider->image);
        }

        $slider->url = $request->url;
        $slider->status = $request->status;


        if($slider->save())
        {
            $request->session()->flash('success_msg','Slider Updated Successfully in Slider');
            return redirect()->action('Slider\SliderController@index');
        }else{
            $request->session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Slider\SliderController@index');
        }
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        if ($slider->image) {
            $image_path = public_path() . '/images/sliderImage/' . $slider->image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        if($slider->delete())
        {
            session()->flash('success_msg','Slider Deleted Successfully in Slider');
            return redirect()->action('Slider\SliderController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Slider\SliderController@index');
        }
    }
}
