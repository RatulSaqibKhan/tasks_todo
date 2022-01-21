<?php

define("SUCCESS_MSG", "Success!");
define("ERROR_MSG", "Something went wrong!");
define("DATA_FETCHED_SUCCESS_MSG", "Data fetched successfully!");
define("SAVE_SUCCESS_MSG", "Data saved successfully!");
define("SAVE_FAILED_MSG", "Data saving failed!");
define("UPDATE_SUCCESS_MSG", "Data updated successfully!");
define("UPDATE_FAILED_MSG", "Data updating failed!");
define("DELETE_SUCCESS_MSG", "Data deleted successfully!");
define("DELETE_FAILED_MSG", "Data deleting failed!");

define('ACTIVE', 1);
define('INACTIVE', 0);

define('ACTIVE_STATUS_OPTIONS', [
    0 => 'Inactive',
    1 => 'Active',
]);

define('DAY_BASIS', 1);
define('HOUR_BASIS', 2);
define('MNUTE_BASIS', 3);

define('TASK_COMPLETION_BASIS', [
    '1' => 'Day',
    '2' => 'Hour',
    '3' => 'Minute',
]);