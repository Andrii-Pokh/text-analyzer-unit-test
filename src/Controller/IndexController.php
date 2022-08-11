<?php

namespace App\Controller;

use App\Entity\CalculationText;
use App\Form\Type\CalculationTextType;
use App\Manager\TextAnalyzerManager;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/text", name="text", methods={"GET", "POST"})
     * @throws Exception
     */
    public function analyzeText(Request $request, TextAnalyzerManager $textAnalyzer): Response
    {
        $startTime = microtime(true);

        $calculationText = new CalculationText();
        $form = $this->createForm(CalculationTextType::class, $calculationText);
        $form->handleRequest($request);

        $results = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $calculationText = $form->getData();
            $results = $textAnalyzer->prepare($calculationText);

            $endTime = microtime(true);
            $results['time'] = ($endTime - $startTime) * 1000;
        }

        return $this->renderForm('text/new.html.twig', [
            'form' => $form,
            'results' => $results
        ]);
    }
}