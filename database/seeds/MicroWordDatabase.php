<?php


class MicroWordDatabase
{
    private static $synonymGroups = [
        ['Tisch', 'Tafel', 'Tableau'],
        ['Stuhl', 'Sessel', 'Sitz'],
        ['Treppe', 'Stiege', 'Stufen'],
        ['Bank', 'Sofa', 'Couch'],
        ['Kasten', 'Schrank', 'Kästchen'],
        ['Vase'],
    ];

    /**
     * @return array all the words this helper knows
     */
    public static function getWords() {
        $allWords=[];
        foreach(self::$synonymGroups as $synonymGroup) {
            foreach($synonymGroup as $word) {
                array_push($allWords, $word);
            }
        }
        return $allWords;
    }

    /**
     * @param string $word
     * @return string[] all synonyms this helper knows for a given word
     */
    public static function getSynonymsForWord(string $word): array
    {
        $synonymGroup = self::findSynonymGroupForWord($word);
        if($synonymGroup) {
            return array_diff($synonymGroup, [$word]); /* array with all except word */
        } else {
            return [];
        }
    }

    private static function findSynonymGroupForWord(string $word) {
        foreach(self::$synonymGroups as $synonymGroup) {
            if(in_array($word, $synonymGroup)) {
                return $synonymGroup;
            }
        }
        return null;
    }
}
