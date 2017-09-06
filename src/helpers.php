<?php
if (!function_exists('trace_message')) {
  /**
   * Returns a string that combined all exception messages.
   *
   * @return string message
   */
  function trace_message($throwable)
  {
    $ex = $throwable;
    $message = "";
    do {
      $message .= $ex->getMessage();
      $message .= "\n";
    } while (($ex = $ex->getPrevious()) != null);
    return trim($message);
  }
}

if (!function_exists('trace_exception')) {
  /**
   * Returns a string that combined all exception stacktrace
   *
   * @return string stacktrace
   */
  function trace_exception($throwable)
  {
    $ex = $throwable;
    $message = "";
    do {
      $message .= $ex->getMessage();
      $message .= "\n";
      $message .= $ex->getTraceAsString();
      $message .= "\n";
    } while (($ex = $ex->getPrevious()) != null);
    return trim($message)."\n";
  }
}

if (!function_exists('ddex')) {
  /**
   * Dump the exception and exit.
   */
  function ddex($throwable)
  {
    echo trace_exception($throwable);
    die();
  }
}

if (!function_exists('throw_if')) {
  function throw_if($b, $exception)
  {
    if ($b) {
      throw $exception;
    }
  }
}

if (!function_exists('throw_unless')) {
  function throw_unless($b, $exception)
  {
    if (!$b) {
      throw $exception;
    }
  }
}
