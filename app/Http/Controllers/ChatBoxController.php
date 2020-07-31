<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;

class ChatBoxController extends Controller
{
    public function enterRequest(){
        $botman = app('botman');
        /* $botman->hears('{message}', function($botman, $message) {
            if ($message == 'hi! i need your help') {
                $this->askName($botman);
            }else{
                $botman->reply("Hello! how can i Help you...?");
            }
        }); */
        $botman->hears('My First Message', function ($bot) {
            $bot->reply('Your First Response');
        });
        $botman->hears('My First', function ($bot) {
            $bot->reply('Your First');
        });
        $botman->listen();
    }
    public function askReply($botman){
        $botman->ask('Hello! What is your Name?', function(Answer $answer) {
            $name = $answer->getText();
            $this->say('Nice to meet you '.$name);
        });
    }
}
