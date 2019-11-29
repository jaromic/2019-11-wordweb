<?php

namespace Tests\Feature;

use Tests\TestCase;

class WordTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testGetWords()
    {
        $response = $this->get('/api/words');
        $response->assertStatus(200);
    }

    public function testGetWordsRecordCountEqualsWordCount()
    {
        $response = $this->get('/api/words');
//        $response->dumpHeaders();
//        $response->dump();
        $response->assertJsonCount(count(\MicroWordDatabase::getWords()));
    }

    public function testWordTischPresent()
    {
        $response = $this->get('/api/words');
        $searchWord = 'Tisch';
        $this->assertTrue($this->isWordNamePresentInResponseJson($response, $searchWord));
    }

    public function testWordFischNotPresent()
    {
        $response = $this->get('/api/words');
        $searchWord = 'Fisch';
        $this->assertFalse($this->isWordNamePresentInResponseJson($response, $searchWord));
    }


    private function isWordNamePresentInResponseJson(\Illuminate\Foundation\Testing\TestResponse $response, string $searchWord): bool
    {
        $wordsArray = $response->decodeResponseJson();
        $found = false;
        foreach ($wordsArray as $word) {
            if ($word['name'] == $searchWord) {
                $found = true;
            }
        }
        return $found;
    }
}
