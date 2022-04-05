<?php

use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Route;

Route::put('/newsletter', NewsletterController::class)->name('mailchimp.newsletter.store');
