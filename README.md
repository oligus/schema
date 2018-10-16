# GraphQL Schema

GraphQL schema library.

[![Build Status](https://travis-ci.org/oligus/schema.svg?branch=master)](https://travis-ci.org/oligus/schema)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Codecov.io](https://codecov.io/gh/oligus/schema/branch/master/graphs/badge.svg)](https://codecov.io/gh/oligus/schema)

## Schema

### API
Method       | Parameters
-------------| ---------------- 
addInterface | InterfaceType

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

echo $type; // [bool!]!
```

### Scalar types

*Example:*

```php
$type = new BooleanType();
echo $type; // Bool
```

### Interface type

*Example:*

```php
$fields = new FieldCollection();
$fields->add(new Field('name', new StringType()));
$fields->add(new Field('age', new IntegerType()));
$fields->add(new Field('size', new IntegerType()));

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

### Object type

*Example:*

```php
$fields = new FieldCollection();
$fields->add(new Field('name', new StringType()));
$fields->add(new Field('age', new IntegerType()));
$fields->add(new Field('size', new IntegerType()));

$object = new ObjectType('Wine', $fields, 'My object description');

echo $object;

// Yields
type Wine {
  name: String
  age: Int
  size: Int
}

// Add interface

$fields = new FieldCollection();
$fields->add(new Field('name', new StringType()));

$interface = new InterfaceType('Name', $fields);
$object->addInterface($interface);

echo $object;

// Yields
type Wine implements Name {
  name: String
  age: Int
  size: Int
}
```
## Fields

*Example:*

```php
// Simple
$field = new Field('simpleField', new IntegerType());
echo $field; // simpleField: Int

// With arguments        
$arguments = new ArgumentCollection();
$arguments->add(new Argument(new BooleanType(new TypeModifier($nullable = false)), null, 'booleanArg'));
$arguments->add(new Argument(new IntegerType(new TypeModifier($nullable = false)), null, 'integerArg'));
$arguments->add(new Argument(new StringType(new TypeModifier($nullable = false)), new ValueString('test'), 'stringArg'));

$field = new Field('testField', new IntegerType(new TypeModifier(false)), $arguments);
echo $field; // testField(booleanArg: Boolean!, integerArg: Int!, stringArg: String! = "test"): Int!'

```

## Arguments

Create arguments

*Example:*

```php
// Boolean with no default value
$arg = new Argument(new BooleanType(), null, 'argName');
echo $arg; // argName: Boolean

// Boolean collection non nullable
$arg = new Argument(new BooleanType(new TypeModifier($nullable = true, $listable = true, $nullableList = false), null, 'argName');
echo $arg; // argName: [Boolean]!

// Boolean with default value
$arg = new Argument(new BooleanType(), new ValueBoolean(false), 'argName');
echo $arg; // argName: Boolean = false

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
echo $bool; // 'true'

$float = new ValueFloat(23.45);
$float->getValue(); // 23.45
echo $float; // '23.45'

$int = new ValueInteger(5);
$float->getValue(); // 5
echo $float; // '5'

$null = new ValueNull();
$null->getValue(); // null
echo $null; // 'null'

$string = new ValueString('test string);
$string->getValue(); // 'test string'
echo $string; // '"test string"'
```

## Development

Download and build docker container

```bash
$ make
```

Access docker image
```bash
$  docker exec -it schema_php-cli_1 bash
```
