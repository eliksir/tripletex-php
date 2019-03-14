<?php
/**
 * ProjectInvoiceDetails
 *
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

namespace Tripletex\Model;

use \ArrayAccess;
use \Tripletex\ObjectSerializer;

/**
 * ProjectInvoiceDetails Class Doc Comment
 *
 * @category Class
 * @package  Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ProjectInvoiceDetails implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'ProjectInvoiceDetails';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'int',
'version' => 'int',
'changes' => '\Tripletex\Model\Change[]',
'url' => 'string',
'project' => '\Tripletex\Model\Project',
'fee_amount' => 'BigDecimal',
'fee_amount_currency' => 'BigDecimal',
'markup_percent' => 'BigDecimal',
'markup_amount' => 'BigDecimal',
'markup_amount_currency' => 'BigDecimal',
'amount_order_lines_and_reinvoicing' => 'BigDecimal',
'amount_order_lines_and_reinvoicing_currency' => 'BigDecimal',
'amount_travel_reports_and_expenses' => 'BigDecimal',
'amount_travel_reports_and_expenses_currency' => 'BigDecimal',
'fee_invoice_text' => 'string',
'invoice_text' => 'string',
'include_order_lines_and_reinvoicing' => 'bool',
'include_hours' => 'bool',
'include_on_account_balance' => 'bool',
'on_account_balance_amount' => 'BigDecimal',
'on_account_balance_amount_currency' => 'BigDecimal',
'vat_type' => '\Tripletex\Model\VatType'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'id' => 'int32',
'version' => 'int32',
'changes' => null,
'url' => null,
'project' => null,
'fee_amount' => null,
'fee_amount_currency' => null,
'markup_percent' => null,
'markup_amount' => null,
'markup_amount_currency' => null,
'amount_order_lines_and_reinvoicing' => null,
'amount_order_lines_and_reinvoicing_currency' => null,
'amount_travel_reports_and_expenses' => null,
'amount_travel_reports_and_expenses_currency' => null,
'fee_invoice_text' => null,
'invoice_text' => null,
'include_order_lines_and_reinvoicing' => null,
'include_hours' => null,
'include_on_account_balance' => null,
'on_account_balance_amount' => null,
'on_account_balance_amount_currency' => null,
'vat_type' => null    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
'version' => 'version',
'changes' => 'changes',
'url' => 'url',
'project' => 'project',
'fee_amount' => 'feeAmount',
'fee_amount_currency' => 'feeAmountCurrency',
'markup_percent' => 'markupPercent',
'markup_amount' => 'markupAmount',
'markup_amount_currency' => 'markupAmountCurrency',
'amount_order_lines_and_reinvoicing' => 'amountOrderLinesAndReinvoicing',
'amount_order_lines_and_reinvoicing_currency' => 'amountOrderLinesAndReinvoicingCurrency',
'amount_travel_reports_and_expenses' => 'amountTravelReportsAndExpenses',
'amount_travel_reports_and_expenses_currency' => 'amountTravelReportsAndExpensesCurrency',
'fee_invoice_text' => 'feeInvoiceText',
'invoice_text' => 'invoiceText',
'include_order_lines_and_reinvoicing' => 'includeOrderLinesAndReinvoicing',
'include_hours' => 'includeHours',
'include_on_account_balance' => 'includeOnAccountBalance',
'on_account_balance_amount' => 'onAccountBalanceAmount',
'on_account_balance_amount_currency' => 'onAccountBalanceAmountCurrency',
'vat_type' => 'vatType'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
'version' => 'setVersion',
'changes' => 'setChanges',
'url' => 'setUrl',
'project' => 'setProject',
'fee_amount' => 'setFeeAmount',
'fee_amount_currency' => 'setFeeAmountCurrency',
'markup_percent' => 'setMarkupPercent',
'markup_amount' => 'setMarkupAmount',
'markup_amount_currency' => 'setMarkupAmountCurrency',
'amount_order_lines_and_reinvoicing' => 'setAmountOrderLinesAndReinvoicing',
'amount_order_lines_and_reinvoicing_currency' => 'setAmountOrderLinesAndReinvoicingCurrency',
'amount_travel_reports_and_expenses' => 'setAmountTravelReportsAndExpenses',
'amount_travel_reports_and_expenses_currency' => 'setAmountTravelReportsAndExpensesCurrency',
'fee_invoice_text' => 'setFeeInvoiceText',
'invoice_text' => 'setInvoiceText',
'include_order_lines_and_reinvoicing' => 'setIncludeOrderLinesAndReinvoicing',
'include_hours' => 'setIncludeHours',
'include_on_account_balance' => 'setIncludeOnAccountBalance',
'on_account_balance_amount' => 'setOnAccountBalanceAmount',
'on_account_balance_amount_currency' => 'setOnAccountBalanceAmountCurrency',
'vat_type' => 'setVatType'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
'version' => 'getVersion',
'changes' => 'getChanges',
'url' => 'getUrl',
'project' => 'getProject',
'fee_amount' => 'getFeeAmount',
'fee_amount_currency' => 'getFeeAmountCurrency',
'markup_percent' => 'getMarkupPercent',
'markup_amount' => 'getMarkupAmount',
'markup_amount_currency' => 'getMarkupAmountCurrency',
'amount_order_lines_and_reinvoicing' => 'getAmountOrderLinesAndReinvoicing',
'amount_order_lines_and_reinvoicing_currency' => 'getAmountOrderLinesAndReinvoicingCurrency',
'amount_travel_reports_and_expenses' => 'getAmountTravelReportsAndExpenses',
'amount_travel_reports_and_expenses_currency' => 'getAmountTravelReportsAndExpensesCurrency',
'fee_invoice_text' => 'getFeeInvoiceText',
'invoice_text' => 'getInvoiceText',
'include_order_lines_and_reinvoicing' => 'getIncludeOrderLinesAndReinvoicing',
'include_hours' => 'getIncludeHours',
'include_on_account_balance' => 'getIncludeOnAccountBalance',
'on_account_balance_amount' => 'getOnAccountBalanceAmount',
'on_account_balance_amount_currency' => 'getOnAccountBalanceAmountCurrency',
'vat_type' => 'getVatType'    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['version'] = isset($data['version']) ? $data['version'] : null;
        $this->container['changes'] = isset($data['changes']) ? $data['changes'] : null;
        $this->container['url'] = isset($data['url']) ? $data['url'] : null;
        $this->container['project'] = isset($data['project']) ? $data['project'] : null;
        $this->container['fee_amount'] = isset($data['fee_amount']) ? $data['fee_amount'] : null;
        $this->container['fee_amount_currency'] = isset($data['fee_amount_currency']) ? $data['fee_amount_currency'] : null;
        $this->container['markup_percent'] = isset($data['markup_percent']) ? $data['markup_percent'] : null;
        $this->container['markup_amount'] = isset($data['markup_amount']) ? $data['markup_amount'] : null;
        $this->container['markup_amount_currency'] = isset($data['markup_amount_currency']) ? $data['markup_amount_currency'] : null;
        $this->container['amount_order_lines_and_reinvoicing'] = isset($data['amount_order_lines_and_reinvoicing']) ? $data['amount_order_lines_and_reinvoicing'] : null;
        $this->container['amount_order_lines_and_reinvoicing_currency'] = isset($data['amount_order_lines_and_reinvoicing_currency']) ? $data['amount_order_lines_and_reinvoicing_currency'] : null;
        $this->container['amount_travel_reports_and_expenses'] = isset($data['amount_travel_reports_and_expenses']) ? $data['amount_travel_reports_and_expenses'] : null;
        $this->container['amount_travel_reports_and_expenses_currency'] = isset($data['amount_travel_reports_and_expenses_currency']) ? $data['amount_travel_reports_and_expenses_currency'] : null;
        $this->container['fee_invoice_text'] = isset($data['fee_invoice_text']) ? $data['fee_invoice_text'] : null;
        $this->container['invoice_text'] = isset($data['invoice_text']) ? $data['invoice_text'] : null;
        $this->container['include_order_lines_and_reinvoicing'] = isset($data['include_order_lines_and_reinvoicing']) ? $data['include_order_lines_and_reinvoicing'] : false;
        $this->container['include_hours'] = isset($data['include_hours']) ? $data['include_hours'] : false;
        $this->container['include_on_account_balance'] = isset($data['include_on_account_balance']) ? $data['include_on_account_balance'] : false;
        $this->container['on_account_balance_amount'] = isset($data['on_account_balance_amount']) ? $data['on_account_balance_amount'] : null;
        $this->container['on_account_balance_amount_currency'] = isset($data['on_account_balance_amount_currency']) ? $data['on_account_balance_amount_currency'] : null;
        $this->container['vat_type'] = isset($data['vat_type']) ? $data['vat_type'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['fee_invoice_text'] === null) {
            $invalidProperties[] = "'fee_invoice_text' can't be null";
        }
        if ($this->container['invoice_text'] === null) {
            $invalidProperties[] = "'invoice_text' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets id
     *
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int $id id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets version
     *
     * @return int
     */
    public function getVersion()
    {
        return $this->container['version'];
    }

    /**
     * Sets version
     *
     * @param int $version version
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->container['version'] = $version;

        return $this;
    }

    /**
     * Gets changes
     *
     * @return \Tripletex\Model\Change[]
     */
    public function getChanges()
    {
        return $this->container['changes'];
    }

    /**
     * Sets changes
     *
     * @param \Tripletex\Model\Change[] $changes changes
     *
     * @return $this
     */
    public function setChanges($changes)
    {
        $this->container['changes'] = $changes;

        return $this;
    }

    /**
     * Gets url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->container['url'];
    }

    /**
     * Sets url
     *
     * @param string $url url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->container['url'] = $url;

        return $this;
    }

    /**
     * Gets project
     *
     * @return \Tripletex\Model\Project
     */
    public function getProject()
    {
        return $this->container['project'];
    }

    /**
     * Sets project
     *
     * @param \Tripletex\Model\Project $project project
     *
     * @return $this
     */
    public function setProject($project)
    {
        $this->container['project'] = $project;

        return $this;
    }

    /**
     * Gets fee_amount
     *
     * @return BigDecimal
     */
    public function getFeeAmount()
    {
        return $this->container['fee_amount'];
    }

    /**
     * Sets fee_amount
     *
     * @param BigDecimal $fee_amount Fee amount of the project. For example: 100 NOK.
     *
     * @return $this
     */
    public function setFeeAmount($fee_amount)
    {
        $this->container['fee_amount'] = $fee_amount;

        return $this;
    }

    /**
     * Gets fee_amount_currency
     *
     * @return BigDecimal
     */
    public function getFeeAmountCurrency()
    {
        return $this->container['fee_amount_currency'];
    }

    /**
     * Sets fee_amount_currency
     *
     * @param BigDecimal $fee_amount_currency Fee amount of the project in the invoice currency.
     *
     * @return $this
     */
    public function setFeeAmountCurrency($fee_amount_currency)
    {
        $this->container['fee_amount_currency'] = $fee_amount_currency;

        return $this;
    }

    /**
     * Gets markup_percent
     *
     * @return BigDecimal
     */
    public function getMarkupPercent()
    {
        return $this->container['markup_percent'];
    }

    /**
     * Sets markup_percent
     *
     * @param BigDecimal $markup_percent The percentage value of mark-up of amountFee. For example: 10%.
     *
     * @return $this
     */
    public function setMarkupPercent($markup_percent)
    {
        $this->container['markup_percent'] = $markup_percent;

        return $this;
    }

    /**
     * Gets markup_amount
     *
     * @return BigDecimal
     */
    public function getMarkupAmount()
    {
        return $this->container['markup_amount'];
    }

    /**
     * Sets markup_amount
     *
     * @param BigDecimal $markup_amount The amount value of mark-up of amountFee on the project invoice. For example: 10 NOK.
     *
     * @return $this
     */
    public function setMarkupAmount($markup_amount)
    {
        $this->container['markup_amount'] = $markup_amount;

        return $this;
    }

    /**
     * Gets markup_amount_currency
     *
     * @return BigDecimal
     */
    public function getMarkupAmountCurrency()
    {
        return $this->container['markup_amount_currency'];
    }

    /**
     * Sets markup_amount_currency
     *
     * @param BigDecimal $markup_amount_currency The amount value of mark-up of amountFee on the project invoice, in the invoice currency.
     *
     * @return $this
     */
    public function setMarkupAmountCurrency($markup_amount_currency)
    {
        $this->container['markup_amount_currency'] = $markup_amount_currency;

        return $this;
    }

    /**
     * Gets amount_order_lines_and_reinvoicing
     *
     * @return BigDecimal
     */
    public function getAmountOrderLinesAndReinvoicing()
    {
        return $this->container['amount_order_lines_and_reinvoicing'];
    }

    /**
     * Sets amount_order_lines_and_reinvoicing
     *
     * @param BigDecimal $amount_order_lines_and_reinvoicing The amount of chargeable manual order lines and vendor invoices on the project invoice.
     *
     * @return $this
     */
    public function setAmountOrderLinesAndReinvoicing($amount_order_lines_and_reinvoicing)
    {
        $this->container['amount_order_lines_and_reinvoicing'] = $amount_order_lines_and_reinvoicing;

        return $this;
    }

    /**
     * Gets amount_order_lines_and_reinvoicing_currency
     *
     * @return BigDecimal
     */
    public function getAmountOrderLinesAndReinvoicingCurrency()
    {
        return $this->container['amount_order_lines_and_reinvoicing_currency'];
    }

    /**
     * Sets amount_order_lines_and_reinvoicing_currency
     *
     * @param BigDecimal $amount_order_lines_and_reinvoicing_currency The amount of chargeable manual order lines and vendor invoices on the project invoice, in the invoice currency.
     *
     * @return $this
     */
    public function setAmountOrderLinesAndReinvoicingCurrency($amount_order_lines_and_reinvoicing_currency)
    {
        $this->container['amount_order_lines_and_reinvoicing_currency'] = $amount_order_lines_and_reinvoicing_currency;

        return $this;
    }

    /**
     * Gets amount_travel_reports_and_expenses
     *
     * @return BigDecimal
     */
    public function getAmountTravelReportsAndExpenses()
    {
        return $this->container['amount_travel_reports_and_expenses'];
    }

    /**
     * Sets amount_travel_reports_and_expenses
     *
     * @param BigDecimal $amount_travel_reports_and_expenses The amount of travel costs and expenses on the project invoice.
     *
     * @return $this
     */
    public function setAmountTravelReportsAndExpenses($amount_travel_reports_and_expenses)
    {
        $this->container['amount_travel_reports_and_expenses'] = $amount_travel_reports_and_expenses;

        return $this;
    }

    /**
     * Gets amount_travel_reports_and_expenses_currency
     *
     * @return BigDecimal
     */
    public function getAmountTravelReportsAndExpensesCurrency()
    {
        return $this->container['amount_travel_reports_and_expenses_currency'];
    }

    /**
     * Sets amount_travel_reports_and_expenses_currency
     *
     * @param BigDecimal $amount_travel_reports_and_expenses_currency The amount of travel costs and expenses on the project invoice, in the invoice currency.
     *
     * @return $this
     */
    public function setAmountTravelReportsAndExpensesCurrency($amount_travel_reports_and_expenses_currency)
    {
        $this->container['amount_travel_reports_and_expenses_currency'] = $amount_travel_reports_and_expenses_currency;

        return $this;
    }

    /**
     * Gets fee_invoice_text
     *
     * @return string
     */
    public function getFeeInvoiceText()
    {
        return $this->container['fee_invoice_text'];
    }

    /**
     * Sets fee_invoice_text
     *
     * @param string $fee_invoice_text The fee comment on the project invoice.
     *
     * @return $this
     */
    public function setFeeInvoiceText($fee_invoice_text)
    {
        $this->container['fee_invoice_text'] = $fee_invoice_text;

        return $this;
    }

    /**
     * Gets invoice_text
     *
     * @return string
     */
    public function getInvoiceText()
    {
        return $this->container['invoice_text'];
    }

    /**
     * Sets invoice_text
     *
     * @param string $invoice_text The comment on the project invoice.
     *
     * @return $this
     */
    public function setInvoiceText($invoice_text)
    {
        $this->container['invoice_text'] = $invoice_text;

        return $this;
    }

    /**
     * Gets include_order_lines_and_reinvoicing
     *
     * @return bool
     */
    public function getIncludeOrderLinesAndReinvoicing()
    {
        return $this->container['include_order_lines_and_reinvoicing'];
    }

    /**
     * Sets include_order_lines_and_reinvoicing
     *
     * @param bool $include_order_lines_and_reinvoicing Determines if extra costs should be included on the project invoice.
     *
     * @return $this
     */
    public function setIncludeOrderLinesAndReinvoicing($include_order_lines_and_reinvoicing)
    {
        $this->container['include_order_lines_and_reinvoicing'] = $include_order_lines_and_reinvoicing;

        return $this;
    }

    /**
     * Gets include_hours
     *
     * @return bool
     */
    public function getIncludeHours()
    {
        return $this->container['include_hours'];
    }

    /**
     * Sets include_hours
     *
     * @param bool $include_hours Determines if hours should be included on the project invoice.
     *
     * @return $this
     */
    public function setIncludeHours($include_hours)
    {
        $this->container['include_hours'] = $include_hours;

        return $this;
    }

    /**
     * Gets include_on_account_balance
     *
     * @return bool
     */
    public function getIncludeOnAccountBalance()
    {
        return $this->container['include_on_account_balance'];
    }

    /**
     * Sets include_on_account_balance
     *
     * @param bool $include_on_account_balance Determines if akonto should be included on the project invoice.
     *
     * @return $this
     */
    public function setIncludeOnAccountBalance($include_on_account_balance)
    {
        $this->container['include_on_account_balance'] = $include_on_account_balance;

        return $this;
    }

    /**
     * Gets on_account_balance_amount
     *
     * @return BigDecimal
     */
    public function getOnAccountBalanceAmount()
    {
        return $this->container['on_account_balance_amount'];
    }

    /**
     * Sets on_account_balance_amount
     *
     * @param BigDecimal $on_account_balance_amount The akonto amount on the project invoice.
     *
     * @return $this
     */
    public function setOnAccountBalanceAmount($on_account_balance_amount)
    {
        $this->container['on_account_balance_amount'] = $on_account_balance_amount;

        return $this;
    }

    /**
     * Gets on_account_balance_amount_currency
     *
     * @return BigDecimal
     */
    public function getOnAccountBalanceAmountCurrency()
    {
        return $this->container['on_account_balance_amount_currency'];
    }

    /**
     * Sets on_account_balance_amount_currency
     *
     * @param BigDecimal $on_account_balance_amount_currency The akonto amount on the project invoice in the invoice currency.
     *
     * @return $this
     */
    public function setOnAccountBalanceAmountCurrency($on_account_balance_amount_currency)
    {
        $this->container['on_account_balance_amount_currency'] = $on_account_balance_amount_currency;

        return $this;
    }

    /**
     * Gets vat_type
     *
     * @return \Tripletex\Model\VatType
     */
    public function getVatType()
    {
        return $this->container['vat_type'];
    }

    /**
     * Sets vat_type
     *
     * @param \Tripletex\Model\VatType $vat_type vat_type
     *
     * @return $this
     */
    public function setVatType($vat_type)
    {
        $this->container['vat_type'] = $vat_type;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
