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
        $words = MicroWordDatabase::getWords();
        foreach ($words as $wordName) {
            $word = new App\Word();
            $word->name = $wordName;
            $word->save();
        }
        foreach ($words as $wordName) {
            $word = Word::where('name', $wordName)->firstOrFail();
            foreach (MicroWordDatabase::getSynonymsForWord($wordName) as $synonymWordName) {
                $synonymWord = Word::where('name', $synonymWordName)->firstOrFail();
                $word->setSynonym($synonymWord);
            }
        }
    }
}
