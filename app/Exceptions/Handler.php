<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
    protected function unauthenticated($request , AuthenticationException $exception )
    {
    //   if($request->expectsJson()){
    //     return response()->json(['error' => 'Unauthenticated.'],401);
    //   }
    //
    //   if($request->is('admin') || $request->is('admin/*')){
    //     return redirect()->guest(route('adminLogin'));
    //   }
    //   if($request->is('company') || $request->is('company/*')){
    //     return redirect()->guest(route('companyLogin'));
    //   }
    //   return redirect()->guest(route('login'));
    // }
          $guard = array_get($exception->guards(), 0);
          switch ($guard){
            case 'admin':
            $login = 'adminLogin';
            break;
            case 'company':
            $login = 'companyLogin';
            break;
            case 'owner':
            $login = 'ownerLogin';
            break;
            case 'agent':
            $login = 'agentLogin';
            break;
            default:
            $login = 'login';
            break;
          }
          return redirect()->guest(route($login));
        }

}
