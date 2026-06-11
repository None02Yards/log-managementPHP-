<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\LogModel;

class HomeController extends Controller
{
    public function index()
    {
        $logModel = new LogModel();

        // return $this->view('home', [
        //     'stats' => $logModel->getStatistics()
        // ]);

         return $this->view('home', [
            'stats' => $logModel->getStatistics(),
            'page_title' => 'Centralized Log Management'
        ], false); // 👈 IMPORTANT: disable layout
    }
}