<?php

namespace App\Tests\Unit;

use App\Entity\CalculationText;
use App\Service\TextAnalyzerService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TextAnalyzerServiceTest extends KernelTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @dataProvider getCharsNumber
     */
    public function testGetCharsNumber($text, $expected)
    {
        $service = $this->createService($text);
        $getCharsNumber = $service->getCharsNumber();

        $this->assertIsArray($getCharsNumber);
        $this->assertEquals($expected, $getCharsNumber);
    }

    /**
     * @dataProvider getWordsNumber
     */
    public function testGetWordsNumber($text, $expected)
    {
        $service = $this->createService($text);
        $getWordsNumber = $service->getWordsNumber();

        $this->assertIsInt($getWordsNumber);
        $this->assertEquals($expected, $getWordsNumber);
    }

    /**
     * @dataProvider getSentencesNumber
     */
    public function testGetSentencesNumber($text, $expected)
    {
        $service = $this->createService($text);
        $getSentencesNumber = $service->getSentencesNumber();

        $this->assertIsInt($getSentencesNumber);
        $this->assertEquals($expected, $getSentencesNumber);
    }

    /**
     * @dataProvider getCharsFrequency
     */
    public function testGetCharsFrequency($text, $expected)
    {
        $service = $this->createService($text);
        $getCharsFrequency = $service->getCharsFrequency();

        $this->assertIsArray($getCharsFrequency);
        $this->assertEquals($expected, $getCharsFrequency);
    }

    /**
     * @dataProvider getCharsPercentage
     */
    public function testGetCharsPercentage($text, $expected)
    {
        $service = $this->createService($text);
        $getCharsPercentage = $service->getCharsPercentage();

        $this->assertIsArray($getCharsPercentage);
        $this->assertEquals($expected, $getCharsPercentage);
    }

    /**
     * @dataProvider getAvarageWordLength
     */
    public function testGetAvarageWordLength($text, $expected)
    {
        $service = $this->createService($text);
        $getAvarageWordLength = $service->getAvarageWordLength();

        $this->assertIsFloat($getAvarageWordLength);
        $this->assertEquals($expected, $getAvarageWordLength);
    }

    /**
     * @dataProvider getAvarageNumberOfWordsInSentence
     */
    public function testGetAvarageNumberOfWordsInSentence($text, $expected)
    {
        $service = $this->createService($text);
        $getAvarageNumberOfWordsInSentence = $service->getAvarageNumberOfWordsInSentence();

        $this->assertIsArray($getAvarageNumberOfWordsInSentence);
        $this->assertEquals($expected, $getAvarageNumberOfWordsInSentence);
    }

    /**
     * @dataProvider getTopMostUsedWords
     */
    public function testGetTopMostUsedWords($text, $expected)
    {
        $service = $this->createService($text);
        $getTopMostUsedWords = $service->getTopMostUsedWords();

        $this->assertIsArray($getTopMostUsedWords);
        $this->assertEquals($expected, $getTopMostUsedWords);
    }

    /**
     * @dataProvider getTopLongestWords
     */
    public function testGetTopLongestWords($text, $expected)
    {
        $service = $this->createService($text);
        $getTopLongestWords = $service->getTopLongestWords();

        $this->assertIsArray($getTopLongestWords);
        $this->assertEquals($expected, $getTopLongestWords);
    }

    /**
     * @dataProvider getTopShortestWords
     */
    public function testGetTopShortestWords($text, $expected)
    {
        $service = $this->createService($text);
        $getTopShortestWords = $service->getTopShortestWords();

        $this->assertIsArray($getTopShortestWords);
        $this->assertEquals($expected, $getTopShortestWords);
    }

    /**
     * @dataProvider getTopLongestSentences
     */
    public function testGetTopLongestSentences($text, $expected)
    {
        $service = $this->createService($text);
        $getTopLongestSentences = $service->getTopLongestSentences();

        $this->assertIsArray($getTopLongestSentences);
        $this->assertEquals($expected, $getTopLongestSentences);
    }

    /**
     * @dataProvider getTopShortestSentences
     */
    public function testGetTopShortestSentences($text, $expected)
    {
        $service = $this->createService($text);
        $getTopShortestSentences = $service->getTopShortestSentences();

        $this->assertIsArray($getTopShortestSentences);
        $this->assertEquals($expected, $getTopShortestSentences);
    }

    /**
     * @dataProvider getNumberOfPalindromeWords
     */
    public function testGetNumberOfPalindromeWords($text, $expected)
    {
        $service = $this->createService($text);
        $getNumberOfPalindromeWords = $service->getNumberOfPalindromeWords();

        $this->assertIsInt($getNumberOfPalindromeWords);
        $this->assertEquals($expected, $getNumberOfPalindromeWords);
    }

    /**
     * @dataProvider getTopLongestPalindromeWords
     */
    public function testGetTopLongestPalindromeWords($text, $expected)
    {
        $service = $this->createService($text);
        $getTopLongestPalindromeWords = $service->getTopLongestPalindromeWords();

        $this->assertIsArray($getTopLongestPalindromeWords);
        $this->assertEquals($expected, $getTopLongestPalindromeWords);
    }

    /**
     * @dataProvider isWholeTextPalindrome
     */
    public function testIsWholeTextPalindrome($text, $expected)
    {
        $service = $this->createService($text);
        $isWholeTextPalindrome = $service->isWholeTextPalindrome();

        $this->assertIsBool($isWholeTextPalindrome);
        $this->assertEquals($expected, $isWholeTextPalindrome);
    }

    /**
     * @dataProvider getReversedText
     */
    public function testGetReversedText($text, $expected)
    {
        $service = $this->createService($text);
        $getReversedText = $service->getReversedText();

        $this->assertIsString($getReversedText);
        $this->assertEquals($expected, $getReversedText);
    }

    /**
     * @dataProvider getReversedTextWithIntactWords
     */
    public function testgetReversedTextWithIntactWords($text, $expected)
    {
        $service = $this->createService($text);
        $getReversedTextWithIntactWords = $service->getReversedTextWithIntactWords();

        $this->assertIsString($getReversedTextWithIntactWords);
        $this->assertEquals($expected, $getReversedTextWithIntactWords);
    }

    private function createService($input): TextAnalyzerService
    {
        $calcText = new CalculationText();
        $calcText->setText($input);

        $service = new TextAnalyzerService();
        $service->setText($calcText);

        return $service;
    }

    private function getCharsNumber(): array
    {
        return [
            [
                'text reversed',
                [
                    'chars' => 12,
                    'with spaces' => 13,
                ],
            ],
            [
                'One sentence. Second sentence.',
                [
                    'chars' => 27,
                    'with spaces' => 30,
                ],
            ],
        ];
    }

    private function getWordsNumber(): array
    {
        return [
            [
                'text reversed',
                2
            ],
            [
                'One sentence. Second sentence.',
                4
            ],
        ];
    }

    private function getSentencesNumber(): array
    {
        return [
            [
                'text reversed',
                1
            ],
            [
                'One sentence. Second sentence.',
                2
            ],
        ];
    }

    private function getCharsFrequency(): array
    {
        return [
            [
                'text reversed',
                [
                    'e' => 4,
                    't' => 2,
                    'r' => 2,
                    'x' => 1,
                    'v' => 1,
                    's' => 1,
                    'd' => 1,
                ],
            ],
            [
                'One sentence. Second sentence.',
                [
                    'e' => 8,
                    'n' => 6,
                    'c' => 3,
                    's' => 2,
                    't' => 2,
                    '.' => 2,
                    'O' => 1,
                    'S' => 1,
                    'o' => 1,
                    'd' => 1,
                ],
            ],
        ];
    }

    private function getCharsPercentage(): array
    {
        return [
            [
                'text reversed',
                [
                    'e' => '33.33 %',
                    't' => '16.67 %',
                    'r' => '16.67 %',
                    'x' => '8.33 %',
                    'v' => '8.33 %',
                    's' => '8.33 %',
                    'd' => '8.33 %',
                ],
            ],
            [
                'One sentence. Second sentence.',
                [
                    'e' => '29.63 %',
                    'n' => '22.22 %',
                    'c' => '11.11 %',
                    's' => '7.41 %',
                    't' => '7.41 %',
                    '.' => '7.41 %',
                    'O' => '3.70 %',
                    'S' => '3.70 %',
                    'o' => '3.70 %',
                    'd' => '3.70 %',
                ],
            ],
        ];
    }

    private function getAvarageWordLength(): array
    {
        return [
            [
                'text reversed',
                6
            ],
            [
                'One sentence. Second sentence.',
                7
            ],
        ];
    }

    private function getAvarageNumberOfWordsInSentence(): array
    {
        return [
            [
                'text reversed',
                [
                    6
                ],
            ],
            [
                'One sentence. Second sentence.',
                [
                    6,
                    8
                ],
            ],
        ];
    }

    private function getTopMostUsedWords(): array
    {
        return [
            [
                'text reversed',
                [
                    'text' => 1,
                    'reversed' => 1
                ],
            ],
            [
                'One sentence. Second sentence.',
                [
                    'sentence' => 2,
                    'One' => 1,
                    'Second' => 1,
                ],
            ],
        ];
    }

    private function getTopLongestWords(): array
    {
        return [
            [
                'text reversed',
                [
                    'reversed',
                    'text',
                ],
            ],
            [
                'One sentence. Second sentence.',
                [
                    'sentence',
                    'Second',
                    'One',
                ],
            ],
        ];
    }

    private function getTopShortestWords(): array
    {
        return [
            [
                'text reversed',
                [
                    'text',
                    'reversed',
                ],
            ],
            [
                'One sentence. Second sentence.',
                [
                    'One',
                    'Second',
                    'sentence',
                ],
            ],
        ];
    }

    private function getTopLongestSentences(): array
    {
        return [
            [
                'text reversed',
                [
                    'text reversed',
                ],
            ],
            [
                'One sentence. Second sentence.',
                [
                    'Second sentence.',
                    'One sentence.',
                ],
            ],
        ];
    }

    private function getTopShortestSentences(): array
    {
        return [
            [
                'text reversed',
                [
                    'text reversed',
                ],
            ],
            [
                'One sentence. Second sentence.',
                [
                    'One sentence.',
                    'Second sentence.',
                ],
            ],
        ];
    }

    private function getNumberOfPalindromeWords(): array
    {
        return [
            [
                'text reversed',
                0
            ],
            [
                'One sentence. Second sentence.',
                0
            ],
            [
                'Eye is eye, racecar is race car.',
                2
            ],
        ];
    }

    private function getTopLongestPalindromeWords(): array
    {
        return [
            [
                'text reversed',
                []
            ],
            [
                'One sentence. Second sentence.',
                []
            ],
            [
                'Eye is eye, racecar is race car.',
                [
                    'racecar',
                    'eye',
                ]
            ],
        ];
    }

    private function isWholeTextPalindrome(): array
    {
        return [
            [
                'text reversed',
                false
            ],
            [
                'One sentence. Second sentence.',
                false
            ],
            [
                'Eye is eye, racecar is race car.',
                false
            ],
            [
                'racecar',
                true
            ],
        ];
    }

    private function getReversedText(): array
    {
        return [
            [
                'text reversed',
                'desrever txet'
            ],
            [
                'One sentence. Second sentence.',
                '.ecnetnes dnoceS .ecnetnes enO'
            ],
            [
                'Eye is eye, racecar is race car.',
                '.rac ecar si racecar ,eye si eyE'
            ],
            [
                'racecar',
                'racecar'
            ],
        ];
    }

    private function getReversedTextWithIntactWords(): array
    {
        return [
            [
                'text reversed',
                'reversed text'
            ],
            [
                'One sentence. Second sentence.',
                '.sentence Second .sentence One'
            ],
            [
                'Eye is eye, racecar is race car.',
                '.car race is racecar ,eye is Eye'
            ],
            [
                'racecar',
                'racecar'
            ],
            [
                'Eye is eye! And racecar is race car...',
                '...car race is racecar And !eye is Eye'
            ],
        ];
    }
}