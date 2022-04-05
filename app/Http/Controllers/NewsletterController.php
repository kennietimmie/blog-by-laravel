<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Services\Newsletter;

class NewsletterController extends Controller
{
   public function __invoke(Newsletter $newsletter, Request $request)
   {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        try {
            $newsletter->subscribe($request->email);
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added at the moment',
                'message' => 'This email could not be added at the moment'
            ]);
        }
        return back()->with('message', 'Your have successfully subscribed');
   }
}
