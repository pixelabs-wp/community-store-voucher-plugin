<?php

class CSVP_DataFilter
{
    public function filterData($data, $filters)
    {
        // Initialize an empty array to store filtered results
        $filteredData = [];

        // Loop through each item in the data array
        foreach ($data as $item) {
            $matchesAllFilters = true;

            // Check if the item matches all filter conditions
            foreach ($filters as $key => $value) {
                // Check if the item has the specified key
                if (isset($item[$key])) {
                    // Convert both the field value and filter value to lowercase or uppercase
                    $fieldValue = strtolower($item[$key]);
                    $filterValue = strtolower($value);

                    // Check if both the field value and filter value are non-empty before using strpos
                    if ($fieldValue !== '' && $filterValue !== '' && strpos($fieldValue, $filterValue) !== false) {
                        continue;
                    }
                }

                // If the item doesn't match a filter condition, set the flag to false
                $matchesAllFilters = false;
                break;
            }

            // If the item matches all filter conditions, add it to the filtered data
            if ($matchesAllFilters) {
                $filteredData[] = $item;
            }
        }

        return $filteredData;
    }
}