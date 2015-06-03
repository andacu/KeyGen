<?php

/**
 *  Generate Random keys based from a pattern of string
 *
 *	Copyright (c) Andrew Aculana <andrew.aculana@groupm.com>
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
 
namespace Keygen\Utility\Generator;
 
class KeyGenerator {
	
	const MAX_ITERATION_COUNT = 30;
	const DEFAULT_PATTERN     = '0123456789abcdefhjkmnpqrtuvwxy';
	
	private $keyBuffer    = array();
	private $pattern      = self::DEFAULT_PATTERN;
	private $maxIteration = self::MAX_ITERATION_COUNT;
	
	/**
	 * 
	 * @param string $pattern
	 * @param integer $maxIteration
	 */
	public function __construct($pattern = self::DEFAULT_PATTERN, $maxIteration = self::MAX_ITERATION_COUNT)
	{
		$this->pattern      = $pattern;
		$this->maxIteration = $maxIteration;
		$this->keyBuffer    = array();
	}

	/**
	 * Generate key
	 * 
	 * @param integer $length
	 * @return string
	 */
	public function generateKey($length = 10) 
	{
		$randStr    = '';
		$charLength = strlen($this->pattern);
		for ($i = 0; $i < $length; $i++) {
			$randStr .= $this->pattern[rand(0, $charLength - 1)];
		}
		return $randStr;
	}
	
	/**
	 * Generate an array of unique keys
	 * 
	 * @param integer $length
	 * @param integer $total
	 * @return array
	 */
	public function generateUniqueKeys($length, $total = 10)
	{
		$this->keyBuffer = array();
		$keys = array();
		for ($i = 0; $i < $total; $i++) {
			$keys[] = $this->getUniqueKey($length);
		}
		return $keys;
	}
	
	/**
	 * Generate a unique key, throws Exception after max iteration reach
	 * 
	 * @param integer $length
	 * @return string
	 * @throws \Exception
	 */
	protected function getUniqueKey($length)
	{
		$tries = 0;
		while(true) {
			$key = $this->generateKey($length);
			if (!($this->keyInBuffer($key))) {
				return $key;
			}
			$this->keyBuffer[] = $key;
			if ($this->maxIteration <= $tries) {
				throw new \Exception(sprintf('Unable to generate unique key after %s of iteration', $this->maxIteration));
			} 
			$tries++;
		}
	}
	
	/**
	 * Check if key exist in key buffer
	 * 
	 * @param string $key
	 * @return boolean
	 */
	protected function keyInBuffer($key = '')
	{
		if (isset($this->keyBuffer[$key])) {
			return true;
		}
		return false;
	}
}
