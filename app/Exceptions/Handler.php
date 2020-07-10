<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;



class Handler extends ExceptionHandler
{
    use ResponseTrait;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        return parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // dd($exception);
        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->error('The specified method for the request is invalid', 405);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->error('The specified URL cannot be found', 404);
        }

        if ($exception instanceof ModelNotFoundException) {
            return $this->error('The specified model cannot be found', 404);
        }

        if ($exception instanceof HttpException) {
            return $this->error($exception->getMessage(), $exception->getStatusCode());
        }
        
        return parent::render($request, $exception);
    }
}
