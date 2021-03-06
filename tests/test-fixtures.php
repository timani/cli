<?php
/**
 * Testing class for \Terminus\Utils
 *
 */
 use \Terminus\Fixtures;

// this test is a demo on why globals suck
class FixturesTest extends PHPUnit_Framework_TestCase {

 function testPutAndGet() {

   // this takes the place of the global argv
   $test = array( __FILE__, 'sites', 'show', '--site=dummy','--nocache' );

   $data = new stdClass;
   $data->file = __FILE__;
   $data->msg = "success";
   Fixtures::put($test, $data);

   // test manually
   $this->assertFileExists(CLI_ROOT.'/tests/fixtures/'.md5(serialize($test)));
   $content = unserialize(file_get_contents(CLI_ROOT.'/tests/fixtures/'.md5(serialize($test))));
   $this->assertInstanceOf( get_class($content), $content );
   $this->assertEquals( "success", $content->msg );

   // now test the get method
   $content = Fixtures::get($test);
   $this->assertInstanceOf( 'stdClass', $content );
   $this->assertEquals( "success", $content->msg );

 }

}
