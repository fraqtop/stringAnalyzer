<?php

namespace App\Controllers;


use App\Interfaces\IStringHandler;
use Psr\Http\Message\RequestInterface as Request;

/**
 *Strategy design pattern used here for easy replacement of processing algorithm.
 */

class StringProcessingController extends Controller
{
    /**
     * @var IStringHandler
     */
    private $stringHandler;

    public function __construct(IStringHandler $handler)
    {
        parent::__construct();
        $this->stringHandler = $handler;
    }

    public function getIndexPage()
    {
        return $this->templateEngine->render('index.twig', [
            'submit_label' => $this->stringHandler->getSubmitLabel()
        ]);
    }

    public function process(Request $request)
    {
        $postParams = $request->getParsedBody();
        return $this->stringHandler->process($postParams['string']);
    }

    public function test()
    {
        return 'test passed';
    }
}