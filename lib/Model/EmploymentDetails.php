<?php
/**
 * EmploymentDetails
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
 * EmploymentDetails Class Doc Comment
 *
 * @category Class
 * @package  Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class EmploymentDetails implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'EmploymentDetails';

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
'employment' => '\Tripletex\Model\Employment',
'date' => 'string',
'employment_type' => 'string',
'maritime_employment' => '\Tripletex\Model\MaritimeEmployment',
'remuneration_type' => 'string',
'working_hours_scheme' => 'string',
'shift_duration_hours' => 'double',
'occupation_code' => 'int',
'percentage_of_full_time_equivalent' => 'double',
'annual_salary' => 'double',
'hourly_wage' => 'double',
'payroll_tax_municipality_id' => 'int'    ];

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
'employment' => null,
'date' => null,
'employment_type' => null,
'maritime_employment' => null,
'remuneration_type' => null,
'working_hours_scheme' => null,
'shift_duration_hours' => 'double',
'occupation_code' => 'int32',
'percentage_of_full_time_equivalent' => 'double',
'annual_salary' => 'double',
'hourly_wage' => 'double',
'payroll_tax_municipality_id' => 'int32'    ];

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
'employment' => 'employment',
'date' => 'date',
'employment_type' => 'employmentType',
'maritime_employment' => 'maritimeEmployment',
'remuneration_type' => 'remunerationType',
'working_hours_scheme' => 'workingHoursScheme',
'shift_duration_hours' => 'shiftDurationHours',
'occupation_code' => 'occupationCode',
'percentage_of_full_time_equivalent' => 'percentageOfFullTimeEquivalent',
'annual_salary' => 'annualSalary',
'hourly_wage' => 'hourlyWage',
'payroll_tax_municipality_id' => 'payrollTaxMunicipalityId'    ];

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
'employment' => 'setEmployment',
'date' => 'setDate',
'employment_type' => 'setEmploymentType',
'maritime_employment' => 'setMaritimeEmployment',
'remuneration_type' => 'setRemunerationType',
'working_hours_scheme' => 'setWorkingHoursScheme',
'shift_duration_hours' => 'setShiftDurationHours',
'occupation_code' => 'setOccupationCode',
'percentage_of_full_time_equivalent' => 'setPercentageOfFullTimeEquivalent',
'annual_salary' => 'setAnnualSalary',
'hourly_wage' => 'setHourlyWage',
'payroll_tax_municipality_id' => 'setPayrollTaxMunicipalityId'    ];

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
'employment' => 'getEmployment',
'date' => 'getDate',
'employment_type' => 'getEmploymentType',
'maritime_employment' => 'getMaritimeEmployment',
'remuneration_type' => 'getRemunerationType',
'working_hours_scheme' => 'getWorkingHoursScheme',
'shift_duration_hours' => 'getShiftDurationHours',
'occupation_code' => 'getOccupationCode',
'percentage_of_full_time_equivalent' => 'getPercentageOfFullTimeEquivalent',
'annual_salary' => 'getAnnualSalary',
'hourly_wage' => 'getHourlyWage',
'payroll_tax_municipality_id' => 'getPayrollTaxMunicipalityId'    ];

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

    const EMPLOYMENT_TYPE_ORDINARY = 'ORDINARY';
const EMPLOYMENT_TYPE_MARITIME = 'MARITIME';
const EMPLOYMENT_TYPE_FREELANCE = 'FREELANCE';
const REMUNERATION_TYPE_MONTHLY_WAGE = 'MONTHLY_WAGE';
const REMUNERATION_TYPE_HOURLY_WAGE = 'HOURLY_WAGE';
const REMUNERATION_TYPE_COMMISION_PERCENTAGE = 'COMMISION_PERCENTAGE';
const REMUNERATION_TYPE_FEE = 'FEE';
const REMUNERATION_TYPE_PIECEWORK_WAGE = 'PIECEWORK_WAGE';
const WORKING_HOURS_SCHEME_NOT_SHIFT = 'NOT_SHIFT';
const WORKING_HOURS_SCHEME_ROUND_THE_CLOCK = 'ROUND_THE_CLOCK';
const WORKING_HOURS_SCHEME_SHIFT_365 = 'SHIFT_365';
const WORKING_HOURS_SCHEME_OFFSHORE_336 = 'OFFSHORE_336';
const WORKING_HOURS_SCHEME_CONTINUOUS = 'CONTINUOUS';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEmploymentTypeAllowableValues()
    {
        return [
            self::EMPLOYMENT_TYPE_ORDINARY,
self::EMPLOYMENT_TYPE_MARITIME,
self::EMPLOYMENT_TYPE_FREELANCE,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getRemunerationTypeAllowableValues()
    {
        return [
            self::REMUNERATION_TYPE_MONTHLY_WAGE,
self::REMUNERATION_TYPE_HOURLY_WAGE,
self::REMUNERATION_TYPE_COMMISION_PERCENTAGE,
self::REMUNERATION_TYPE_FEE,
self::REMUNERATION_TYPE_PIECEWORK_WAGE,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getWorkingHoursSchemeAllowableValues()
    {
        return [
            self::WORKING_HOURS_SCHEME_NOT_SHIFT,
self::WORKING_HOURS_SCHEME_ROUND_THE_CLOCK,
self::WORKING_HOURS_SCHEME_SHIFT_365,
self::WORKING_HOURS_SCHEME_OFFSHORE_336,
self::WORKING_HOURS_SCHEME_CONTINUOUS,        ];
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
        $this->container['employment'] = isset($data['employment']) ? $data['employment'] : null;
        $this->container['date'] = isset($data['date']) ? $data['date'] : null;
        $this->container['employment_type'] = isset($data['employment_type']) ? $data['employment_type'] : null;
        $this->container['maritime_employment'] = isset($data['maritime_employment']) ? $data['maritime_employment'] : null;
        $this->container['remuneration_type'] = isset($data['remuneration_type']) ? $data['remuneration_type'] : null;
        $this->container['working_hours_scheme'] = isset($data['working_hours_scheme']) ? $data['working_hours_scheme'] : null;
        $this->container['shift_duration_hours'] = isset($data['shift_duration_hours']) ? $data['shift_duration_hours'] : null;
        $this->container['occupation_code'] = isset($data['occupation_code']) ? $data['occupation_code'] : null;
        $this->container['percentage_of_full_time_equivalent'] = isset($data['percentage_of_full_time_equivalent']) ? $data['percentage_of_full_time_equivalent'] : null;
        $this->container['annual_salary'] = isset($data['annual_salary']) ? $data['annual_salary'] : null;
        $this->container['hourly_wage'] = isset($data['hourly_wage']) ? $data['hourly_wage'] : null;
        $this->container['payroll_tax_municipality_id'] = isset($data['payroll_tax_municipality_id']) ? $data['payroll_tax_municipality_id'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getEmploymentTypeAllowableValues();
        if (!is_null($this->container['employment_type']) && !in_array($this->container['employment_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'employment_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getRemunerationTypeAllowableValues();
        if (!is_null($this->container['remuneration_type']) && !in_array($this->container['remuneration_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'remuneration_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getWorkingHoursSchemeAllowableValues();
        if (!is_null($this->container['working_hours_scheme']) && !in_array($this->container['working_hours_scheme'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'working_hours_scheme', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['percentage_of_full_time_equivalent'] === null) {
            $invalidProperties[] = "'percentage_of_full_time_equivalent' can't be null";
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
     * Gets employment
     *
     * @return \Tripletex\Model\Employment
     */
    public function getEmployment()
    {
        return $this->container['employment'];
    }

    /**
     * Sets employment
     *
     * @param \Tripletex\Model\Employment $employment employment
     *
     * @return $this
     */
    public function setEmployment($employment)
    {
        $this->container['employment'] = $employment;

        return $this;
    }

    /**
     * Gets date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param string $date date
     *
     * @return $this
     */
    public function setDate($date)
    {
        $this->container['date'] = $date;

        return $this;
    }

    /**
     * Gets employment_type
     *
     * @return string
     */
    public function getEmploymentType()
    {
        return $this->container['employment_type'];
    }

    /**
     * Sets employment_type
     *
     * @param string $employment_type Define the employment type.
     *
     * @return $this
     */
    public function setEmploymentType($employment_type)
    {
        $allowedValues = $this->getEmploymentTypeAllowableValues();
        if (!is_null($employment_type) && !in_array($employment_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'employment_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['employment_type'] = $employment_type;

        return $this;
    }

    /**
     * Gets maritime_employment
     *
     * @return \Tripletex\Model\MaritimeEmployment
     */
    public function getMaritimeEmployment()
    {
        return $this->container['maritime_employment'];
    }

    /**
     * Sets maritime_employment
     *
     * @param \Tripletex\Model\MaritimeEmployment $maritime_employment maritime_employment
     *
     * @return $this
     */
    public function setMaritimeEmployment($maritime_employment)
    {
        $this->container['maritime_employment'] = $maritime_employment;

        return $this;
    }

    /**
     * Gets remuneration_type
     *
     * @return string
     */
    public function getRemunerationType()
    {
        return $this->container['remuneration_type'];
    }

    /**
     * Sets remuneration_type
     *
     * @param string $remuneration_type Define the remuneration type.
     *
     * @return $this
     */
    public function setRemunerationType($remuneration_type)
    {
        $allowedValues = $this->getRemunerationTypeAllowableValues();
        if (!is_null($remuneration_type) && !in_array($remuneration_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'remuneration_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['remuneration_type'] = $remuneration_type;

        return $this;
    }

    /**
     * Gets working_hours_scheme
     *
     * @return string
     */
    public function getWorkingHoursScheme()
    {
        return $this->container['working_hours_scheme'];
    }

    /**
     * Sets working_hours_scheme
     *
     * @param string $working_hours_scheme Define the working hours scheme type. If you enter a value for SHIFT WORK, you must also enter value for shiftDurationHours
     *
     * @return $this
     */
    public function setWorkingHoursScheme($working_hours_scheme)
    {
        $allowedValues = $this->getWorkingHoursSchemeAllowableValues();
        if (!is_null($working_hours_scheme) && !in_array($working_hours_scheme, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'working_hours_scheme', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['working_hours_scheme'] = $working_hours_scheme;

        return $this;
    }

    /**
     * Gets shift_duration_hours
     *
     * @return double
     */
    public function getShiftDurationHours()
    {
        return $this->container['shift_duration_hours'];
    }

    /**
     * Sets shift_duration_hours
     *
     * @param double $shift_duration_hours shift_duration_hours
     *
     * @return $this
     */
    public function setShiftDurationHours($shift_duration_hours)
    {
        $this->container['shift_duration_hours'] = $shift_duration_hours;

        return $this;
    }

    /**
     * Gets occupation_code
     *
     * @return int
     */
    public function getOccupationCode()
    {
        return $this->container['occupation_code'];
    }

    /**
     * Sets occupation_code
     *
     * @param int $occupation_code To find the right value to enter in this field, you could go to GET /employee/employment/occupationCode to get a list of valid ID's.
     *
     * @return $this
     */
    public function setOccupationCode($occupation_code)
    {
        $this->container['occupation_code'] = $occupation_code;

        return $this;
    }

    /**
     * Gets percentage_of_full_time_equivalent
     *
     * @return double
     */
    public function getPercentageOfFullTimeEquivalent()
    {
        return $this->container['percentage_of_full_time_equivalent'];
    }

    /**
     * Sets percentage_of_full_time_equivalent
     *
     * @param double $percentage_of_full_time_equivalent percentage_of_full_time_equivalent
     *
     * @return $this
     */
    public function setPercentageOfFullTimeEquivalent($percentage_of_full_time_equivalent)
    {
        $this->container['percentage_of_full_time_equivalent'] = $percentage_of_full_time_equivalent;

        return $this;
    }

    /**
     * Gets annual_salary
     *
     * @return double
     */
    public function getAnnualSalary()
    {
        return $this->container['annual_salary'];
    }

    /**
     * Sets annual_salary
     *
     * @param double $annual_salary annual_salary
     *
     * @return $this
     */
    public function setAnnualSalary($annual_salary)
    {
        $this->container['annual_salary'] = $annual_salary;

        return $this;
    }

    /**
     * Gets hourly_wage
     *
     * @return double
     */
    public function getHourlyWage()
    {
        return $this->container['hourly_wage'];
    }

    /**
     * Sets hourly_wage
     *
     * @param double $hourly_wage hourly_wage
     *
     * @return $this
     */
    public function setHourlyWage($hourly_wage)
    {
        $this->container['hourly_wage'] = $hourly_wage;

        return $this;
    }

    /**
     * Gets payroll_tax_municipality_id
     *
     * @return int
     */
    public function getPayrollTaxMunicipalityId()
    {
        return $this->container['payroll_tax_municipality_id'];
    }

    /**
     * Sets payroll_tax_municipality_id
     *
     * @param int $payroll_tax_municipality_id payroll_tax_municipality_id
     *
     * @return $this
     */
    public function setPayrollTaxMunicipalityId($payroll_tax_municipality_id)
    {
        $this->container['payroll_tax_municipality_id'] = $payroll_tax_municipality_id;

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
