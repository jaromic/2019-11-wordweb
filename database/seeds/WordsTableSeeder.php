<?php

use App\Word;
use Illuminate\Database\Seeder;

class WordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allWords = MicroWordDatabase::getWords();
        foreach($allWords as $wordName) {
            $word = new Word();
            $word->name = $wordName;
            $word->save();
        }

        foreach($allWords as $wordName) {
            $word = Word::where('name', $wordName)->firstOrFail();
            $synonymsForWordName = MicroWordDatabase::getSynonymsForWord($wordName);
            foreach($synonymsForWordName as $synonymWordName) {
                $otherWord = Word::where('name', $synonymWordName)->firstOrFail();
                $word->setSynonym($otherWord);
            }
        }
    }
}
