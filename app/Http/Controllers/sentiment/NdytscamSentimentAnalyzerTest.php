<?php

namespace App\Http\Controllers\sentiment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\sentiment\NdytscamSentimentAnalyzer;

class NdytscamSentimentAnalyzerTest extends Controller
{
    protected $sentimentAnalyzer;
	public function __construct(NdytscamSentimentAnalyzer $sentimentAnalyzer)
	{
		$this->sentimentAnalyzer = $sentimentAnalyzer;
	}

	public function trainAnalyzer($testDataLocation, $testDataType, $testDataAmount)
	{
		return $this->sentimentAnalyzer->insertTestData($testDataLocation, $testDataType, $testDataAmount);
	}

	public function analyzeSentence($sentence)
	{
		return $this->sentimentAnalyzer->analyzeSentence($sentence);
	}

	public function analyzeDocument($document)
	{
		return $this->sentimentAnalyzer->analyzeDocument($document);
	}
}
