<?php

namespace App\Traits;

use Carbon\Carbon;

trait DateHelperTrait
{
    /**
     * Convert a date string to yyyy-mm-dd format.
     *
     * @param string $dateString
     * @return string
     */
    public function convertToDate($dateString, $formatType = 'Y-m-d')
    {

    //    echo  '-'.$dateString;
//         echo $formatType;
        try {
            // Check if the date is in ddmmyyyy format (e.g., 24082024)
            if (preg_match('/^\d{8}$/', $dateString)) {
                // Parse the date from ddmmyyyy to yyyy-mm-dd
                $date = Carbon::createFromFormat('dmY', $dateString);
                //  echo $date->format($formatType);
                 
            } 
            // Check if the date is in dd-MMM-yyyy format (e.g., 24-Aug-2024)
            elseif (preg_match('/^\d{2}-[A-Za-z]{3}-\d{4}$/', $dateString)) {
                // Parse the date from dd-MMM-yyyy to yyyy-mm-dd
                
                $date = Carbon::createFromFormat('d-M-Y', $dateString);
                // echo $date->format($formatType);die;
                
            } 
            // If the date is not in a recognized format, throw an exception
            else {
                throw new \Exception(__('messages.invalid_date_with_sample'));
            }
            
            // Return the date in yyyy-mm-dd format
           
            return $date->format($formatType);

        } catch (\Exception $e) {
            // Handle exception or error
            throw new \Exception(__('messages.invalid_date'));
        }
    }
}
