# Tripletex\TimesheetweekApi

All URIs are relative to *//tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**approve**](TimesheetweekApi.md#approve) | **PUT** /timesheet/week/:approve | Approve week. By ID or (ISO-8601 week and employeeId combination).
[**complete**](TimesheetweekApi.md#complete) | **PUT** /timesheet/week/:complete | Complete week. By ID or (ISO-8601 week and employeeId combination).
[**reopen**](TimesheetweekApi.md#reopen) | **PUT** /timesheet/week/:reopen | Reopen week. By ID or (ISO-8601 week and employeeId combination).
[**search**](TimesheetweekApi.md#search) | **GET** /timesheet/week | Find weekly status By ID, week/year combination, employeeId. or an approver
[**unapprove**](TimesheetweekApi.md#unapprove) | **PUT** /timesheet/week/:unapprove | Unapprove week. By ID or (ISO-8601 week and employeeId combination).

# **approve**
> \Tripletex\Model\ResponseWrapperWeek approve($id, $employee_id, $week_year)

Approve week. By ID or (ISO-8601 week and employeeId combination).

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Tripletex\Api\TimesheetweekApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Equals
$employee_id = 56; // int | Equals
$week_year = "week_year_example"; // string | ISO-8601 week-year

try {
    $result = $apiInstance->approve($id, $employee_id, $week_year);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TimesheetweekApi->approve: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | [**int**](../Model/.md)| Equals | [optional]
 **employee_id** | [**int**](../Model/.md)| Equals | [optional]
 **week_year** | [**string**](../Model/.md)| ISO-8601 week-year | [optional]

### Return type

[**\Tripletex\Model\ResponseWrapperWeek**](../Model/ResponseWrapperWeek.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **complete**
> \Tripletex\Model\ResponseWrapperWeek complete($id, $employee_id, $week_year)

Complete week. By ID or (ISO-8601 week and employeeId combination).

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Tripletex\Api\TimesheetweekApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Equals
$employee_id = 56; // int | Equals
$week_year = "week_year_example"; // string | ISO-8601 week-year

try {
    $result = $apiInstance->complete($id, $employee_id, $week_year);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TimesheetweekApi->complete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | [**int**](../Model/.md)| Equals | [optional]
 **employee_id** | [**int**](../Model/.md)| Equals | [optional]
 **week_year** | [**string**](../Model/.md)| ISO-8601 week-year | [optional]

### Return type

[**\Tripletex\Model\ResponseWrapperWeek**](../Model/ResponseWrapperWeek.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **reopen**
> \Tripletex\Model\ResponseWrapperWeek reopen($id, $employee_id, $week_year)

Reopen week. By ID or (ISO-8601 week and employeeId combination).

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Tripletex\Api\TimesheetweekApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Equals
$employee_id = 56; // int | Equals
$week_year = "week_year_example"; // string | ISO-8601 week-year

try {
    $result = $apiInstance->reopen($id, $employee_id, $week_year);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TimesheetweekApi->reopen: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | [**int**](../Model/.md)| Equals | [optional]
 **employee_id** | [**int**](../Model/.md)| Equals | [optional]
 **week_year** | [**string**](../Model/.md)| ISO-8601 week-year | [optional]

### Return type

[**\Tripletex\Model\ResponseWrapperWeek**](../Model/ResponseWrapperWeek.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **search**
> \Tripletex\Model\ListResponseWeek search($ids, $employee_ids, $week_year, $approved_by, $from, $count, $sorting, $fields)

Find weekly status By ID, week/year combination, employeeId. or an approver

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Tripletex\Api\TimesheetweekApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ids = "ids_example"; // string | List of IDs
$employee_ids = "employee_ids_example"; // string | List of IDs
$week_year = "week_year_example"; // string | ISO-8601 week-year
$approved_by = 56; // int | Equals
$from = 56; // int | From index
$count = 56; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->search($ids, $employee_ids, $week_year, $approved_by, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TimesheetweekApi->search: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ids** | [**string**](../Model/.md)| List of IDs | [optional]
 **employee_ids** | [**string**](../Model/.md)| List of IDs | [optional]
 **week_year** | [**string**](../Model/.md)| ISO-8601 week-year | [optional]
 **approved_by** | [**int**](../Model/.md)| Equals | [optional]
 **from** | [**int**](../Model/.md)| From index | [optional]
 **count** | [**int**](../Model/.md)| Number of elements to return | [optional]
 **sorting** | [**string**](../Model/.md)| Sorting pattern | [optional]
 **fields** | [**string**](../Model/.md)| Fields filter pattern | [optional]

### Return type

[**\Tripletex\Model\ListResponseWeek**](../Model/ListResponseWeek.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **unapprove**
> \Tripletex\Model\ResponseWrapperWeek unapprove($id, $employee_id, $week_year)

Unapprove week. By ID or (ISO-8601 week and employeeId combination).

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Tripletex\Api\TimesheetweekApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Equals
$employee_id = 56; // int | Equals
$week_year = "week_year_example"; // string | ISO-8601 week-year

try {
    $result = $apiInstance->unapprove($id, $employee_id, $week_year);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TimesheetweekApi->unapprove: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | [**int**](../Model/.md)| Equals | [optional]
 **employee_id** | [**int**](../Model/.md)| Equals | [optional]
 **week_year** | [**string**](../Model/.md)| ISO-8601 week-year | [optional]

### Return type

[**\Tripletex\Model\ResponseWrapperWeek**](../Model/ResponseWrapperWeek.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)
