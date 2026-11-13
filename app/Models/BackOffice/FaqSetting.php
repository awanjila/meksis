<?php

namespace App\Models\BackOffice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqSetting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'title' => 'FREQUENTLY ASKED QUESTIONS',
            'subtitle' => 'Answers to the questions we hear most',
        ]);
    }
}
