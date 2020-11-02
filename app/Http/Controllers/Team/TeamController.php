<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Model\Team\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{

    public function index()
    {
        $teams = Team::orderBy('id','desc')->get();
        return view('backend.team.index', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image'=> 'required|mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);

        $team = new Team();
        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->facebook = $request->facebook;
        $team->twitter = $request->twitter;
        $team->instagram = $request->instagram;
        $team->linkedin = $request->linkedin;
        $team->email = $request->email;
        $team->status = $request->status;

        $randVal = rand(1111, 9999);
        $image = $request->image;
        $team->image = $randVal.time().$image->getClientOriginalName();
        $image->move(public_path().'/images/'.'teamImage', $team->image);

        if($team->save()){
            session()->flash('success_msg','Team Created Successfully');
            return redirect()->action('Team\TeamController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Team\TeamController@index');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image'=> 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);
        $team = Team::findOrFail($id);
        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->facebook = $request->facebook;
        $team->twitter = $request->twitter;
        $team->instagram = $request->instagram;
        $team->linkedin = $request->linkedin;
        $team->email = $request->email;
        $team->status = $request->status;

        $randVal = rand(1111, 9999);
        $image = $request->image;
        $team->image = $randVal.time().$image->getClientOriginalName();
        $image->move(public_path().'/images/'.'teamImage', $team->image);

        if($team->save()){
            session()->flash('success_msg','Team Updated Successfully');
            return redirect()->action('Team\TeamController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Team\TeamController@index');
        }
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        if($team->delete())
        {
            session()->flash('success_msg','User Deleted Successfully');
            return redirect()->action('Team\TeamController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Team\TeamController@index');
        }
    }
}
