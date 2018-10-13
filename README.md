# schema
Object oriented GraphQL schema

[![Build Status](https://travis-ci.org/oligus/schema.svg?branch=master)](https://travis-ci.org/oligus/schema)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Codecov.io](https://codecov.io/gh/oligus/schema/branch/master/graphs/badge.svg)](https://codecov.io/gh/oligus/schema)



## Values

Set simple scalar values for default values in the schema. 

*Available values:*

```php
GQLSchema\Values\ValueBoolean
GQLSchema\Values\ValueFloat
GQLSchema\Values\ValueInteger
GQLSchema\Values\ValueNull
GQLSchema\Values\ValueString
```

*Example:*

```php
$bool = new ValueBoolean(true);
$bool->getValue(); // true
$bool->__asString(); // 'true'

$float = new ValueFloat(23.45);
$float->getValue(); // 23.45
$float->__asString(); // '23.45'

$int = new ValueInteger(5);
$float->getValue(); // 5
$float->__asString(); // '5'

$null = new ValueNull();
$null->getValue(); // null
$null->__asString(); // 'null'

$string = new ValueString('test string);
$string->getValue(); // 'test string'
$string->__asString(); // '"test string"'
```