<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Contact\Contact;
use App\Http\Controllers\Controller;
use App\Model\About\About;
use App\Model\Contact\Query;
use App\Model\Project\Project;
use App\Model\Review\ServiceReview;
use App\Model\Service\Service;
use App\Model\Slider\Slider;
use App\Model\Testimonial\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function home()
    {
        $sliders = Slider::where('status',1)->get();
        $services = Service::where('status',1)->limit(6)->get();
        $projects = Project::with(['images'])->limit(3)->get();
        $testimonials = Testimonial::get();
        $about = About::first();
        $contact = Contact::first();
        return view('frontend.home', compact('sliders', 'services', 'contact','about', 'projects', 'testimonials'));
    }

    public function about()
    {
        $about = About::first();
        $contact = Contact::first();
        $services = Service::where('status',1)->limit(6)->get();
        return view('frontend.about', compact('about','contact', 'services'));
    }

    public function services()
    {
        $services = Service::where('status',1)->paginate(12);
        $about = About::first();
        $contact = Contact::first();
        return view('frontend.services', compact('services', 'about','contact'));
    }

    public function service($slug)
    {
        $service = Service::where('slug',$slug)->first();
        $services = Service::where('status',1)->get();
        $reviews = ServiceReview::where('is_deleted',0)->orderBy('high_priority', 'desc')->get();
        $about = About::first();
        $contact = Contact::first();
        return view('frontend.service', compact('service','services', 'about','contact', 'services', 'reviews'));
    }

    public function projects()
    {
        $services = Service::where('status',1)->limit(6)->get();
        $projects = Project::where('status',1)->paginate(12);
        $about = About::first();
        $contact = Contact::first();
        return view('frontend.projects', compact('projects', 'about','contact', 'services'));
    }

    public function project($slug)
    {
        $services = Service::where('status',1)->limit(6)->get();
        $project = Project::with('images')->where('slug',$slug)->first();
        $about = About::first();
        $contact = Contact::first();
        return view('frontend.project', compact('project','about','contact', 'services'));
    }

    public function contact()
    {
        $services = Service::where('status',1)->limit(6)->get();
        $about = About::first();
        $contact = Contact::first();
        return view('frontend.contact', compact('about','contact', 'services'));
    }

    public function getMail(Request $request){
        $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'message'=>'required',
        ]);

        $data = [
            'name'=>$request->name,
            'from'=> $request->email,
            'to'=> 'shrestha.azay@gmail.com',
            'subject'=> $request->subject,
            'message'=> $request->message,
        ];

        $query = new Query();
        $query->name = $request->name;
        $query->email = $request->email;
        $query->subject = $request->subject;
        $query->message = $request->message;

        if($query->save()){
            Mail::send('frontend.mail', ['data' => $data], function ($m) use ($data) {
                $m->from($data['from'], 'Your Application');
                $m->to($data['to'])->subject('Message from website');
            });
        }
        return redirect()->back()->with('success', 'Thank you for Contacting us..');
    }

    public function serviceReview(Request $request, $id){
        $review = new ServiceReview();
        $review->service_id = $id;
        $review->name = $request->name;
        $review->email = $request->email;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->save();
        return redirect()->back()->with('success', 'Thank you for your review..');
    }

    public function loadReview(){

    }
}
