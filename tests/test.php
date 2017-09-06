<?php
require __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class PhpExceptionHelperTest extends TestCase
{
  private $ex1, $ex2, $ex3;

  public function setUp()
  {
    $this->ex1 = new Exception("Exception 1", 1);
    $this->ex2 = new Exception("Exception 2", 2, $this->ex1);
    $this->ex3 = new Exception("Exception 3", 3, $this->ex2);
  }

  public function testTraceMessage()
  {
    $this->assertTrue(trace_message($this->ex1) === "Exception 1");
    $this->assertTrue(trace_message($this->ex2) === "Exception 2\nException 1");
    $this->assertTrue(trace_message($this->ex3) === "Exception 3\nException 2\nException 1");
    
  }

  public function testTraceException()
  {
    // assert message and stacktrace
    $this->assertContains("Exception 1", trace_exception($this->ex1));
    $this->assertContains("setUp", trace_exception($this->ex1));

    $this->assertContains("Exception 1", trace_exception($this->ex2));
    $this->assertContains("Exception 2", trace_exception($this->ex2));
    $this->assertContains("setUp", trace_exception($this->ex2));

    $this->assertContains("Exception 1", trace_exception($this->ex3));
    $this->assertContains("Exception 2", trace_exception($this->ex3));
    $this->assertContains("Exception 3", trace_exception($this->ex3));
    $this->assertContains("setUp", trace_exception($this->ex3));
  }

  /**
   * @expectedException Exception
   */
  public function testThrowIf()
  {
    throw_if(true, new Exception());
  }

  public function testThrowIfFalse()
  {
    throw_if(false, new Exception());
  }

  /**
   * @expectedException Exception
   */
  public function testThrowUnless()
  {
    throw_unless(false, new Exception());
  }

  public function testThrowUnlessTrue()
  {
    throw_unless(true, new Exception());
  }
}
