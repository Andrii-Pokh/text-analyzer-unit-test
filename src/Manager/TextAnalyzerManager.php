<?php

namespace App\Manager;

use App\Entity\CalculationText;
use App\Service\TextAnalyzerService;
use DateTimeImmutable;

class TextAnalyzerManager
{
    private TextAnalyzerService $textAnalyzerService;

    public function __construct(TextAnalyzerService $textAnalyzerService)
    {
        $this->textAnalyzerService = $textAnalyzerService;
    }

    public function prepare(CalculationText $input): array
    {
        $datetime = new DateTimeImmutable();

        $this->textAnalyzerService->setText($input);

        $result = [
            'Number of characters' => $this->textAnalyzerService->getCharsNumber(),
            'Number of words' => $this->textAnalyzerService->getWordsNumber(),
            'Number of sentences' => $this->textAnalyzerService->getSentencesNumber(),
            'Frequency of characters' => $this->textAnalyzerService->getCharsFrequency(),
            'Distribution of characters as a percentage of total' => $this->textAnalyzerService->getCharsPercentage(),
            'Average word length' => $this->textAnalyzerService->getAvarageWordLength(),
            'The average number of words in a sentence'
                => $this->textAnalyzerService->getAvarageNumberOfWordsInSentence(),
            'Top 10 most used words' => $this->textAnalyzerService->getTopMostUsedWords(),
            'Top 10 longest words' => $this->textAnalyzerService->getTopLongestWords(),
            'Top 10 shortest words' => $this->textAnalyzerService->getTopShortestWords(7),
            'Top 10 longest sentences' => $this->textAnalyzerService->getTopLongestSentences(7),
            'Top 10 shortest sentences' => $this->textAnalyzerService->getTopShortestSentences(),
            'Number of palindrome words' => $this->textAnalyzerService->getNumberOfPalindromeWords(),
            'Top 10 longest palindrome words' => $this->textAnalyzerService->getTopLongestPalindromeWords(),
            'Is the whole text a palindrome? (Without whitespaces and punctuation marks.)'
                => $this->textAnalyzerService->isWholeTextPalindrome(),
            'Date and time when the report was generated.' => $datetime->format('Y-m-d H:i:s'),
            'The reversed text ' => $this->textAnalyzerService->getReversedText(),
            'The reversed text but the character order in words kept intact'
                => $this->textAnalyzerService->getReversedTextWithIntactWords(),
        ];

        return $result;
    }
}