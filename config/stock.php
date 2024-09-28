<?php

// Return an array of configuration settings
return [
    // Set the URL for the NSE website
    'nse_url' => env('NSE_URL', 'https://nsearchives.nseindia.com/products/content/'),

    // Set the file name for the NSE file
    'nse_file_name' => env('NSE_FILE_NAME', 'sec_bhavdata_full_'),

    // Set the file extension for the NSE file
    'nse_file_ext' => env('NSE_FILE_PATH', '.csv'),    

    // Set the file path for the bhavcopy file
    'bhavcopy_file_path' => env('DOWNLOAD_PATH', 'app/bhavcopies/'),
];