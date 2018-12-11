<?php
namespace App\Exceptions;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Debug\Exception\FlattenException;
use Request;
use Response;
use Illuminate\Auth\AuthenticationException;
class Handler extends ExceptionHandler
{
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $guard = array_get($exception->guards(), 0);
        switch ($guard) {
            case 'admin':
                $login = 'admin.login';
                break;
            default:
               $login = 'login';
                break;
        }
        return redirect()->guest(route($login));
    }
    // protected function convertExceptionToResponse(Exception $e)
    // {
    //     $e = FlattenException::create($e);
    //     return response()->view('errors.500', ['exception' => $e], $e->getStatusCode(), $e->getHeaders());
    // }
        // public function render($request, Exception $e)
        // {
        
        //     // 404 page when a model is not found
        //     if ($e instanceof ModelNotFoundException) {
        //         return response()->view('errors.404', [], 404);
        //     }
        
        //     // custom error message
        //     if ($e instanceof \ErrorException) {
        //         return response()->view('errors.500', [], 500);
        //     } else {
        //         return parent::render($request, $e);
        //     }
        
        //     return parent::render($request, $e);
        // }
}
