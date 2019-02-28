<?php
use Illuminate\Http\Exceptions\HttpResponseException;

if(!function_exists('freeRedirect')){

  function freeRedirect($to = '/'){

        throw new HttpResponseException(redirect($to));
  }

}
