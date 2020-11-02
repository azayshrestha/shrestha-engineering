<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Model\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('status',1)->get();
        return view('backend.service.index', compact('services'));
    }

    public function create()
    {
        $service = [];
        return view('backend.service.add', compact('service'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'status' => 'required',
        ]);

        $service = new Service();

        $service->title = $request->title;
        $slug = Str::slug($request->title);
//        $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $request->title))))), '-'));
        $service->slug = $slug;
        $service->content = $request->service_content;
        $service->status = $request->status;

        $randVal = rand(1111, 9999);
        $image = $request->image;
        $service->image = $randVal.time().$image->getClientOriginalName();
        $image->move(public_path().'/images/'.'serviceImage', $service->image);

        if($service->save())
        {
            $request->session()->flash('success_msg','Service Added Successfully');
            return redirect()->action('Service\ServiceController@index');
        }else{
            $request->session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Service\ServiceController@index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('backend.service.add', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'status' => 'required',
        ]);

        $service = Service::findOrFail($id);

        $service->title = $request->title;
        $slug = Str::slug($request->title);
//        $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $request->title))))), '-'));
        $service->slug = $slug;
        $service->content = $request->service_content;
        $service->status = $request->status;
        if($request->image){
            $randVal = rand(1111, 9999);
            $image = $request->image;
            $service->image = $randVal.time().$image->getClientOriginalName();
            $image->move(public_path().'/images/'.'serviceImage', $service->image);
        }

        if($service->save())
        {
            $request->session()->flash('success_msg','Service Added Successfully');
            return redirect()->action('Service\ServiceController@index');
        }else{
            $request->session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Service\ServiceController@index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        if ($service->image) {
            $image_path = public_path() . '/images/serviceImage/' . $service->image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        if($service->delete())
        {
            session()->flash('success_msg','Deleted Successfully');
            return redirect()->action('Service\ServiceController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Service\ServiceController@index');
        }
    }
}
