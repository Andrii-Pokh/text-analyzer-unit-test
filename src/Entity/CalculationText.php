<?php

namespace App\Entity;

class CalculationText
{
    protected $text;

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
}