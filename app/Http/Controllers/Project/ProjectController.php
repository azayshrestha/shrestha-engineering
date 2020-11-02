<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Model\Project\Project;
use App\Model\Project\ProjectImage;
use App\Model\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::get();
        return view('backend.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = [];
        $services = Service::orderBy('title', 'ASC')->get();
        return view('backend.project.add', compact('project', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'images' => 'required|max:10000',
        ]);

        $project = new Project();

        $project->title = $request->title;
        $project->service_id = $request->service;
        $slug = Str::slug($request->title);
//        $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $request->title))))), '-'));

        $project->slug = $slug;

        $project->description = $request->description;
        $project->status = $request->status;

        if($project->save())
        {
            if(!empty($request->images))
            {
                $count = count($request->images);
                for($x=0; $x<$count; $x++) {
                    $projectImage = new ProjectImage();

                    $projectImage->project_id = $project->id;

                    $randVal = rand(1111, 9999);

                    $image = $request->images[$x];
                    $projectImage->image = $randVal . time() . $image->getClientOriginalName();
                    $image->move(public_path() . '/images/' . 'projectImage', $projectImage->image);

                    $projectImage->save();
                }
            }
            $request->session()->flash('success_msg','Project Added Successfully');
            return redirect()->action('Project\ProjectController@index');
        }else{
            $request->session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Project\ProjectController@index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services = Service::orderBy('title', 'ASC')->get();
        $project = Project::with(['images'])->findOrFail($id);
        return view('backend.project.add', compact('project', 'services'));
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
            'images' => 'max:10000',
        ]);

        $project = $project = Project::with(['images'])->findOrFail($id);

        $imageArray = [];
        foreach ($project->images as $key=>$image){
            $imageArray[$key] = $image->id;

        }
        $removed_images = array_diff($imageArray, $request->oldImages);

        foreach ($removed_images as $img){
            $deletedImage = ProjectImage::findOrFail($img);
            if ($deletedImage->image) {
                $image_path = public_path() . '/images/projectImage/' . $deletedImage->image;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $deletedImage->delete();
        }

        $project->title = $request->title;
        $project->service_id = $request->service;
        $slug = Str::slug($request->title);
//        $slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $request->title))))), '-'));

        $project->slug = $slug;

        $project->description = $request->description;
        $project->status = $request->status;

        if($project->save())
        {
            if(!empty($request->images))
            {
                $count = count($request->images);
                for($x=0; $x<$count; $x++) {
                    $projectImage = new ProjectImage();

                    $projectImage->project_id = $project->id;

                    $randVal = rand(1111, 9999);

                    $image = $request->images[$x];
                    $projectImage->image = $randVal . time() . $image->getClientOriginalName();
                    $image->move(public_path() . '/images/' . 'projectImage', $projectImage->image);

                    $projectImage->save();
                }
            }
            $request->session()->flash('success_msg','Project Added Successfully');
            return redirect()->action('Project\ProjectController@index');
        }else{
            $request->session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Project\ProjectController@index');
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
        $project = $project = Project::with(['images'])->findOrFail($id);
        foreach ($project->images as $image){
            if ($image->image) {
                $image_path = public_path() . '/images/projectImage/' . $image->image;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }

        if($project->delete())
        {
            session()->flash('success_msg','Project Deleted Successfully');
            return redirect()->action('Project\ProjectController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Project\ProjectController@index');
        }
    }
}
