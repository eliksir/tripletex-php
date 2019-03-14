<?php
/**
 * ProductApi
 * PHP version 5
 *
 * @category Class
 * @package  Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Tripletex API
 *
 * The Tripletex API is a **RESTful API**, which does not implement PATCH, but uses a PUT with optional fields.  **Actions** or commands are represented in our RESTful path with a prefixed `:`. Example: `/v2/hours/123/:approve`.  **Summaries** or aggregated results are represented in our RESTful path with a prefixed <code>&gt;</code>. Example: <code>/v2/hours/&gt;thisWeeksBillables</code>.  **\"requestID\"** is a key found in all validation and error responses. If additional log information is absolutely necessary, our support division can locate the key value.  **Download** the [swagger.json](/v2/swagger.json) file [OpenAPI Specification](https://github.com/OAI/OpenAPI-Specification) to [generate code](https://github.com/swagger-api/swagger-codegen). This document was generated from the Swagger JSON file.  **version:** This is a versioning number found on all DB records. If included, it will prevent your PUT/POST from overriding any updates to the record since your GET.  **Date & DateTime** follows the **ISO 8601** standard. Date: `YYYY-MM-DD`. DateTime: `YYYY-MM-DDThh:mm:ssZ`  **Sorting** is done by specifying a comma separated list, where a `-` prefix denotes descending. You can sort by sub object with the following format: `project.name, -date`.  **Searching:** is done by entering values in the optional fields for each API call. The values fall into the following categories: range, in, exact and like.  **Missing fields or even no response data** can occur because result objects and fields are filtered on authorization.  **See [FAQ](https://tripletex.no/execute/docViewer?articleId=906&language=0) for more additional information.**   ## Authentication: - **Tokens:** The Tripletex API uses 3 different tokens - **consumerToken**, **employeeToken** and **sessionToken**.  - **consumerToken** is a token provided to the consumer by Tripletex after the API 2.0 registration is completed.  - **employeeToken** is a token created by an administrator in your Tripletex account via the user settings and the tab \"API access\". Each employee token must be given a set of entitlements. [Read more here.](https://tripletex.no/execute/docViewer?articleId=853&language=0)  - **sessionToken** is the token from `/token/session/:create` which requires a consumerToken and an employeeToken created with the same consumer token, but not an authentication header. See how to create a sessionToken [here](https://tripletex.no/execute/docViewer?articleId=855&language=0). - The session token is used as the password in \"Basic Authentication Header\" for API calls.  - Use blank or `0` as username for accessing the account with regular employee token, or if a company owned employee token accesses <code>/company/&gt;withLoginAccess</code> or <code>/token/session/&gt;whoAmI</code>.  - For company owned employee tokens (accounting offices) the ID from <code>/company/&gt;withLoginAccess</code> can be used as username for accessing client accounts.  - If you need to create the header yourself use <code>Authorization: Basic &lt;base64encode('0:sessionToken')&gt;</code>.   ## Tags: - <div class=\"tag-icon-beta\"></div> **[BETA]** This is a beta endpoint and can be subject to change. - <div class=\"tag-icon-deprecated\"></div> **[DEPRECATED]** Deprecated means that we intend to remove/change this feature or capability in a future \"major\" API release. We therefore discourage all use of this feature/capability.  ## Fields: Use the `fields` parameter to specify which fields should be returned. This also supports fields from sub elements. Example values: - `project,activity,hours`  returns `{project:..., activity:...., hours:...}`. - just `project` returns `\"project\" : { \"id\": 12345, \"url\": \"tripletex.no/v2/projects/12345\"  }`. - `project(*)` returns `\"project\" : { \"id\": 12345 \"name\":\"ProjectName\" \"number.....startDate\": \"2013-01-07\" }`. - `project(name)` returns `\"project\" : { \"name\":\"ProjectName\" }`. - All elements and some subElements :  `*,activity(name),employee(*)`.  ## Changes: To get the changes for a resource, `changes` have to be explicitly specified as part of the `fields` parameter, e.g. `*,changes`. There are currently two types of change available:  - `CREATE` for when the resource was created - `UPDATE` for when the resource was updated  NOTE: For objects created prior to October 24th 2018 the list may be incomplete, but will always contain the CREATE and the last change (if the object has been changed after creation).  ## Rate limiting in each response header: Rate limiting is performed on the API calls for an employee for each API consumer. Status regarding the rate limit is returned as headers: - `X-Rate-Limit-Limit` - The number of allowed requests in the current period. - `X-Rate-Limit-Remaining` - The number of remaining requests. - `X-Rate-Limit-Reset` - The number of seconds left in the current period.  Once the rate limit is hit, all requests will return HTTP status code `429` for the remainder of the current period.   ## Response envelope: ``` {   \"fullResultSize\": ###,   \"from\": ###, // Paging starting from   \"count\": ###, // Paging count   \"versionDigest\": \"Hash of full result\",   \"values\": [...list of objects...] } {   \"value\": {...single object...} } ```   ## WebHook envelope: ``` {   \"subscriptionId\": ###,   \"event\": \"object.verb\", // As listed from /v2/event/   \"id\": ###, // Object id   \"value\": {... single object, null if object.deleted ...} } ```    ## Error/warning envelope: ``` {   \"status\": ###, // HTTP status code   \"code\": #####, // internal status code of event   \"message\": \"Basic feedback message in your language\",   \"link\": \"Link to doc\",   \"developerMessage\": \"More technical message\",   \"validationMessages\": [ // Will be null if Error     {       \"field\": \"Name of field\",       \"message\": \"Validation failure information\"     }   ],   \"requestId\": \"UUID used in any logs\" } ```   ## Status codes / Error codes: - **200 OK** - **201 Created** - From POSTs that create something new. - **204 No Content** - When there is no answer, ex: \"/:anAction\" or DELETE. - **400 Bad request** -   - **4000** Bad Request Exception   - **11000** Illegal Filter Exception   - **12000** Path Param Exception   - **24000**   Cryptography Exception - **401 Unauthorized** - When authentication is required and has failed or has not yet been provided   -  **3000** Authentication Exception   -  **9000** Security Exception - **403 Forbidden** - When AuthorisationManager says no. - **404 Not Found** - For content/IDs that does not exist.   -  **6000** Not Found Exception - **409 Conflict** - Such as an edit conflict between multiple simultaneous updates   -  **7000** Object Exists Exception   -  **8000** Revision Exception   - **10000** Locked Exception   - **14000** Duplicate entry - **422 Bad Request** - For Required fields or things like malformed payload.   - **15000** Value Validation Exception   - **16000** Mapping Exception   - **17000** Sorting Exception   - **18000** Validation Exception   - **21000** Param Exception   - **22000** Invalid JSON Exception   - **23000**   Result Set Too Large Exception - **429 Too Many Requests** - Request rate limit hit - **500 Internal Error** -  Unexpected condition was encountered and no more specific message is suitable   -  **1000** Exception
 *
 * OpenAPI spec version: 2.33.1
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 3.0.5
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Tripletex\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Tripletex\ApiException;
use Tripletex\Configuration;
use Tripletex\HeaderSelector;
use Tripletex\ObjectSerializer;

/**
 * ProductApi Class Doc Comment
 *
 * @category Class
 * @package  Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ProductApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation get
     *
     * Get product by ID.
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Tripletex\Model\ResponseWrapperProduct
     */
    public function get($id, $fields = null)
    {
        list($response) = $this->getWithHttpInfo($id, $fields);
        return $response;
    }

    /**
     * Operation getWithHttpInfo
     *
     * Get product by ID.
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Tripletex\Model\ResponseWrapperProduct, HTTP status code, HTTP response headers (array of strings)
     */
    public function getWithHttpInfo($id, $fields = null)
    {
        $returnType = '\Tripletex\Model\ResponseWrapperProduct';
        $request = $this->getRequest($id, $fields);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Tripletex\Model\ResponseWrapperProduct',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAsync
     *
     * Get product by ID.
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAsync($id, $fields = null)
    {
        return $this->getAsyncWithHttpInfo($id, $fields)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAsyncWithHttpInfo
     *
     * Get product by ID.
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAsyncWithHttpInfo($id, $fields = null)
    {
        $returnType = '\Tripletex\Model\ResponseWrapperProduct';
        $request = $this->getRequest($id, $fields);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'get'
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getRequest($id, $fields = null)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling get'
            );
        }

        $resourcePath = '/product/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($fields !== null) {
            $queryParams['fields'] = ObjectSerializer::toQueryValue($fields);
        }

        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation post
     *
     * Create new product.
     *
     * @param  \Tripletex\Model\Product $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Tripletex\Model\ResponseWrapperProduct
     */
    public function post($body = null)
    {
        list($response) = $this->postWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation postWithHttpInfo
     *
     * Create new product.
     *
     * @param  \Tripletex\Model\Product $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Tripletex\Model\ResponseWrapperProduct, HTTP status code, HTTP response headers (array of strings)
     */
    public function postWithHttpInfo($body = null)
    {
        $returnType = '\Tripletex\Model\ResponseWrapperProduct';
        $request = $this->postRequest($body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Tripletex\Model\ResponseWrapperProduct',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation postAsync
     *
     * Create new product.
     *
     * @param  \Tripletex\Model\Product $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function postAsync($body = null)
    {
        return $this->postAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation postAsyncWithHttpInfo
     *
     * Create new product.
     *
     * @param  \Tripletex\Model\Product $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function postAsyncWithHttpInfo($body = null)
    {
        $returnType = '\Tripletex\Model\ResponseWrapperProduct';
        $request = $this->postRequest($body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'post'
     *
     * @param  \Tripletex\Model\Product $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function postRequest($body = null)
    {

        $resourcePath = '/product';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
                ['application/json; charset=utf-8']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation put
     *
     * Update product.
     *
     * @param  int $id Element ID (required)
     * @param  \Tripletex\Model\Product $body Partial object describing what should be updated (optional)
     *
     * @throws \Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Tripletex\Model\ResponseWrapperProduct
     */
    public function put($id, $body = null)
    {
        list($response) = $this->putWithHttpInfo($id, $body);
        return $response;
    }

    /**
     * Operation putWithHttpInfo
     *
     * Update product.
     *
     * @param  int $id Element ID (required)
     * @param  \Tripletex\Model\Product $body Partial object describing what should be updated (optional)
     *
     * @throws \Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Tripletex\Model\ResponseWrapperProduct, HTTP status code, HTTP response headers (array of strings)
     */
    public function putWithHttpInfo($id, $body = null)
    {
        $returnType = '\Tripletex\Model\ResponseWrapperProduct';
        $request = $this->putRequest($id, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Tripletex\Model\ResponseWrapperProduct',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation putAsync
     *
     * Update product.
     *
     * @param  int $id Element ID (required)
     * @param  \Tripletex\Model\Product $body Partial object describing what should be updated (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function putAsync($id, $body = null)
    {
        return $this->putAsyncWithHttpInfo($id, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation putAsyncWithHttpInfo
     *
     * Update product.
     *
     * @param  int $id Element ID (required)
     * @param  \Tripletex\Model\Product $body Partial object describing what should be updated (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function putAsyncWithHttpInfo($id, $body = null)
    {
        $returnType = '\Tripletex\Model\ResponseWrapperProduct';
        $request = $this->putRequest($id, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'put'
     *
     * @param  int $id Element ID (required)
     * @param  \Tripletex\Model\Product $body Partial object describing what should be updated (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function putRequest($id, $body = null)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling put'
            );
        }

        $resourcePath = '/product/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
                ['application/json; charset=utf-8']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation search
     *
     * Find products corresponding with sent data.
     *
     * @param  string $number DEPRECATED. List of product numbers (Integer only) (optional)
     * @param  string[] $product_number List of valid product numbers (optional)
     * @param  string $name Containing (optional)
     * @param  bool $is_inactive Equals (optional)
     * @param  bool $is_stock_item Equals (optional)
     * @param  string $currency_id Equals (optional)
     * @param  string $vat_type_id Equals (optional)
     * @param  string $product_unit_id Equals (optional)
     * @param  string $department_id Equals (optional)
     * @param  string $account_id Equals (optional)
     * @param  float $cost_excluding_vat_currency_from From and including (optional)
     * @param  float $cost_excluding_vat_currency_to To and excluding (optional)
     * @param  float $price_excluding_vat_currency_from From and including (optional)
     * @param  float $price_excluding_vat_currency_to To and excluding (optional)
     * @param  float $price_including_vat_currency_from From and including (optional)
     * @param  float $price_including_vat_currency_to To and excluding (optional)
     * @param  int $from From index (optional)
     * @param  int $count Number of elements to return (optional)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Tripletex\Model\ListResponseProduct
     */
    public function search($number = null, $product_number = null, $name = null, $is_inactive = null, $is_stock_item = null, $currency_id = null, $vat_type_id = null, $product_unit_id = null, $department_id = null, $account_id = null, $cost_excluding_vat_currency_from = null, $cost_excluding_vat_currency_to = null, $price_excluding_vat_currency_from = null, $price_excluding_vat_currency_to = null, $price_including_vat_currency_from = null, $price_including_vat_currency_to = null, $from = null, $count = null, $sorting = null, $fields = null)
    {
        list($response) = $this->searchWithHttpInfo($number, $product_number, $name, $is_inactive, $is_stock_item, $currency_id, $vat_type_id, $product_unit_id, $department_id, $account_id, $cost_excluding_vat_currency_from, $cost_excluding_vat_currency_to, $price_excluding_vat_currency_from, $price_excluding_vat_currency_to, $price_including_vat_currency_from, $price_including_vat_currency_to, $from, $count, $sorting, $fields);
        return $response;
    }

    /**
     * Operation searchWithHttpInfo
     *
     * Find products corresponding with sent data.
     *
     * @param  string $number DEPRECATED. List of product numbers (Integer only) (optional)
     * @param  string[] $product_number List of valid product numbers (optional)
     * @param  string $name Containing (optional)
     * @param  bool $is_inactive Equals (optional)
     * @param  bool $is_stock_item Equals (optional)
     * @param  string $currency_id Equals (optional)
     * @param  string $vat_type_id Equals (optional)
     * @param  string $product_unit_id Equals (optional)
     * @param  string $department_id Equals (optional)
     * @param  string $account_id Equals (optional)
     * @param  float $cost_excluding_vat_currency_from From and including (optional)
     * @param  float $cost_excluding_vat_currency_to To and excluding (optional)
     * @param  float $price_excluding_vat_currency_from From and including (optional)
     * @param  float $price_excluding_vat_currency_to To and excluding (optional)
     * @param  float $price_including_vat_currency_from From and including (optional)
     * @param  float $price_including_vat_currency_to To and excluding (optional)
     * @param  int $from From index (optional)
     * @param  int $count Number of elements to return (optional)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Tripletex\Model\ListResponseProduct, HTTP status code, HTTP response headers (array of strings)
     */
    public function searchWithHttpInfo($number = null, $product_number = null, $name = null, $is_inactive = null, $is_stock_item = null, $currency_id = null, $vat_type_id = null, $product_unit_id = null, $department_id = null, $account_id = null, $cost_excluding_vat_currency_from = null, $cost_excluding_vat_currency_to = null, $price_excluding_vat_currency_from = null, $price_excluding_vat_currency_to = null, $price_including_vat_currency_from = null, $price_including_vat_currency_to = null, $from = null, $count = null, $sorting = null, $fields = null)
    {
        $returnType = '\Tripletex\Model\ListResponseProduct';
        $request = $this->searchRequest($number, $product_number, $name, $is_inactive, $is_stock_item, $currency_id, $vat_type_id, $product_unit_id, $department_id, $account_id, $cost_excluding_vat_currency_from, $cost_excluding_vat_currency_to, $price_excluding_vat_currency_from, $price_excluding_vat_currency_to, $price_including_vat_currency_from, $price_including_vat_currency_to, $from, $count, $sorting, $fields);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Tripletex\Model\ListResponseProduct',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation searchAsync
     *
     * Find products corresponding with sent data.
     *
     * @param  string $number DEPRECATED. List of product numbers (Integer only) (optional)
     * @param  string[] $product_number List of valid product numbers (optional)
     * @param  string $name Containing (optional)
     * @param  bool $is_inactive Equals (optional)
     * @param  bool $is_stock_item Equals (optional)
     * @param  string $currency_id Equals (optional)
     * @param  string $vat_type_id Equals (optional)
     * @param  string $product_unit_id Equals (optional)
     * @param  string $department_id Equals (optional)
     * @param  string $account_id Equals (optional)
     * @param  float $cost_excluding_vat_currency_from From and including (optional)
     * @param  float $cost_excluding_vat_currency_to To and excluding (optional)
     * @param  float $price_excluding_vat_currency_from From and including (optional)
     * @param  float $price_excluding_vat_currency_to To and excluding (optional)
     * @param  float $price_including_vat_currency_from From and including (optional)
     * @param  float $price_including_vat_currency_to To and excluding (optional)
     * @param  int $from From index (optional)
     * @param  int $count Number of elements to return (optional)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function searchAsync($number = null, $product_number = null, $name = null, $is_inactive = null, $is_stock_item = null, $currency_id = null, $vat_type_id = null, $product_unit_id = null, $department_id = null, $account_id = null, $cost_excluding_vat_currency_from = null, $cost_excluding_vat_currency_to = null, $price_excluding_vat_currency_from = null, $price_excluding_vat_currency_to = null, $price_including_vat_currency_from = null, $price_including_vat_currency_to = null, $from = null, $count = null, $sorting = null, $fields = null)
    {
        return $this->searchAsyncWithHttpInfo($number, $product_number, $name, $is_inactive, $is_stock_item, $currency_id, $vat_type_id, $product_unit_id, $department_id, $account_id, $cost_excluding_vat_currency_from, $cost_excluding_vat_currency_to, $price_excluding_vat_currency_from, $price_excluding_vat_currency_to, $price_including_vat_currency_from, $price_including_vat_currency_to, $from, $count, $sorting, $fields)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation searchAsyncWithHttpInfo
     *
     * Find products corresponding with sent data.
     *
     * @param  string $number DEPRECATED. List of product numbers (Integer only) (optional)
     * @param  string[] $product_number List of valid product numbers (optional)
     * @param  string $name Containing (optional)
     * @param  bool $is_inactive Equals (optional)
     * @param  bool $is_stock_item Equals (optional)
     * @param  string $currency_id Equals (optional)
     * @param  string $vat_type_id Equals (optional)
     * @param  string $product_unit_id Equals (optional)
     * @param  string $department_id Equals (optional)
     * @param  string $account_id Equals (optional)
     * @param  float $cost_excluding_vat_currency_from From and including (optional)
     * @param  float $cost_excluding_vat_currency_to To and excluding (optional)
     * @param  float $price_excluding_vat_currency_from From and including (optional)
     * @param  float $price_excluding_vat_currency_to To and excluding (optional)
     * @param  float $price_including_vat_currency_from From and including (optional)
     * @param  float $price_including_vat_currency_to To and excluding (optional)
     * @param  int $from From index (optional)
     * @param  int $count Number of elements to return (optional)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function searchAsyncWithHttpInfo($number = null, $product_number = null, $name = null, $is_inactive = null, $is_stock_item = null, $currency_id = null, $vat_type_id = null, $product_unit_id = null, $department_id = null, $account_id = null, $cost_excluding_vat_currency_from = null, $cost_excluding_vat_currency_to = null, $price_excluding_vat_currency_from = null, $price_excluding_vat_currency_to = null, $price_including_vat_currency_from = null, $price_including_vat_currency_to = null, $from = null, $count = null, $sorting = null, $fields = null)
    {
        $returnType = '\Tripletex\Model\ListResponseProduct';
        $request = $this->searchRequest($number, $product_number, $name, $is_inactive, $is_stock_item, $currency_id, $vat_type_id, $product_unit_id, $department_id, $account_id, $cost_excluding_vat_currency_from, $cost_excluding_vat_currency_to, $price_excluding_vat_currency_from, $price_excluding_vat_currency_to, $price_including_vat_currency_from, $price_including_vat_currency_to, $from, $count, $sorting, $fields);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'search'
     *
     * @param  string $number DEPRECATED. List of product numbers (Integer only) (optional)
     * @param  string[] $product_number List of valid product numbers (optional)
     * @param  string $name Containing (optional)
     * @param  bool $is_inactive Equals (optional)
     * @param  bool $is_stock_item Equals (optional)
     * @param  string $currency_id Equals (optional)
     * @param  string $vat_type_id Equals (optional)
     * @param  string $product_unit_id Equals (optional)
     * @param  string $department_id Equals (optional)
     * @param  string $account_id Equals (optional)
     * @param  float $cost_excluding_vat_currency_from From and including (optional)
     * @param  float $cost_excluding_vat_currency_to To and excluding (optional)
     * @param  float $price_excluding_vat_currency_from From and including (optional)
     * @param  float $price_excluding_vat_currency_to To and excluding (optional)
     * @param  float $price_including_vat_currency_from From and including (optional)
     * @param  float $price_including_vat_currency_to To and excluding (optional)
     * @param  int $from From index (optional)
     * @param  int $count Number of elements to return (optional)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function searchRequest($number = null, $product_number = null, $name = null, $is_inactive = null, $is_stock_item = null, $currency_id = null, $vat_type_id = null, $product_unit_id = null, $department_id = null, $account_id = null, $cost_excluding_vat_currency_from = null, $cost_excluding_vat_currency_to = null, $price_excluding_vat_currency_from = null, $price_excluding_vat_currency_to = null, $price_including_vat_currency_from = null, $price_including_vat_currency_to = null, $from = null, $count = null, $sorting = null, $fields = null)
    {

        $resourcePath = '/product';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($number !== null) {
            $queryParams['number'] = ObjectSerializer::toQueryValue($number);
        }
        // query params
        if (is_array($product_number)) {
            $product_number = ObjectSerializer::serializeCollection($product_number, 'csv', true);
        }
        if ($product_number !== null) {
            $queryParams['productNumber'] = ObjectSerializer::toQueryValue($product_number);
        }
        // query params
        if ($name !== null) {
            $queryParams['name'] = ObjectSerializer::toQueryValue($name);
        }
        // query params
        if ($is_inactive !== null) {
            $queryParams['isInactive'] = ObjectSerializer::toQueryValue($is_inactive);
        }
        // query params
        if ($is_stock_item !== null) {
            $queryParams['isStockItem'] = ObjectSerializer::toQueryValue($is_stock_item);
        }
        // query params
        if ($currency_id !== null) {
            $queryParams['currencyId'] = ObjectSerializer::toQueryValue($currency_id);
        }
        // query params
        if ($vat_type_id !== null) {
            $queryParams['vatTypeId'] = ObjectSerializer::toQueryValue($vat_type_id);
        }
        // query params
        if ($product_unit_id !== null) {
            $queryParams['productUnitId'] = ObjectSerializer::toQueryValue($product_unit_id);
        }
        // query params
        if ($department_id !== null) {
            $queryParams['departmentId'] = ObjectSerializer::toQueryValue($department_id);
        }
        // query params
        if ($account_id !== null) {
            $queryParams['accountId'] = ObjectSerializer::toQueryValue($account_id);
        }
        // query params
        if ($cost_excluding_vat_currency_from !== null) {
            $queryParams['costExcludingVatCurrencyFrom'] = ObjectSerializer::toQueryValue($cost_excluding_vat_currency_from);
        }
        // query params
        if ($cost_excluding_vat_currency_to !== null) {
            $queryParams['costExcludingVatCurrencyTo'] = ObjectSerializer::toQueryValue($cost_excluding_vat_currency_to);
        }
        // query params
        if ($price_excluding_vat_currency_from !== null) {
            $queryParams['priceExcludingVatCurrencyFrom'] = ObjectSerializer::toQueryValue($price_excluding_vat_currency_from);
        }
        // query params
        if ($price_excluding_vat_currency_to !== null) {
            $queryParams['priceExcludingVatCurrencyTo'] = ObjectSerializer::toQueryValue($price_excluding_vat_currency_to);
        }
        // query params
        if ($price_including_vat_currency_from !== null) {
            $queryParams['priceIncludingVatCurrencyFrom'] = ObjectSerializer::toQueryValue($price_including_vat_currency_from);
        }
        // query params
        if ($price_including_vat_currency_to !== null) {
            $queryParams['priceIncludingVatCurrencyTo'] = ObjectSerializer::toQueryValue($price_including_vat_currency_to);
        }
        // query params
        if ($from !== null) {
            $queryParams['from'] = ObjectSerializer::toQueryValue($from);
        }
        // query params
        if ($count !== null) {
            $queryParams['count'] = ObjectSerializer::toQueryValue($count);
        }
        // query params
        if ($sorting !== null) {
            $queryParams['sorting'] = ObjectSerializer::toQueryValue($sorting);
        }
        // query params
        if ($fields !== null) {
            $queryParams['fields'] = ObjectSerializer::toQueryValue($fields);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
