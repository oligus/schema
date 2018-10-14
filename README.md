# GraphQL Schema

GraphQL schema library.

[![Build Status](https://travis-ci.org/oligus/schema.svg?branch=master)](https://travis-ci.org/oligus/schema)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Codecov.io](https://codecov.io/gh/oligus/schema/branch/master/graphs/badge.svg)](https://codecov.io/gh/oligus/schema)

## Types

*Available types:*

```php
GQLSchema\Types\Scalars\BooleanType
GQLSchema\Types\Scalars\FloatType
GQLSchema\Types\Scalars\IDType
GQLSchema\Types\Scalars\IntegerType
GQLSchema\Types\Scalars\StringType
GQLSchema\Types\InterfaceType
```

### Type modifiers

Type modifiers are used in conjunction with types, add modifier to a type to modify the type in question.

Type                            | Syntax      | Example
--------------------------------| ----------- | -------
Nullable Type                   | \<type>     | String
Non-null Type                   | \<type>!    | String!
List Type                       | [\<type>]   | [String]
List of Non-null Types          | [\<type>!]  | [String!]
Non-null List Type              | [\<type>]!  | [String]!
Non-null List of Non-null Types | [\<type>!]! | [String!]!

*Example:*
```php
$typeModifier = new TypeModifier($nullable = false, $listable = true, $nullableList = false);
$type = new BooleanType($typeModifier);

echo $type->__toString(); // [bool!]!
```

### Scalar types

*Example:*

```php
$type = new BooleanType();
echo $type->__toString(); // Bool
```

### Interface type

*Example:*

```php
$fields = new FieldCollection();
$fields->add(new Field(new StringType(), null, 'name'));
$fields->add(new Field(new IntegerType(), null, 'age'));
$fields->add(new Field(new IntegerType(), null, 'size'));

$interface = new InterfaceType('Wine', $fields, 'My interface description');

// Yields
"""
My interface description
"""
interface Wine {
  name: String  
  age: Int
  size: Int
}
```

## Fields

*Example:*

```php
// Simple
$field = new Field(new IntegerType(), new ArgumentCollection(), 'simpleField');
$field->__toString(); // simpleField: Int

// With arguments        
$arguments = new ArgumentCollection();
$arguments->add(new Argument(new BooleanType(new TypeModifier($nullable = false)), null, 'booleanArg'));
$arguments->add(new Argument(new IntegerType(new TypeModifier($nullable = false)), null, 'integerArg'));
$arguments->add(new Argument(new StringType(new TypeModifier($nullable = false)), new ValueString('test'), 'stringArg'));

$field = new Field(new IntegerType(new TypeModifier(false)), $arguments, 'testField');
echo $field->__toString(); // testField(booleanArg: Boolean!, integerArg: Int!, stringArg: String! = "test"): Int!'

```

## Arguments

Create arguments

*Example:*

```php
// Boolean with no default value
$arg = new Argument(new BooleanType(), null, 'argName');
echo $arg->__toString(); // argName: Boolean

// Boolean collection non nullable
$arg = new Argument(new BooleanType(new TypeModifier($nullable = true, $listable = true, $nullableList = false), null, 'argName');
echo $arg->__toString(); // argName: [Boolean]!

// Boolean with default value
$arg = new Argument(new BooleanType(), new ValueBoolean(false), 'argName');
echo $arg->__toString(); // argName: Boolean = false

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
echo $bool->__asString(); // 'true'

$float = new ValueFloat(23.45);
$float->getValue(); // 23.45
echo $float->__asString(); // '23.45'

$int = new ValueInteger(5);
$float->getValue(); // 5
echo $float->__asString(); // '5'

$null = new ValueNull();
$null->getValue(); // null
echo $null->__asString(); // 'null'

$string = new ValueString('test string);
$string->getValue(); // 'test string'
echo $string->__asString(); // '"test string"'
```
