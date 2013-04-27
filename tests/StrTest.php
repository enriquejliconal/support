<?php namespace Orchestra\Support\Tests;

use Orchestra\Support\Str;

class StrTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Test the Orchestra\Support\Str::title method.
	 *
	 * @test
	 */
	public function testStringCanBeConvertedToTitleCase()
	{
		$this->assertEquals('Taylor', Str::title('taylor'));
		$this->assertEquals('Άχιστη', Str::title('άχιστη'));
	}

	/**
	 * Test Orchestra\Support\Str::streamGetContents() method.
	 *
	 * @test
	 */
	public function testStreamGetContentsMethod()
	{
		$base_path = __DIR__.'/stub/';
		$expected  = 'a:2:{s:4:"name";s:9:"Orchestra";s:5:"theme";a:2:{s:7:"backend";s:7:"default";s:8:"frontend";s:7:"default";}}';
		$stream    = fopen($base_path.'driver1.stub.php', 'r');
		$output    = Str::streamGetContents($stream);

		$this->assertEquals($expected, $output);

		$expected = array(
			'name'  => 'Orchestra',
			'theme' => array(
				'backend' => 'default',
				'frontend' => 'default',
			),
		);

		$this->assertEquals($expected, unserialize($output));

		$expected = 'a:2:{s:4:"name";s:9:"Orchestra";s:5:"theme";a:2:{s:7:"backend";s:7:"default";s:8:"frontend";s:7:"default";}}'."\n";
		$stream   = fopen($base_path.'driver2.stub.php', 'r');
		$output   = Str::streamGetContents($stream);

		$this->assertEquals($expected, $output);

		$expected = array(
			'name'  => 'Orchestra',
			'theme' => array(
				'backend'  => 'default',
				'frontend' => 'default',
			),
		);

		$this->assertEquals($expected, unserialize($output));
	}
}
