<?php

namespace App\Models;


use App\Interfaces\IStringHandler;

/**
 *Implements logic of palindromes finding.
 */

class PalindromeFinder implements IStringHandler
{
    private $stringLength;

    public function getSubmitLabel(): string
    {
        return 'find palindromes';
    }

    public function process($string): string
    {
        $this->stringLength = mb_strlen($string);
        $string = mb_strtolower($string);
        $result = [];
        $charQueue = new \SplQueue();
        $charQueue->enqueue($this->getChar($string, 0));
        $charQueue->enqueue($this->getChar($string, $charQueue->top()['index'] + 1));
        do {
            $palindrome = null;
            $charQueue->enqueue($this->getChar($string, $charQueue->top()['index'] + 1));
            if ($charQueue[1]['value'] === $charQueue[2]['value']) {
                $palindrome = $this->getPalindrome($string, $charQueue[1], $charQueue[2]);
            }
            if ($charQueue[0]['value'] === $charQueue[2]['value']) {
                $palindrome = $this->getPalindrome($string, $charQueue[0], $charQueue[2]);
            }
            $charQueue->dequeue();
            if ($palindrome) {
                $result[] = $palindrome;
            }
        } while ($charQueue->top()['index'] < $this->stringLength);
        return $this->getConclusion($result);
    }

    private function getPalindrome($string, $leftBorder, $rightBorder)
    {
        while ($leftBorder['index'] >= 0 && $rightBorder['index'] < $this->stringLength) {
            $leftBorder = $this->getChar($string, $leftBorder['index'] - 1, true);
            $rightBorder = $this->getChar($string, $rightBorder['index'] + 1);
            if ($leftBorder['value'] !== $rightBorder['value']) {
                break;
            }

        }
        $leftBorder = $this->getChar($string, $leftBorder['index'] + 1)['index'];
        $rightBorder = $this->getChar($string, $rightBorder['index'] - 1, true)['index'];
        return mb_substr($string, $leftBorder, ($rightBorder - $leftBorder) + 1);
    }

    private function getChar(string $string, int $index, bool $backwards = false)
    {
        $newChar = mb_substr($string, $index, 1);
        if ($backwards) {
            while ($index >= 0 && $this->isServiceMark($newChar)) {
                $index--;
                $newChar = mb_substr($string, $index, 1);
            }
        } else {
            while ($index < $this->stringLength && $this->isServiceMark($newChar)) {
                $index++;
                $newChar = mb_substr($string, $index, 1);
            }
        }
        return [
            'index' => $index,
            'value' => mb_substr($string, $index, 1)
        ];
    }

    private function isServiceMark($char)
    {
        $serviceMarks = [' ', ',', '.', '!', '?'];
        return in_array($char, $serviceMarks);
    }

    private function getConclusion($result): string
    {
        if (!count($result)){
            return 'there are no palindromes in this string, try another';
        }
        $conclusion = 'the found palindromes are: ';
        foreach ($result as $palindrome) {
            $conclusion .= "\"$palindrome\" ";
        }
        return $conclusion;
    }
}