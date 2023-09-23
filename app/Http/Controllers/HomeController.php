<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\EmailContacts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactFormRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 
        //'verified'
        ])->except(["index"]);
    }
    public function index()
        {
            return view('frontend.index');
    }
    public function contact()
        {
            return view('frontend.contact');
    }
    public function inbox()
        {
            $contacts = EmailContacts::where("user_id", auth()->user()->id)->orderby("created_at","desc")->get();
          return view('frontend.inbox', compact("contacts"));
    }
    public function sent()
        {
            $contacts = EmailContacts::where("user_id", auth()->user()->id)->orderBy("created_at","desc")->get();
                       return view('frontend.sent' , compact("contacts"));
    }
    public function emailUs(ContactFormRequest $request){
        try {
            $user = Auth::user()->name;
            $contact =  new EmailContacts();
            $contact->user_id = auth()->user()->id;
            $contact->subject =$request->subject;
            $contact->message =$request->message;
            $contact->status = "Requested";
            $contact->priority = $request->priority;
            $contact->save();
            $email = env("MAIL_FROM_ADDRESS", "info@kadesea.co.ke");
           Mail::to($email)->send(new ContactMail($contact));
            return redirect()->back()->with("success", "Your Contact Message has been sent to us successfully");

        } catch (\Throwable $th) {

            return redirect()->back()->with("error", "Sorry $user your Email couldn't be sent at this moment try again later");
        }
    }
    public function readmail($slug){
        $data = ["user_id"=>auth()->user()->id, "slug"=>$slug];
        $contact = EmailContacts::where($data)->first();
        if($contact){
            return view('frontend.readmail', compact("contact"));
        }else{
            return redirect()->back()->with("error","Contact Not Found");
        }

    }
    public function viewContact($slug){
        $data = ["user_id"=>auth()->user()->id, "slug"=>$slug];
        $contact = EmailContacts::where($data)->first();
        if($contact){
            return view('frontend.view-contact', compact("contact"));
        }else{
            return redirect()->back()->with("error", "Contact Not Found");
        }
    }
}
