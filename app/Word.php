<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function synonyms() {
        return $this->belongsToMany(
            'App\Word',
            'synonyms',
            'word_a_id',
            'word_b_id'
        );
    }

    public function setSynonym(Word $otherWord) {
        if(!$this->isSynonym($otherWord)) {
            $this->synonyms()->save($otherWord);
            $otherWord->synonyms()->save($this);
        }
    }

    public function isSynonym(Word $otherWord) : bool {
        if($this->name == $otherWord->name) {
            $wordsAreEqual = true;
        } else {
            $wordsAreEqual = false;
        }

        if($this->synonyms()->where('name', $otherWord->name)->count() > 0) {
            $isSynonymOfOther = true;
        } else {
            $isSynonymOfOther = false;
        }

        return $wordsAreEqual || $isSynonymOfOther;
    }
}
