<?php
namespace Vis\MailTemplates;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

class MailT extends Model {


    public $to = "";
    public $name = "";
    public $attach = "";
    private $subject = "";
    private $body = "";


    public function __construct($slug, $params)
    {
        if ($slug && $params) {
            $result = EmailsTemplate::where("slug", $slug)->first();

            foreach ($params as $k => $el) {
                $search[] = "{" . $k . "}";
                $replace[] = $el;
            }
            $search[] = "{domen}";
            $replace[] = $_SERVER['HTTP_HOST'];

            if ($result->id) {
                $this->subject = $result->subject;
                $this->body = $result->body;

                $this->body = str_replace(
                    '/images/', 'http://' . Request::server ("HTTP_HOST") . "/images/",
                    $this->body
                );
                $this->body = str_replace($search, $replace, $this->body);
                $this->subject = str_replace($search, $replace, $this->subject);
            }
        }

    }

    public function send()
    {
        if ($this->to && $this->body && $this->subject) {
            $data = array("body" => $this->body);

            //save in logs
            $this->doAddMailer();

            Mail::send('mail-templates::email_body', $data, function($message)
            {
                if (strpos($this->to, ",")) {
                    $toArray = explode(",", $this->to);

                    foreach ($toArray as $email) {
                        $email = trim($email);
                        $message->to($email)->subject($this->subject);
                    }
                } else {
                    $message->to($this->to)->subject($this->subject);
                }

                //if isset attach file
                if ($this->attach) {
                    if (is_array($this->attach)) {
                        foreach ($this->attach as $attach) {
                            $message->attach($attach->getRealPath(), array(
                                    'as' => $attach->getClientOriginalName(),
                                    'mime' => $attach->getMimeType())
                            );
                        }
                    } else {
                        $message->attach($this->attach->getRealPath(), array(
                                'as' => $this->attach->getClientOriginalName(),
                                'mime' => $this->attach->getMimeType())
                        );
                    }
                }
            });

            return true;

        } else {
            return false;
        }
    }

    private function doAddMailer()
    {
        Mailer::create(
            array(
                "email_to" => $this->to,
                "subject" => $this->subject,
                "body" => $this->body,
            )
        );
    }

}