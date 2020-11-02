<?php

namespace App\Http\Controllers\Contact;

use App\Model\Contact\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::first();
        return view('backend.contact.index',compact('contact'));
    }


    public function store(Request $request)
    {
        $contact = new Contact();
        $contact->organization = $request->organization;
        $contact->address = $request->address;
        $contact->contact = $request->contact;
        $contact->email = $request->email;
        $contact->map_url = $request->map_url;
        if($contact->save())
        {
            session()->flash('success_msg','Contact Details Added Successfully');
            return redirect()->action('Contact\ContactController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured');
            return redirect()->action('Contact\ContactController@index');
        }
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->organization = $request->organization;
        $contact->address = $request->address;
        $contact->contact = $request->contact;
        $contact->email = $request->email;
        $contact->map_url = $request->map_url;
        if($contact->save())
        {
            session()->flash('success_msg','Contact Details Updated Successfully');
            return redirect()->action('Contact\ContactController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured');
            return redirect()->action('Contact\ContactController@index');
        }
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        if($contact->delete())
        {
            session()->flash('success_msg','Deleted Successfully');
            return redirect()->action('Contact\ContactController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Contact\ContactController@index');
        }
    }
}
