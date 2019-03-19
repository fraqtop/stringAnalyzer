<?php


namespace App\Models;


use App\Interfaces\IStringHandler;

class AnagramFinder implements IStringHandler
{
    public function getSubmitLabel(): string
    {
        return 'check for anagrams';
    }

    public function process(string $string): string
    {
        $words = explode(' ', $string);
        $result = [];
        foreach ($words as $word) {
            $anagrams = array_filter($words, function ($element) use ($word) {
                return $this->isAnagram($word, $element);
            });
            if ($anagrams) {
                $result[$word] = $anagrams;
            }
        }
        return $this->getConclusion($result);
    }

    private function isAnagram($subject, $currentWord): bool
    {
        if ($subject === $currentWord) {
            return false;
        }
        $subjectLength = mb_strlen($subject);
        if ($subjectLength !== mb_strlen($currentWord)) {
            return false;
        }
        for ($i = 0; $i < $subjectLength; $i++) {
            if (mb_strpos($currentWord, mb_substr($subject, $i, 1)) === false) {
                return false;
            }
        }
        return true;
    }

    private function getConclusion(array $result): string
    {
        if (!count($result)) {
            return 'No anagrams were found';
        }
        $output = '';
        foreach ($result as $subject => $anagrams) {
            $output .= "anagrams for $subject -";
            foreach ($anagrams as $anagram) {
                $output .= " $anagram ";
            }
        }
        return $output;
    }
}