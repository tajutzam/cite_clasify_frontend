<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalAnalysis extends Model
{
    //
    protected $table = 'journal_analysis';

    protected $guarded = ['id'];

    public function citation_sentences()
    {
        return $this->hasMany(CitationSentence::class, "journal_analysis_id", "id");
    }

    public function scopus_references()
    {
        return $this->hasMany(ScopusReference::class, "journal_analysis_id", "id");
    }
}
