# schema
Object oriented GraphQL schema

[![Build Status](https://travis-ci.org/oligus/schema.svg?branch=master)](https://travis-ci.org/oligus/schema)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Codecov.io](https://codecov.io/gh/oligus/schema/branch/master/graphs/badge.svg)](https://codecov.io/gh/oligus/schema)

## Types

*Available types:*

```php
GQLSchema\Types\TypeBoolean
GQLSchema\Types\TypeFloat
GQLSchema\Types\TypeID
GQLSchema\Types\TypeInteger
GQLSchema\Types\TypeObject
GQLSchema\Types\TypeString
```

*Example:*

```php
$type = new TypeBoolean();
$type = new TypeObject('MyObject');
```
## Fields

*Example:*

```php
// Simple
$field = new Field(new TypeInteger(), new ArgumentCollection(), 'simpleField', true, false);
$field->__toString(); // simpleField: Int

// With arguments
$arguments = new ArgumentCollection();
$arguments->add(new Argument(new TypeBoolean(), null, 'booleanArg', false, false));
$arguments->add(new Argument(new TypeInteger(), null, 'integerArg', false, false));
$arguments->add(new Argument(new TypeString(), new ValueString('test'), 'stringArg', false));

$field = new Field(new TypeInteger(), $arguments, 'testField', false, false);
$field->__toString(); // testField(booleanArg: Boolean!, integerArg: Int!, stringArg: String! = "test"): Int!'

```

## Arguments

Create arguments

*Example:*

```php
// Boolean with no default value
$arg = new Argument(new TypeBoolean(), null, 'argName');
$arg->__toString(); // argName: Boolean

// Boolean collection non nullable
$arg = new Argument(new TypeBoolean(), null, 'argName', false, false);
$arg->__toString(); // argName: [Boolean]!

// Boolean with default value
$arg = new Argument(new TypeBoolean(), new ValueBoolean(false), 'argName', false, false);
$arg->__toString(); // argName: Boolean = false

```

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