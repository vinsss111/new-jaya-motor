<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var \CodeIgniter\HTTP\CLIRequest|\CodeIgniter\HTTP\IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon class instantiation.
     *
     * @var array
     */
    protected $helpers = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do not edit this line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc. here.
        // E.g.: $this->session = \Config\Services::session();
    }
}
