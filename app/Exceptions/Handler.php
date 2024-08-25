<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        if ($this->shouldReport($exception)) {
            Log::error($exception->getMessage(), [
                'exception' => $exception,
            ]);
            
            // Optional: send an email alert for critical errors
            if (app()->environment('production')) {
                Mail::raw('Critical Error: ' . $exception->getMessage(), function ($message) {
                    $message->to('admin@example.com')
                            ->subject('Critical Error Alert');
                });
            }
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        // Customize the response for different types of exceptions here

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return response()->json(['error' => $exception->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return parent::render($request, $exception);
    }
}
