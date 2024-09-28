<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BhavcopyService;


class BhavcopyController extends Controller
{
    protected $bhavcopyService;

    public function __construct(BhavcopyService $bhavcopyService)
    {
        $this->bhavcopyService = $bhavcopyService;
    }

    public function index() {
        
        $isFileDownloaded  = $this->bhavcopyService->fetchNSEData('30082024');
        //error 10082024  03082024  17082024
        // dd($isFileDownloaded);
        if($isFileDownloaded['status']) {
            $insertStatus = $this->bhavcopyService->processNseBhavcopy($isFileDownloaded);
            return inertia('Index/Index',['message' => 'Data fetched and stored successfully']);
    
        } else {
            return inertia('Index/Index',['message' => $isFileDownloaded['message']]);            
        }

    }
}
