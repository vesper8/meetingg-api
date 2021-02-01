<?php
declare(strict_types=1);

namespace Meeting\Http;

use Phalcon\Http\Response;
use Phalcon\Http\ResponseInterface;

class ApiResponse extends Response
{
    // [Informational 1xx]
    const HTTP_CONTINUE                        = 100;
    const HTTP_SWITCHING_PROTOCOLS             = 101;

    // [Successful 2xx]
    const HTTP_OK                              = 200;
    const HTTP_CREATED                         = 201;
    const HTTP_ACCEPTED                        = 202;
    const HTTP_NONAUTHORITATIVE_INFORMATION    = 203;
    const HTTP_NO_CONTENT                      = 204;
    const HTTP_RESET_CONTENT                   = 205;
    const HTTP_PARTIAL_CONTENT                 = 206;

    // [Redirection 3xx]
    const HTTP_MULTIPLE_CHOICES                = 300;
    const HTTP_MOVED_PERMANENTLY               = 301;
    const HTTP_FOUND                           = 302;
    const HTTP_SEE_OTHER                       = 303;
    const HTTP_NOT_MODIFIED                    = 304;
    const HTTP_USE_PROXY                       = 305;
    const HTTP_UNUSED                          = 306;
    const HTTP_TEMPORARY_REDIRECT              = 307;

    // [Client Error 4xx]
    const errorCodesBeginAt                    = 400;
    const HTTP_BAD_REQUEST                     = 400;
    const HTTP_UNAUTHORIZED                    = 401;
    const HTTP_PAYMENT_REQUIRED                = 402;
    const HTTP_FORBIDDEN                       = 403;
    const HTTP_NOT_FOUND                       = 404;
    const HTTP_METHOD_NOT_ALLOWED              = 405;
    const HTTP_NOT_ACCEPTABLE                  = 406;
    const HTTP_PROXY_AUTHENTICATION_REQUIRED   = 407;
    const HTTP_REQUEST_TIMEOUT                 = 408;
    const HTTP_CONFLICT                        = 409;
    const HTTP_GONE                            = 410;
    const HTTP_LENGTH_REQUIRED                 = 411;
    const HTTP_PRECONDITION_FAILED             = 412;
    const HTTP_REQUEST_ENTITY_TOO_LARGE        = 413;
    const HTTP_REQUEST_URI_TOO_LONG            = 414;
    const HTTP_UNSUPPORTED_MEDIA_TYPE          = 415;
    const HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const HTTP_EXPECTATION_FAILED              = 417;

    // [Server Error 5xx]
    const HTTP_INTERNAL_SERVER_ERROR           = 500;
    const HTTP_NOT_IMPLEMENTED                 = 501;
    const HTTP_BAD_GATEWAY                     = 502;
    const HTTP_SERVICE_UNAVAILABLE             = 503;
    const HTTP_GATEWAY_TIMEOUT                 = 504;
    const HTTP_VERSION_NOT_SUPPORTED           = 505;

    protected array $data = [];
    protected string $status = "ok";
    protected int $status_code = 200;

    /**
     * Set Data
     *
     * @param mixed $data
     * @return self
     */
    public function setData($data) : self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Set API Response Status
     *
     * @param string $status
     * @param integer $statusCode
     * @return self
     */
    public function setStatus(string $status, int $statusCode = 200) : self
    {
        $this->status_code = $statusCode;
        $this->status = $status;

        return $this;
    }

    /**
     * Response Send Response
     *
     * @return ResponseInterface
     */
    public function send() : ResponseInterface
    {
        $this->setStatusCode($this->status_code);
        $this->setJsonContent(
            array_merge_recursive(
                [
                'status'=> $this->status,
            ],
                $this->data ?: []
            )
        );
        
        return parent::send();
    }
}
