<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScopusReference extends Model
{
    //
    protected $guarded = ['id'];

    protected $table = 'scopus_references';

    public function journal()
    {
        return $this->belongsTo(JournalAnalysis::class, "journal_analysis_id");
    }
}
