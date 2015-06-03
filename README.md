# Key Generator
Generate Random keys based from a pattern of string
### Usage
```php
<?php

$keygen = new Keygen\Utility\Generator\KeyGenerator();
$csvOutput = new Keygen\Utility\Output\CsvOutput(__DIR__);

// Generate 10000 9 digit unique keys based from the default pattern 
// string '0123456789abcdefghijklmnopqrstuvwxyz'
// the result keys will also be written to a csv file using 
// the CsvOutput handler
$keys = $keygen->generateUniqueKeys(9, 10000, $csvOutput);

print_r $keys;
```
