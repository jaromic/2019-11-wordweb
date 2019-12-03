<?php

namespace Tests\Unit;

use App\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WordTest extends TestCase
{
    public function testIsSynonymYesSameWord() {
        $word = Word::findOrFail(1);
        $otherWord = $word;
        $this->assertTrue($word->isSynonym($otherWord));
    }

    public function testIsSynonymYesDifferentWords() {
        $word1 = Word::where('name', 'Schrank')->firstOrFail();
        $word2 = Word::where('name', 'Kasten')->firstOrFail();
        $this->assertTrue($word1->isSynonym($word2));
    }

    public function testIsSynonymNoDifferentWords() {
        $word1 = Word::where('name', 'Schrank')->firstOrFail();
        $word2 = Word::where('name', 'Tisch')->firstOrFail();
        $this->assertFalse($word1->isSynonym($word2));
    }
}
