<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    public function synonyms()
    {
        return $this->belongsToMany(
            'App\Word',
            'synonyms',
            'word_a_id',
            'word_b_id'
        );
    }

    public function setSynonym(Word $otherWord)
    {
        if (!$this->isSynonym($otherWord)) {
            $this->synonyms()->save($otherWord);
            $otherWord->synonyms()->save($this);
        }
    }

    public function isSynonym(Word $otherWord)
    {
        $wordsAreEqual = $this->name == $otherWord->name;
        $thisIsSynonymOfOther = ($this->synonyms()->where('name', $otherWord->name)->count() > 0);
        $otherIsSynonymOfThis = ($otherWord->synonyms()->where('name', $this->name)->count() > 0);

        return $wordsAreEqual || $thisIsSynonymOfOther || $otherIsSynonymOfThis;
    }

}
