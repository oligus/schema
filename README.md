# GraphQL Schema

GraphQL schema library.

[![Build Status](https://travis-ci.org/oligus/schema.svg?branch=master)](https://travis-ci.org/oligus/schema)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Codecov.io](https://codecov.io/gh/oligus/schema/branch/master/graphs/badge.svg)](https://codecov.io/gh/oligus/schema)

## Contents
[Types](README.md#types)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Type modifiers](#type-modifiers)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Scalar](README.md#scalar)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Built in scalar types](README.md#built-in-scalar-types)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Objects](README.md#objects)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Interfaces](README.md#interfaces)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Enums](README.md#enums)<br />
[Fields](README.md#fields)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Arguments](README.md#arguments)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Argument values](README.md#argument-values)<br />
[Development](README.md#development)<br />


## Types

The fundamental unit of any GraphQL Schema is the type. There are six kinds of named type definitions in GraphQL, and two wrapping types.

[GrapQL Spec](https://facebook.github.io/graphql/June2018/#sec-Types)

*Available types:*

```php
ScalarType

BooleanType
FloatType
IDType
IntegerType
StringType

InterfaceType
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

### Scalar

Scalar types represent primitive leaf values in a GraphQL type system. GraphQL responses take the form of a hierarchical tree; the leaves on these trees are GraphQL scalars.

[GrapQL Spec](https://facebook.github.io/graphql/June2018/#sec-Scalars)

#### Definition
`Scalar(string $name, ?string $description)`

#### Examples
```php
$scalar = new ScalarType('Url', 'Url description');
```

*Result:*
```graphql
"""
Url description
"""
scalar Url
```

### Built in scalar types

GraphQL provides a basic set of well‐defined Scalar types. A GraphQL server should support all of these types.

**Built in types:** *Boolean, Float, ID, Integer, String*

[GrapQL Spec](https://facebook.github.io/graphql/June2018/#sec-Scalars)

#### Definition
`<TYPE>Type(?TypeModifier $modifier)`

Where \<**TYPE**> is Boolean, Float, ID, Integer or String

#### Examples

```php
$type = new BooleanType();
```

*Result:*
```graphql
Boolean
```

### Objects

GraphQL queries are hierarchical and composed, describing a tree of information. While Scalar types describe the leaf values of these hierarchical queries, Objects describe the intermediate levels.

[GrapQL Spec](https://facebook.github.io/graphql/June2018/#sec-Objects)

#### Definition
`ObjectType(string $name, ?string $description = null)`

#### Examples

```php
$object = new ObjectType('Wine');
$object->addField(new Field('name', new StringType()));
$object->addField(new Field('age', new IntegerType()));
$object->addField(new Field('size', new IntegerType()));
```

*Result:*
```graphql
type Wine {
  name: String
  age: Int
  size: Int
}
```
*Implement interface*
```php
$interface = new InterfaceType('Wine');
$interface->addField(new Field('name', new StringType()));
$object->implements($interface);
```

*Result:*
```graphql
type Wine implements Name {
  name: String
  age: Int
  size: Int
}
```

### Interfaces

GraphQL interfaces represent a list of named fields and their arguments. GraphQL objects can then implement these interfaces which requires that the object type will define all fields defined by those interfaces.

[GrapQL Spec](https://facebook.github.io/graphql/June2018/#sec-Interfaces)

#### Definition
`InterfaceType(string $name, ?string $description = null)`

#### Examples

```php
$interface = new InterfaceType('Wine');
$interface->addField(new Field('name', new StringType()));
$interface->addField(new Field('age', new IntegerType()));
$interface->addField(new Field('size', new IntegerType()));
```

*Result:*
```graphql
interface Wine {
  name: String  
  age: Int
  size: Int
}
```

### Unions

GraphQL Unions represent an object that could be one of a list of GraphQL Object types, but provides for no guaranteed fields between those types. They also differ from interfaces in that Object types declare what interfaces they implement, but are not aware of what unions contain them.

[GrapQL Spec](https://facebook.github.io/graphql/June2018/#sec-Unions)

#### Definitions
`UnionType(string $name, ?string $description = null)`

*Add object:*

`addObjectType(ObjectType $objectType): void`

#### Examples

```php
$union = new UnionType('Animals');
$union->addObjectType(new ObjectType('Dog'));
$union->addObjectType(new ObjectType('Cat'));
```

*Result:*
```graphql
union Animals = Dog | Cat
```

### Enums

GraphQL Enum types, like scalar types, also represent leaf values in a GraphQL type system. However Enum types describe the set of possible values.

[GrapQL Spec](https://facebook.github.io/graphql/June2018/#sec-Enums)

#### Definitions
`EnumType(string $name, ?string $description = null, array $enums = [])`

*Add enum:*

`add(string $enum)`

#### Examples

```php
$enum = new EnumType('Direction', 'Different directions', ['SOUTH', 'NORTH']);
$enum->addEnum('EAST');
$enum->addEnum('WEST');
```

*Result:*
```graphql
"""
Different directions
"""
enum Direction {
  SOUTH
  NORTH
  EAST
  WEST
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
$arguments->add(new Argument('booleanArg', new BooleanType(new TypeModifier($nullable = false))));
$arguments->add(new Argument('integerArg', new IntegerType(new TypeModifier($nullable = false))));
$arguments->add(new Argument('stringArg', new StringType(new TypeModifier($nullable = false)), new ValueString('test')));
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
