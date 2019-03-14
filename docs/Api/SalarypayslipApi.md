# Tripletex\SalarypayslipApi

All URIs are relative to *//tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**downloadPdf**](SalarypayslipApi.md#downloadPdf) | **GET** /salary/payslip/{id}/pdf | [BETA] Find payslip (PDF document) by ID.
[**get**](SalarypayslipApi.md#get) | **GET** /salary/payslip/{id} | [BETA] Find payslip by ID.
[**search**](SalarypayslipApi.md#search) | **GET** /salary/payslip | [BETA] Find payslips corresponding with sent data.

# **downloadPdf**
> string downloadPdf($id)

[BETA] Find payslip (PDF document) by ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Tripletex\Api\SalarypayslipApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID

try {
    $result = $apiInstance->downloadPdf($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalarypayslipApi->downloadPdf: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | [**int**](../Model/.md)| Element ID |

### Return type

**string**

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/octet-stream

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **get**
> \Tripletex\Model\ResponseWrapperPayslip get($id, $fields)

[BETA] Find payslip by ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Tripletex\Api\SalarypayslipApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->get($id, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalarypayslipApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | [**int**](../Model/.md)| Element ID |
 **fields** | [**string**](../Model/.md)| Fields filter pattern | [optional]

### Return type

[**\Tripletex\Model\ResponseWrapperPayslip**](../Model/ResponseWrapperPayslip.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **search**
> \Tripletex\Model\ListResponsePayslip search($id, $employee_id, $wage_transaction_id, $activity_id, $year_from, $year_to, $month_from, $month_to, $voucher_date_from, $voucher_date_to, $comment, $from, $count, $sorting, $fields)

[BETA] Find payslips corresponding with sent data.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Tripletex\Api\SalarypayslipApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | List of IDs
$employee_id = "employee_id_example"; // string | List of IDs
$wage_transaction_id = "wage_transaction_id_example"; // string | List of IDs
$activity_id = "activity_id_example"; // string | List of IDs
$year_from = 56; // int | From and including
$year_to = 56; // int | To and excluding
$month_from = 56; // int | From and including
$month_to = 56; // int | To and excluding
$voucher_date_from = "voucher_date_from_example"; // string | From and including
$voucher_date_to = "voucher_date_to_example"; // string | To and excluding
$comment = "comment_example"; // string | Containing
$from = 56; // int | From index
$count = 56; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->search($id, $employee_id, $wage_transaction_id, $activity_id, $year_from, $year_to, $month_from, $month_to, $voucher_date_from, $voucher_date_to, $comment, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalarypayslipApi->search: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | [**string**](../Model/.md)| List of IDs | [optional]
 **employee_id** | [**string**](../Model/.md)| List of IDs | [optional]
 **wage_transaction_id** | [**string**](../Model/.md)| List of IDs | [optional]
 **activity_id** | [**string**](../Model/.md)| List of IDs | [optional]
 **year_from** | [**int**](../Model/.md)| From and including | [optional]
 **year_to** | [**int**](../Model/.md)| To and excluding | [optional]
 **month_from** | [**int**](../Model/.md)| From and including | [optional]
 **month_to** | [**int**](../Model/.md)| To and excluding | [optional]
 **voucher_date_from** | [**string**](../Model/.md)| From and including | [optional]
 **voucher_date_to** | [**string**](../Model/.md)| To and excluding | [optional]
 **comment** | [**string**](../Model/.md)| Containing | [optional]
 **from** | [**int**](../Model/.md)| From index | [optional]
 **count** | [**int**](../Model/.md)| Number of elements to return | [optional]
 **sorting** | [**string**](../Model/.md)| Sorting pattern | [optional]
 **fields** | [**string**](../Model/.md)| Fields filter pattern | [optional]

### Return type

[**\Tripletex\Model\ListResponsePayslip**](../Model/ListResponsePayslip.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

