<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['job_title', 'company_id'];

    public function appliedJobs()
    {
        return $this->hasMany(AppliedJob::class);
    }

    // Add other relationships as needed (e.g., with Company)
}
