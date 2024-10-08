<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AppliedJob;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Log;


class AppliedJobController extends Controller
{
    public function index()
    {
        $applications = JobApplication::with(['post', 'post.company'])->where('user_id', auth()->id())->get();

        // Log the retrieved applications for debugging
        Log::info($applications);

        return view('account.applyJob.index', compact('applications'));
    }

}
