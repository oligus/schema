# GraphQL Schema

GraphQL schema library.

[![Build Status](https://travis-ci.org/oligus/schema.svg?branch=master)](https://travis-ci.org/oligus/schema)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Codecov.io](https://codecov.io/gh/oligus/schema/branch/master/graphs/badge.svg)](https://codecov.io/gh/oligus/schema)

## Contents
[Types](README.md#types)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Type modifiers](README.md#type-modifiers)<br />
[Fields](README.md#fields)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Arguments](README.md#arguments)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Argument values](README.md#argument-values)<br />
[Development](README.md#development)<br />


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

#### Definition
`TypeModifier(?bool $nullable, ?bool $listable, ?bool $nullableList)`

*Modifiers*
Type                            | Syntax      | Example
--------------------------------| ----------- | -------
Nullable Type                   | \<type>     | String
Non-null Type                   | \<type>!    | String!
List Type                       | [\<type>]   | [String]
List of Non-null Types          | [\<type>!]  | [String!]
Non-null List Type              | [\<type>]!  | [String]!
Non-null List of Non-null Types | [\<type>!]! | [String!]!

#### Examples

```php
$typeModifier = new TypeModifier($nullable = false, $listable = true, $nullableList = false);
$type = new BooleanType($typeModifier);
```

*Result:*
```graphql
[bool!]!
```

### Scalar types

*Example:*

```php
$type = new BooleanType(); // Yields Bool
echo $type; 
```

### Interface type

*Example:*

```php
$fields = new FieldCollection();
$fields->add(new Field('name', new StringType()));
$fields->add(new Field('age', new IntegerType()));
$fields->add(new Field('size', new IntegerType()));

$interface = new InterfaceType('Wine', $fields, 'My interface description');
```
// Yields

```graphql
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

A selection set is primarily composed of fields. A field describes one discrete piece of information available to request within a selection set.

[GrapQL Spec](https://facebook.github.io/graphql/June2018/#sec-Language.Fields)

#### Definition
`Field(string $name, Type $type)`

#### Examples

```php
$field = new Field('simpleField', new IntegerType());
```

*Result:*
```graphql
simpleField: Int
```

*With type modifier:*
```php
$field = new Field('simpleField', new IntegerType(new TypeModifier($nullable = false));
```

*Result:*
```graphql
simpleField: Int!
```

*Collection of fields:*
```php
$fields = new FieldCollection();
$fields->add(new Field('name', new StringType()));
$fields->add(new Field('age', new IntegerType()));
$fields->add(new Field('size',  new IntegerType()));
```

*Result:*
```graphql
name: String
age: Int
size: Int
```

### Arguments

Fields are conceptually functions which return values, and occasionally accept arguments which alter their behavior. These arguments often map directly to function arguments within a GraphQL server’s implementation.

[GrapQL Spec](https://facebook.github.io/graphql/June2018/#sec-Language.Arguments)

#### Definition
`Argument(string $name, Type $type, Value $defaultVale)`

#### Examples

```php
$argument = new Argument('booleanArg', new BooleanType());
```

*Result:*
```graphql
booleanArg: Boolean
```

*With type default value:*
```php
$argument = new Argument('intArg', new IntegerType(), new ValueInteger(0));
```

*Result:*
```graphql
intArg: Int = 0
```

*Collection of arguments:*
```php
$arguments = new ArgumentCollection();
$arguments->add(new Argument(new BooleanType(new TypeModifier($nullable = false)), null, 'booleanArg'));
$arguments->add(new Argument(new IntegerType(new TypeModifier($nullable = false)), null, 'integerArg'));
$arguments->add(new Argument(new StringType(new TypeModifier($nullable = false)), new ValueString('test'), 'stringArg'));
```

*Result:*
```graphql
booleanArg: Boolean!, integerArg: Int!, stringArg: String! = "test"
```

### Argument values

Set simple scalar values for default values in arguments. 

#### Definition
`Value(mixed $value)`

*Available values:*
`ValueBoolean, ValueFloat, ValueInteger, ValueNull, ValueString`

#### Examples

```php
$bool = new ValueBoolean(true);
$bool->getValue(); // true
echo $bool; // 'true'
```

## Development

Download and build docker container

```bash
$ make
```

Access docker image
```bash
$  make bash
```
