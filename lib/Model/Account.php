<?php
/**
 * Account
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
 * OpenAPI spec version: 2.33.2
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.2
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
 * Account Class Doc Comment
 *
 * @category Class
 * @package  Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Account implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Account';

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
        'number' => 'int',
        'name' => 'string',
        'description' => 'string',
        'type' => 'string',
        'vat_type' => '\Tripletex\Model\VatType',
        'vat_locked' => 'bool',
        'currency' => '\Tripletex\Model\Currency',
        'is_closeable' => 'bool',
        'is_applicable_for_supplier_invoice' => 'bool',
        'require_reconciliation' => 'bool',
        'is_inactive' => 'bool',
        'is_bank_account' => 'bool',
        'is_invoice_account' => 'bool',
        'bank_account_number' => 'string',
        'bank_account_country' => '\Tripletex\Model\Country',
        'bank_name' => 'string',
        'bank_account_iban' => 'string',
        'bank_account_swift' => 'string'
    ];

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
        'number' => 'int32',
        'name' => null,
        'description' => null,
        'type' => null,
        'vat_type' => null,
        'vat_locked' => null,
        'currency' => null,
        'is_closeable' => null,
        'is_applicable_for_supplier_invoice' => null,
        'require_reconciliation' => null,
        'is_inactive' => null,
        'is_bank_account' => null,
        'is_invoice_account' => null,
        'bank_account_number' => null,
        'bank_account_country' => null,
        'bank_name' => null,
        'bank_account_iban' => null,
        'bank_account_swift' => null
    ];

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
        'number' => 'number',
        'name' => 'name',
        'description' => 'description',
        'type' => 'type',
        'vat_type' => 'vatType',
        'vat_locked' => 'vatLocked',
        'currency' => 'currency',
        'is_closeable' => 'isCloseable',
        'is_applicable_for_supplier_invoice' => 'isApplicableForSupplierInvoice',
        'require_reconciliation' => 'requireReconciliation',
        'is_inactive' => 'isInactive',
        'is_bank_account' => 'isBankAccount',
        'is_invoice_account' => 'isInvoiceAccount',
        'bank_account_number' => 'bankAccountNumber',
        'bank_account_country' => 'bankAccountCountry',
        'bank_name' => 'bankName',
        'bank_account_iban' => 'bankAccountIBAN',
        'bank_account_swift' => 'bankAccountSWIFT'
    ];

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
        'number' => 'setNumber',
        'name' => 'setName',
        'description' => 'setDescription',
        'type' => 'setType',
        'vat_type' => 'setVatType',
        'vat_locked' => 'setVatLocked',
        'currency' => 'setCurrency',
        'is_closeable' => 'setIsCloseable',
        'is_applicable_for_supplier_invoice' => 'setIsApplicableForSupplierInvoice',
        'require_reconciliation' => 'setRequireReconciliation',
        'is_inactive' => 'setIsInactive',
        'is_bank_account' => 'setIsBankAccount',
        'is_invoice_account' => 'setIsInvoiceAccount',
        'bank_account_number' => 'setBankAccountNumber',
        'bank_account_country' => 'setBankAccountCountry',
        'bank_name' => 'setBankName',
        'bank_account_iban' => 'setBankAccountIban',
        'bank_account_swift' => 'setBankAccountSwift'
    ];

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
        'number' => 'getNumber',
        'name' => 'getName',
        'description' => 'getDescription',
        'type' => 'getType',
        'vat_type' => 'getVatType',
        'vat_locked' => 'getVatLocked',
        'currency' => 'getCurrency',
        'is_closeable' => 'getIsCloseable',
        'is_applicable_for_supplier_invoice' => 'getIsApplicableForSupplierInvoice',
        'require_reconciliation' => 'getRequireReconciliation',
        'is_inactive' => 'getIsInactive',
        'is_bank_account' => 'getIsBankAccount',
        'is_invoice_account' => 'getIsInvoiceAccount',
        'bank_account_number' => 'getBankAccountNumber',
        'bank_account_country' => 'getBankAccountCountry',
        'bank_name' => 'getBankName',
        'bank_account_iban' => 'getBankAccountIban',
        'bank_account_swift' => 'getBankAccountSwift'
    ];

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

    const TYPE_ASSETS = 'ASSETS';
    const TYPE_EQUITY = 'EQUITY';
    const TYPE_LIABILITIES = 'LIABILITIES';
    const TYPE_OPERATING_REVENUES = 'OPERATING_REVENUES';
    const TYPE_OPERATING_EXPENSES = 'OPERATING_EXPENSES';
    const TYPE_INVESTMENT_INCOME = 'INVESTMENT_INCOME';
    const TYPE_COST_OF_CAPITAL = 'COST_OF_CAPITAL';
    const TYPE_TAX_ON_ORDINARY_ACTIVITIES = 'TAX_ON_ORDINARY_ACTIVITIES';
    const TYPE_EXTRAORDINARY_INCOME = 'EXTRAORDINARY_INCOME';
    const TYPE_EXTRAORDINARY_COST = 'EXTRAORDINARY_COST';
    const TYPE_TAX_ON_EXTRAORDINARY_ACTIVITIES = 'TAX_ON_EXTRAORDINARY_ACTIVITIES';
    const TYPE_ANNUAL_RESULT = 'ANNUAL_RESULT';
    const TYPE_TRANSFERS_AND_ALLOCATIONS = 'TRANSFERS_AND_ALLOCATIONS';
    

    
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_ASSETS,
            self::TYPE_EQUITY,
            self::TYPE_LIABILITIES,
            self::TYPE_OPERATING_REVENUES,
            self::TYPE_OPERATING_EXPENSES,
            self::TYPE_INVESTMENT_INCOME,
            self::TYPE_COST_OF_CAPITAL,
            self::TYPE_TAX_ON_ORDINARY_ACTIVITIES,
            self::TYPE_EXTRAORDINARY_INCOME,
            self::TYPE_EXTRAORDINARY_COST,
            self::TYPE_TAX_ON_EXTRAORDINARY_ACTIVITIES,
            self::TYPE_ANNUAL_RESULT,
            self::TYPE_TRANSFERS_AND_ALLOCATIONS,
        ];
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
        $this->container['number'] = isset($data['number']) ? $data['number'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['vat_type'] = isset($data['vat_type']) ? $data['vat_type'] : null;
        $this->container['vat_locked'] = isset($data['vat_locked']) ? $data['vat_locked'] : false;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['is_closeable'] = isset($data['is_closeable']) ? $data['is_closeable'] : false;
        $this->container['is_applicable_for_supplier_invoice'] = isset($data['is_applicable_for_supplier_invoice']) ? $data['is_applicable_for_supplier_invoice'] : false;
        $this->container['require_reconciliation'] = isset($data['require_reconciliation']) ? $data['require_reconciliation'] : false;
        $this->container['is_inactive'] = isset($data['is_inactive']) ? $data['is_inactive'] : false;
        $this->container['is_bank_account'] = isset($data['is_bank_account']) ? $data['is_bank_account'] : false;
        $this->container['is_invoice_account'] = isset($data['is_invoice_account']) ? $data['is_invoice_account'] : false;
        $this->container['bank_account_number'] = isset($data['bank_account_number']) ? $data['bank_account_number'] : null;
        $this->container['bank_account_country'] = isset($data['bank_account_country']) ? $data['bank_account_country'] : null;
        $this->container['bank_name'] = isset($data['bank_name']) ? $data['bank_name'] : null;
        $this->container['bank_account_iban'] = isset($data['bank_account_iban']) ? $data['bank_account_iban'] : null;
        $this->container['bank_account_swift'] = isset($data['bank_account_swift']) ? $data['bank_account_swift'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['number'] === null) {
            $invalidProperties[] = "'number' can't be null";
        }
        if (($this->container['number'] < 0)) {
            $invalidProperties[] = "invalid value for 'number', must be bigger than or equal to 0.";
        }

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ((mb_strlen($this->container['name']) > 255)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be smaller than or equal to 255.";
        }

        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['bank_account_number']) && (mb_strlen($this->container['bank_account_number']) > 100)) {
            $invalidProperties[] = "invalid value for 'bank_account_number', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['bank_name']) && (mb_strlen($this->container['bank_name']) > 255)) {
            $invalidProperties[] = "invalid value for 'bank_name', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['bank_account_iban']) && (mb_strlen($this->container['bank_account_iban']) > 100)) {
            $invalidProperties[] = "invalid value for 'bank_account_iban', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['bank_account_swift']) && (mb_strlen($this->container['bank_account_swift']) > 100)) {
            $invalidProperties[] = "invalid value for 'bank_account_swift', the character length must be smaller than or equal to 100.";
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
     * Gets number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->container['number'];
    }

    /**
     * Sets number
     *
     * @param int $number number
     *
     * @return $this
     */
    public function setNumber($number)
    {

        if (($number < 0)) {
            throw new \InvalidArgumentException('invalid value for $number when calling Account., must be bigger than or equal to 0.');
        }

        $this->container['number'] = $number;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name
     *
     * @return $this
     */
    public function setName($name)
    {
        if ((mb_strlen($name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $name when calling Account., must be smaller than or equal to 255.');
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type type
     *
     * @return $this
     */
    public function setType($type)
    {
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($type) && !in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

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
     * @param \Tripletex\Model\VatType $vat_type The default vat type for this account.
     *
     * @return $this
     */
    public function setVatType($vat_type)
    {
        $this->container['vat_type'] = $vat_type;

        return $this;
    }

    /**
     * Gets vat_locked
     *
     * @return bool
     */
    public function getVatLocked()
    {
        return $this->container['vat_locked'];
    }

    /**
     * Sets vat_locked
     *
     * @param bool $vat_locked True if all entries on this account must have the vat type given by vatType.
     *
     * @return $this
     */
    public function setVatLocked($vat_locked)
    {
        $this->container['vat_locked'] = $vat_locked;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return \Tripletex\Model\Currency
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param \Tripletex\Model\Currency $currency If given, all entries on this account must have this currency.
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets is_closeable
     *
     * @return bool
     */
    public function getIsCloseable()
    {
        return $this->container['is_closeable'];
    }

    /**
     * Sets is_closeable
     *
     * @param bool $is_closeable True if it should be possible to close entries on this account and it is possible to filter on open entries.
     *
     * @return $this
     */
    public function setIsCloseable($is_closeable)
    {
        $this->container['is_closeable'] = $is_closeable;

        return $this;
    }

    /**
     * Gets is_applicable_for_supplier_invoice
     *
     * @return bool
     */
    public function getIsApplicableForSupplierInvoice()
    {
        return $this->container['is_applicable_for_supplier_invoice'];
    }

    /**
     * Sets is_applicable_for_supplier_invoice
     *
     * @param bool $is_applicable_for_supplier_invoice True if this account is applicable for supplier invoice registration.
     *
     * @return $this
     */
    public function setIsApplicableForSupplierInvoice($is_applicable_for_supplier_invoice)
    {
        $this->container['is_applicable_for_supplier_invoice'] = $is_applicable_for_supplier_invoice;

        return $this;
    }

    /**
     * Gets require_reconciliation
     *
     * @return bool
     */
    public function getRequireReconciliation()
    {
        return $this->container['require_reconciliation'];
    }

    /**
     * Sets require_reconciliation
     *
     * @param bool $require_reconciliation True if this account must be reconciled before the accounting period closure.
     *
     * @return $this
     */
    public function setRequireReconciliation($require_reconciliation)
    {
        $this->container['require_reconciliation'] = $require_reconciliation;

        return $this;
    }

    /**
     * Gets is_inactive
     *
     * @return bool
     */
    public function getIsInactive()
    {
        return $this->container['is_inactive'];
    }

    /**
     * Sets is_inactive
     *
     * @param bool $is_inactive Inactive accounts will not show up in UI lists.
     *
     * @return $this
     */
    public function setIsInactive($is_inactive)
    {
        $this->container['is_inactive'] = $is_inactive;

        return $this;
    }

    /**
     * Gets is_bank_account
     *
     * @return bool
     */
    public function getIsBankAccount()
    {
        return $this->container['is_bank_account'];
    }

    /**
     * Sets is_bank_account
     *
     * @param bool $is_bank_account is_bank_account
     *
     * @return $this
     */
    public function setIsBankAccount($is_bank_account)
    {
        $this->container['is_bank_account'] = $is_bank_account;

        return $this;
    }

    /**
     * Gets is_invoice_account
     *
     * @return bool
     */
    public function getIsInvoiceAccount()
    {
        return $this->container['is_invoice_account'];
    }

    /**
     * Sets is_invoice_account
     *
     * @param bool $is_invoice_account is_invoice_account
     *
     * @return $this
     */
    public function setIsInvoiceAccount($is_invoice_account)
    {
        $this->container['is_invoice_account'] = $is_invoice_account;

        return $this;
    }

    /**
     * Gets bank_account_number
     *
     * @return string
     */
    public function getBankAccountNumber()
    {
        return $this->container['bank_account_number'];
    }

    /**
     * Sets bank_account_number
     *
     * @param string $bank_account_number bank_account_number
     *
     * @return $this
     */
    public function setBankAccountNumber($bank_account_number)
    {
        if (!is_null($bank_account_number) && (mb_strlen($bank_account_number) > 100)) {
            throw new \InvalidArgumentException('invalid length for $bank_account_number when calling Account., must be smaller than or equal to 100.');
        }

        $this->container['bank_account_number'] = $bank_account_number;

        return $this;
    }

    /**
     * Gets bank_account_country
     *
     * @return \Tripletex\Model\Country
     */
    public function getBankAccountCountry()
    {
        return $this->container['bank_account_country'];
    }

    /**
     * Sets bank_account_country
     *
     * @param \Tripletex\Model\Country $bank_account_country bank_account_country
     *
     * @return $this
     */
    public function setBankAccountCountry($bank_account_country)
    {
        $this->container['bank_account_country'] = $bank_account_country;

        return $this;
    }

    /**
     * Gets bank_name
     *
     * @return string
     */
    public function getBankName()
    {
        return $this->container['bank_name'];
    }

    /**
     * Sets bank_name
     *
     * @param string $bank_name bank_name
     *
     * @return $this
     */
    public function setBankName($bank_name)
    {
        if (!is_null($bank_name) && (mb_strlen($bank_name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $bank_name when calling Account., must be smaller than or equal to 255.');
        }

        $this->container['bank_name'] = $bank_name;

        return $this;
    }

    /**
     * Gets bank_account_iban
     *
     * @return string
     */
    public function getBankAccountIban()
    {
        return $this->container['bank_account_iban'];
    }

    /**
     * Sets bank_account_iban
     *
     * @param string $bank_account_iban bank_account_iban
     *
     * @return $this
     */
    public function setBankAccountIban($bank_account_iban)
    {
        if (!is_null($bank_account_iban) && (mb_strlen($bank_account_iban) > 100)) {
            throw new \InvalidArgumentException('invalid length for $bank_account_iban when calling Account., must be smaller than or equal to 100.');
        }

        $this->container['bank_account_iban'] = $bank_account_iban;

        return $this;
    }

    /**
     * Gets bank_account_swift
     *
     * @return string
     */
    public function getBankAccountSwift()
    {
        return $this->container['bank_account_swift'];
    }

    /**
     * Sets bank_account_swift
     *
     * @param string $bank_account_swift bank_account_swift
     *
     * @return $this
     */
    public function setBankAccountSwift($bank_account_swift)
    {
        if (!is_null($bank_account_swift) && (mb_strlen($bank_account_swift) > 100)) {
            throw new \InvalidArgumentException('invalid length for $bank_account_swift when calling Account., must be smaller than or equal to 100.');
        }

        $this->container['bank_account_swift'] = $bank_account_swift;

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


