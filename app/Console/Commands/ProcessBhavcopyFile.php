<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\Bhavcopy;
use App\Models\Symbol;
use App\Services\BhavcopyService;
use Carbon\Carbon;
use League\Csv\Reader;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;


class ProcessBhavcopyFile extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    protected $signature = 'bhavcopy:process {param?}' ;

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';
    protected $description = 'Download and process the bhavcopy file daily';



    protected $bhavcopyService;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(BhavcopyService $bhavcopyService)
    {
        parent::__construct();
        $this->bhavcopyService = $bhavcopyService;
    }


    function downloadFile($url, $localPath)
    {
        // Check if the file already exists
        if (file_exists($localPath)) {
            Log::info("File already exists: $localPath");
            return;
        }

        // Open a file pointer to the URL
        $fp = fopen($url, 'rb');
        if ($fp === false) {
            Log::error("Failed to open URL: $url");
            return;
        }

        // Open a local file for writing
        $localFile = fopen($localPath, 'wb');
        if ($localFile === false) {
            fclose($fp);
            Log::error("Failed to open local file for writing: $localPath");
            return;
        }

        // Write the file from the URL to the local file
        while (!feof($fp)) {
            $chunk = fread($fp, 8192);
            fwrite($localFile, $chunk);
        }

        // Close the file pointers
        fclose($fp);
        fclose($localFile);

        Log::info("File downloaded successfully: $localPath");
    }
    

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $param = $this->argument('param');
        $res = $this->bhavcopyService->fetchNseData($param);
        $this->info($res);
        
        
        // $url = 'https://nsearchives.nseindia.com/products/content/sec_bhavdata_full_16082024.csv';
        // $localPath = 'storage/app/bhavcopies/sec_bhavdata_full_16082024.csv';

        // // Call the function to download the file
        // $this->downloadFile($url, $localPath);
        // $client = new Client();

        // try {
        //     $response = $client->get('https://nsearchives.nseindia.com/products/content/sec_bhavdata_full_16082024.csv', [
        //         'sink' => storage_path('app/bhavcopies/sec_bhavdata_full_16082024.csv'),
        //         'timeout' => 60, // Increase timeout if necessary
        //     ]);
        
        //     if ($response->getStatusCode() == 200) {
        //         Log::info('File downloaded successfully.');
        //     } else {
        //         Log::error('Failed to download file. Status code: ' . $response->getStatusCode());
        //     }
        // } catch (\Exception $e) {
        //     Log::error('Error occurred while downloading the file: ' . $e->getMessage());
        // }


        // $url = 'https://nsearchives.nseindia.com/products/content/sec_bhavdata_full_16082024.csv';
        // $filePath = storage_path('app/bhavcopies/sec_bhavdata_full_16082024.csv');
        
        // $context = stream_context_create([
        //     'http' => [
        //         'method' => 'GET',
        //         'timeout' => 60, // Increase timeout if necessary
        //     ],
        // ]);
        
        // $response = @file_get_contents($url, false, $context);
        
        // if ($response !== false) {
        //     file_put_contents($filePath, $response);
        // } else {
        //     Log::error("Error while downloading file using file_get_contents.");
        // }


        // $url = 'https://nsearchives.nseindia.com/products/content/sec_bhavdata_full_16082024.csv';
        // $context = stream_context_create([
        //     'http' => [
        //         'method' => 'GET',
        //         'timeout' => 60,  // Increase timeout if necessary
        //     ],
        // ]);
        // $response = @file_get_contents($url, false, $context);

        // if ($response !== false) {
        //     $filePath = storage_path('app/bhavcopies/sec_bhavdata_full_16082024.csv');
        //     file_put_contents($filePath, $response);
        // } else {
        //     Log::error("Error while downloading file using file_get_contents.");
        // }

        // $url = 'https://nsearchives.nseindia.com/products/content/sec_bhavdata_full_16082024.csv';
        // $filePath = storage_path('app/bhavcopies/sec_bhavdata_full_16082024.csv');
        // try {
        //     // Check if file already exists
        //     if (!file_exists($filePath)) {
        //         $response = Http::retry(3, 100)->timeout(60)->get($url);

        //         if ($response->successful()) {
        //             file_put_contents($filePath, $response->body());
        //             $this->info('File downloaded successfully.');
                    
        //             // Process file here
        //         } else {
        //             $this->error('Failed to download file. Status code: ' . $response->status());
        //         }
        //     } else {
        //         $this->info('File already exists.');
        //     }
        // } catch (\Illuminate\Http\Client\ConnectionException $e) {
        //     Log::error('Connection error while downloading the file: ' . $e->getMessage());
        //     $this->error('Connection error. Please check the logs for more details.');
        // } catch (\Exception $e) {
        //     Log::error('Error occurred while downloading or processing the file: ' . $e->getMessage());
        //     $this->error('An error occurred. Please check the logs for more details.');
        // }



        // $date = Carbon::now()->format('dmY'); // Current date in dmy format
        // $fileUrl = "https://nsearchives.nseindia.com/products/content/sec_bhavdata_full_{$date}.csv";
        // $fileName = "bhavcopy_{$date}.csv";
        // $filePath = storage_path("app/bhavcopies/{$fileName}");

        // // Check if the file already exists
        // if (Storage::disk('local')->exists("bhavcopies/{$fileName}")) {
        //     $this->info('File already processed.');
        //     return;
        // }

        // // Download the file
        // $response = Http::get($fileUrl);
        
        // if ($response->failed()) {
        //     $this->error('Failed to download the file.');
        //     return;
        // }

        // // Store the file
        // Storage::put("bhavcopies/{$fileName}", $response->body());

        // // Process the CSV file
        // $this->processFile($filePath);
    }

    private function processFile($filePath)
    {
        
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0); // set header offset
        $records = $csv->getRecords(); // get all the records

        foreach ($records as $record) {
            // Prepare the record data
            $data = [
                'symbol_id' => $this->getSymbolId($record['SYMBOL']),
                'series' => $record['SERIES'],
                'date1' => Carbon::parse($record['DATE'])->toDateString(),
                'prev_close' => $record['PREVCLOSE'],
                'open_price' => $record['OPEN'],
                'high_price' => $record['HIGH'],
                'low_price' => $record['LOW'],
                'last_price' => $record['LAST'],
                'close_price' => $record['CLOSE'],
                'avg_price' => $record['AVERAGE'],
                'ttl_trd_qnty' => $record['TTLTRDQTY'],
                'turnover_lacs' => $record['TURNOVER'],
                'no_of_trades' => $record['NOOFTRADES'],
                'deliv_qty' => $record['DELIVERYQTY'],
                'deliv_per' => $record['DELIVERYPERCENT']
            ];

            // Insert or update the data in the database
            Bhavcopy::updateOrCreate(
                ['symbol_id' => $data['symbol_id'], 'date1' => $data['date1']],
                $data
            );
        }

        $this->info('File processed and data inserted into database.');
    }

    private function getSymbolId($symbol)
    {
        // Fetch or create the symbol
        $symbolModel = Symbol::firstOrCreate(['symbol' => $symbol]);

        return $symbolModel->id;
    }
}
