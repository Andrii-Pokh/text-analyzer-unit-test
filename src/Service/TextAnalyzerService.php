<?php

namespace App\Service;

use App\Entity\CalculationText;
use App\Helper\StringHelper;

class TextAnalyzerService
{
    private ?string $text;
    private string $textWithoutSpaces;
    private array $wordsWithSigns;
    private array $words;
    private array $sentences;

    const TOP_COUNT = 10;
    const SORT_LONGEST = 'longest';
    const SORT_SHORTEST = 'shortest';

    public function setText(CalculationText $input): void
    {
        $this->text = $input->getText();
        $this->textWithoutSpaces = str_replace(' ', '', $this->text);
        $this->wordsWithSigns = preg_split('/\s+/u', $this->text);

        preg_match_all('/[\w\'-]+/u', $this->text, $matches);
        $this->words = $matches[0];

        $this->sentences = array_filter(preg_split('/(?<=[!?.])./u', $this->text));
    }

    public function getCharsNumber(): array
    {
        return [
            'chars' => mb_strlen($this->textWithoutSpaces, 'UTF-8'),
            'with spaces' => mb_strlen($this->text, 'UTF-8')
        ];
    }

    public function getWordsNumber(): int
    {
        return count($this->words);
    }

    public function getSentencesNumber(): int
    {
        return count(array_filter($this->sentences));
    }

    public function getCharsFrequency(): array
    {
        $letters = StringHelper::mb_count_chars($this->textWithoutSpaces);

        arsort($letters);

        return $letters;
    }

    public function getCharsPercentage(): array
    {
        $length = mb_strlen($this->textWithoutSpaces, 'UTF-8');
        $letters = StringHelper::mb_count_chars($this->textWithoutSpaces);
        arsort($letters);

        $res = [];
        foreach ($letters as $key => $char) {
            $res[$key] = number_format((float)$char/$length, 2, '.', '') . ' %';
        }

        return $res;
    }

    public function getAvarageWordLength()
    {
        return $this->getAvarageLengthOfWordsInList($this->words);
    }

    public function getAvarageNumberOfWordsInSentence(): array
    {
        $res = [];
        foreach ($this->sentences as $sentence) {
            $words = array_filter(preg_split('/\s+/u', $sentence));
            $res[] = $this->getAvarageLengthOfWordsInList($words);
        }

        return $res;
    }

    public function getTopMostUsedWords($count = self::TOP_COUNT): array
    {
        $words = $this->words;
        $words = array_count_values($words);
        arsort($words);

        return array_slice($words, 0, $count);
    }

    public function getTopLongestWords($count = self::TOP_COUNT): array
    {
        $words = $this->words;
        $words = array_count_values($words);

        $keys = array_keys($words);

        $this->sortByLength($keys);

        return array_slice($keys, 0, $count);
    }

    public function getTopShortestWords($count = self::TOP_COUNT): array
    {
        $words = $this->words;
        $words = array_count_values($words);
        $keys = array_keys($words);

        $this->sortByLength($keys, self::SORT_SHORTEST);

        return array_slice($keys, 0, $count);
    }

    public function getTopLongestSentences($count = self::TOP_COUNT): array
    {
        $sentences = $this->sentences;

        $this->sortByLength($sentences);

        return array_slice($sentences, 0, $count);
    }

    public function getTopShortestSentences($count = self::TOP_COUNT): array
    {
        $sentences = $this->sentences;

        $this->sortByLength($sentences, self::SORT_SHORTEST);

        return array_slice($sentences, 0, $count);
    }

    public function getNumberOfPalindromeWords(): int
    {
        $words = $this->words;
        $words = array_count_values($words);
        $keys = array_keys($words);

        $count = 0;
        foreach ($keys as $word) {
            if ($this->isPalindrome($word)) {
                $count++;
            }
        }

        return $count;
    }

    public function getTopLongestPalindromeWords($count = self::TOP_COUNT): array
    {
        $words = $this->words;
        $words = array_count_values($words);
        $keys = array_keys($words);

        $palindromes = [];
        foreach ($keys as $word) {
            if ($this->isPalindrome($word)) {
                $palindromes[] = $word;
            }
        }

        $this->sortByLength($palindromes);

        return array_slice($palindromes, 0, $count);
    }

    public function isWholeTextPalindrome(): bool
    {
        return $this->isPalindrome($this->textWithoutSpaces);
    }

    public function getReversedText(): string
    {
        return StringHelper::mb_strrev($this->text);
    }

    public function getReversedTextWithIntactWords(): string
    {
        $words = $this->wordsWithSigns;
        krsort($words);

        foreach ($words as $key => $word) {
            if (preg_match_all('/\W/u', $word, $match, PREG_OFFSET_CAPTURE)) {
                preg_match('/\w/u', $word, $firstLetter);
                preg_match('/\w/u', StringHelper::mb_strrev($word), $lastLetter);

                if (!empty($firstLetter[0]) && !empty($lastLetter[0])) {
                    $wordArr = mb_str_split($word);
                    $wordArrReverse = array_flip($wordArr);
                    $firstLetterPosition = array_search($firstLetter[0], $wordArr);
                    $lastLetterPosition = $wordArrReverse[$lastLetter[0]];
                    $lettersOnlyArr = array_slice($wordArr, $firstLetterPosition, ($lastLetterPosition + 1) - $firstLetterPosition);

                    if ($firstLetterPosition !== 0) {
                        $lettersOnlyArr[] = implode('', array_reverse(array_slice($wordArr, 0, $firstLetterPosition)));
                    }

                    if ($lastLetterPosition !== count($wordArr) - 1) {
                        array_unshift($lettersOnlyArr, implode('', array_reverse(array_slice($wordArr, $lastLetterPosition + 1))));
                    }

                    $words[$key] = implode('', $lettersOnlyArr);
                }
            }
        }

        return implode(' ', $words);
    }

    private function isPalindrome(string $word): bool
    {
        return StringHelper::mb_strrev($word) === $word;
    }

    /**
     * @return false|float
     */
    private function getAvarageLengthOfWordsInList(array $list)
    {
        $length = 0;
        foreach ($list as $item) {
            $length += mb_strlen($item);
        }

        return count($list) === 0 ? 0 : ceil($length/count($list));
    }

    private function sortByLength(array &$input, string $sort = self::SORT_LONGEST): void
    {
        if (!in_array($sort, [self::SORT_LONGEST, self::SORT_SHORTEST])) {
            return;
        }

        usort($input, function($a, $b) use ($sort) {
            return $sort === self::SORT_LONGEST ? mb_strlen($a) < mb_strlen($b) : mb_strlen($a) > mb_strlen($b);
        });
    }
}