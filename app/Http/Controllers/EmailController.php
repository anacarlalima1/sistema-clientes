<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public static function setEmailComprovacao ($slug, $user, $options = []) {

            $emails = DB::table('cms_email_templates')
                ->select('subject', 'content')
                ->where('slug', $slug)
                ->first();

            if (!$emails) {
                return false;
            }

            foreach ($options as $key=>$o) {
              $emails->content = str_replace("{{{$key}}}", $o, $emails->content);
              $emails->content = str_replace("[$key]", $o, $emails->content);
            }

            Mail::to($user->email)->queue(new Email($emails->content, $emails->subject, $slug));

            return true;


    }
}
