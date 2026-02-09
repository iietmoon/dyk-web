<?php

namespace App\Enums;

use Illuminate\Http\JsonResponse;

enum HttpStatusCode: int
{
    // 1xx - Information
    case Continue = 100;
    case SwitchingProtocols = 101;
    case Processing = 102;
    case EarlyHints = 103;

    // 2xx - Successful
    case OK = 200;
    case Created = 201;
    case Accepted = 202;
    case NonAuthoritativeInformation = 203;
    case NoContent = 204;
    case ResetContent = 205;
    case PartialContent = 206;
    case MultiStatus = 207;
    case AlreadyReported = 208;
    case ThisIsFine = 218;
    case IMUsed = 226;

    // 3xx - Redirection
    case MultipleChoices = 300;
    case MovedPermanently = 301;
    case Found = 302;
    case SeeOther = 303;
    case NotModified = 304;
    case SwitchProxy = 306;
    case TemporaryRedirect = 307;
    case ResumeIncomplete = 308;

    // 4xx - Client Error
    case BadRequest = 400;
    case Unauthorized = 401;
    case PaymentRequired = 402;
    case Forbidden = 403;
    case NotFound = 404;
    case MethodNotAllowed = 405;
    case NotAcceptable = 406;
    case ProxyAuthenticationRequired = 407;
    case RequestTimeout = 408;
    case Conflict = 409;
    case Gone = 410;
    case LengthRequired = 411;
    case PreconditionFailed = 412;
    case RequestEntityTooLarge = 413;
    case RequestURITooLong = 414;
    case UnsupportedMediaType = 415;
    case RequestedRangeNotSatisfiable = 416;
    case ExpectationFailed = 417;
    case ImATeapot = 418;
    case PageExpired = 419;
    case MethodFailure = 420;
    case MisdirectedRequest = 421;
    case UnprocessableEntity = 422;
    case Locked = 423;
    case FailedDependency = 424;
    case UpgradeRequired = 426;
    case PreconditionRequired = 428;
    case TooManyRequests = 429;
    case RequestHeaderFieldsTooLarge = 431;
    case LoginTimeout = 440;
    case ConnectionClosedWithoutResponse = 444;
    case RetryWith = 449;
    case BlockedByWindowsParentalControls = 450;
    case UnavailableForLegalReasons = 451;
    case RequestHeaderTooLarge = 494;
    case SSLCertificateError = 495;
    case SSLCertificateRequired = 496;
    case HTTPRequestSentToHTTPSPort = 497;
    case InvalidToken = 498;
    case ClientClosedRequest = 499;

    // 5xx - Server Error
    case InternalServerError = 500;
    case NotImplemented = 501;
    case BadGateway = 502;
    case ServiceUnavailable = 503;
    case GatewayTimeout = 504;
    case HTTPVersionNotSupported = 505;
    case VariantAlsoNegotiates = 506;
    case InsufficientStorage = 507;
    case LoopDetected = 508;
    case BandwidthLimitExceeded = 509;
    case NotExtended = 510;
    case NetworkAuthenticationRequired = 511;
    case UnknownError = 520;
    case WebServerIsDown = 521;
    case ConnectionTimedOut = 522;
    case OriginIsUnreachable = 523;
    case ATimeoutOccurred = 524;
    case SSLHandshakeFailed = 525;
    case InvalidSSLCertificate = 526;
    case RailgunListenerToOriginError = 527;
    case OriginDNSError = 530;
    case NetworkReadTimeoutError = 598;

    /**
     * Human-readable message for the status code.
     */
    public function message(): string
    {
        return match ($this) {
            self::Continue => 'Continue',
            self::SwitchingProtocols => 'Switching Protocols',
            self::Processing => 'Processing',
            self::EarlyHints => 'Early Hints',
            self::OK => 'OK',
            self::Created => 'Created',
            self::Accepted => 'Accepted',
            self::NonAuthoritativeInformation => 'Non-Authoritative Information',
            self::NoContent => 'No Content',
            self::ResetContent => 'Reset Content',
            self::PartialContent => 'Partial Content',
            self::MultiStatus => 'Multi-Status',
            self::AlreadyReported => 'Already Reported',
            self::ThisIsFine => 'This is fine (Apache Web Server)',
            self::IMUsed => 'IM Used',
            self::MultipleChoices => 'Multiple Choices',
            self::MovedPermanently => 'Moved Permanently',
            self::Found => 'Found',
            self::SeeOther => 'See Other',
            self::NotModified => 'Not Modified',
            self::SwitchProxy => 'Switch Proxy',
            self::TemporaryRedirect => 'Temporary Redirect',
            self::ResumeIncomplete => 'Resume Incomplete',
            self::BadRequest => 'Bad Request',
            self::Unauthorized => 'Unauthorized',
            self::PaymentRequired => 'Payment Required',
            self::Forbidden => 'Forbidden',
            self::NotFound => 'Not Found',
            self::MethodNotAllowed => 'Method Not Allowed',
            self::NotAcceptable => 'Not Acceptable',
            self::ProxyAuthenticationRequired => 'Proxy Authentication Required',
            self::RequestTimeout => 'Request Timeout',
            self::Conflict => 'Conflict',
            self::Gone => 'Gone',
            self::LengthRequired => 'Length Required',
            self::PreconditionFailed => 'Precondition Failed',
            self::RequestEntityTooLarge => 'Request Entity Too Large',
            self::RequestURITooLong => 'Request-URI Too Long',
            self::UnsupportedMediaType => 'Unsupported Media Type',
            self::RequestedRangeNotSatisfiable => 'Requested Range Not Satisfiable',
            self::ExpectationFailed => 'Expectation Failed',
            self::ImATeapot => "I'm a teapot",
            self::PageExpired => 'Page Expired (Laravel Framework)',
            self::MethodFailure => 'Method Failure (Spring Framework)',
            self::MisdirectedRequest => 'Misdirected Request',
            self::UnprocessableEntity => 'Unprocessable Entity',
            self::Locked => 'Locked',
            self::FailedDependency => 'Failed Dependency',
            self::UpgradeRequired => 'Upgrade Required',
            self::PreconditionRequired => 'Precondition Required',
            self::TooManyRequests => 'Too Many Requests',
            self::RequestHeaderFieldsTooLarge => 'Request Header Fields Too Large',
            self::LoginTimeout => 'Login Time-out',
            self::ConnectionClosedWithoutResponse => 'Connection Closed Without Response',
            self::RetryWith => 'Retry With',
            self::BlockedByWindowsParentalControls => 'Blocked by Windows Parental Controls',
            self::UnavailableForLegalReasons => 'Unavailable For Legal Reasons',
            self::RequestHeaderTooLarge => 'Request Header Too Large',
            self::SSLCertificateError => 'SSL Certificate Error',
            self::SSLCertificateRequired => 'SSL Certificate Required',
            self::HTTPRequestSentToHTTPSPort => 'HTTP Request Sent to HTTPS Port',
            self::InvalidToken => 'Invalid Token (Esri)',
            self::ClientClosedRequest => 'Client Closed Request',
            self::InternalServerError => 'Internal Server Error',
            self::NotImplemented => 'Not Implemented',
            self::BadGateway => 'Bad Gateway',
            self::ServiceUnavailable => 'Service Unavailable',
            self::GatewayTimeout => 'Gateway Timeout',
            self::HTTPVersionNotSupported => 'HTTP Version Not Supported',
            self::VariantAlsoNegotiates => 'Variant Also Negotiates',
            self::InsufficientStorage => 'Insufficient Storage',
            self::LoopDetected => 'Loop Detected',
            self::BandwidthLimitExceeded => 'Bandwidth Limit Exceeded',
            self::NotExtended => 'Not Extended',
            self::NetworkAuthenticationRequired => 'Network Authentication Required',
            self::UnknownError => 'Unknown Error',
            self::WebServerIsDown => 'Web Server Is Down',
            self::ConnectionTimedOut => 'Connection Timed Out',
            self::OriginIsUnreachable => 'Origin Is Unreachable',
            self::ATimeoutOccurred => 'A Timeout Occurred',
            self::SSLHandshakeFailed => 'SSL Handshake Failed',
            self::InvalidSSLCertificate => 'Invalid SSL Certificate',
            self::RailgunListenerToOriginError => 'Railgun Listener to Origin Error',
            self::OriginDNSError => 'Origin DNS Error',
            self::NetworkReadTimeoutError => 'Network Read Timeout Error',
        };
    }

    /**
     * Get enum case by HTTP status code (e.g. 401).
     * Returns null if code is not defined.
     */
    public static function fromCode(int $code): ?self
    {
        return self::tryFrom($code);
    }

    /**
     * Structured array for API: code + message.
     *
     * @return array{code: int, message: string}
     */
    public function toArray(): array
    {
        return [
            'code' => $this->value,
            'message' => $this->message(),
        ];
    }

    /**
     * JSON string with code and message.
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }

    /**
     * Laravel JSON response with optional extra data.
     *
     * @param  array<string, mixed>  $extra  Optional keys to merge into the response body (e.g. ['data' => $user]).
     */
    public function toResponse(array $extra = []): JsonResponse
    {
        return response()->json(array_merge($this->toArray(), $extra), $this->value);
    }
}
