<?php

/**
 *  Generate Random keys based from a pattern of string
 *
 *	Copyright (c) Andrew Aculana <andrew.aculana@movent.com>
 *
 *	Permission is hereby granted, free of charge, to any person obtaining a copy
 *	of this software and associated documentation files (the "Software"), to deal
 *	in the Software without restriction, including without limitation the rights
 *	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *	copies of the Software, and to permit persons to whom the Software is furnished
 *	to do so, subject to the following conditions:
 *
 *	The above copyright notice and this permission notice shall be included in all
 *	copies or substantial portions of the Software.
 *
 *	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * 	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *	THE SOFTWARE.
 */

namespace Keygen\Utility\Output;

class CsvOutput implements OutputInterface {
	
	protected $outputPath;
	
	public function __construct($outputPath = '') {
		$this->outputPath = $outputPath;
	}
	
	/**
	 * Return an array of keys
	 * 
	 * @param array $keys
	 * @return array
	 */
	public function render(array $keys = array())
	{
		if (!empty($this->outputPath)) {
			$filename = md5(serialize($keys));
			file_put_contents(sprintf("%s/%s.csv",$this->outputPath, $filename), implode("\r\n",$keys));
		}
		return $keys;
	}
}
