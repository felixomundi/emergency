<?php

namespace App\Http\Controllers\Admin;

use App\Mail\ContactMail;
use App\Models\EmailReply;
use App\Models\EmailContacts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ReplyFormRequest;
use App\Mail\EmailReplyMailable;

class EmailContactController extends Controller
{
    public function index(){
        $contacts = EmailContacts::orderBy("created_at","desc")->get();
        return view("admin.contacts.index", compact("contacts"));
    }
    public function readmail($slug){
        $data = ["slug"=>$slug];
        $contact = EmailContacts::where($data)->first();
        if($contact){
            return view('admin.contacts.readmail', compact("contact"));
        }else{
            return redirect()->back()->with("error","Contact Not Found");
        }
    }
    public function reply($slug){
        $contact = EmailContacts::where("slug",$slug)->first();
        if($contact){
            return view('admin.contacts.reply', compact("contact"));
        }else{
            return redirect()->back()->with("error","Contact Not Found");
        }

    }
    public function replyEmail(ReplyFormRequest $request, $slug){
        $contact  = EmailContacts::where("slug", $slug)->first();
      if($contact){
        $emailreply = new EmailReply();
        $emailreply->email_contact_id = $contact->id;
        $emailreply->response= $request->response;
        $emailreply->save();

        $contact->status = $request->status;
        $contact->save();

        // Mail::to()->send(new EmailReplyMailable());

        return redirect()->back()->with("success", "Reply message sent successfully");

        }else{
            return redirect()->back()->with("error", "Contact Not Found");
        }
    }
}
