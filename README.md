# GraphQL Schema

GraphQL schema library.

[![Build Status](https://travis-ci.org/oligus/schema.svg?branch=master)](https://travis-ci.org/oligus/schema)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Codecov.io](https://codecov.io/gh/oligus/schema/branch/master/graphs/badge.svg)](https://codecov.io/gh/oligus/schema)

## Install

```bash
$ composer require oligus/schema
```

## Contents
[Quick start](#quick-start)<br />
[Types](#types)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Type modifiers](#type-modifiers)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Scalar](#scalar)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Built in scalar types](#built-in-scalar-types)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Objects](#objects)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Interfaces](#interfaces)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Enums](#enums)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Inputs](#inputs)<br />
[Fields](#fields)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Arguments](#arguments)<br />
&nbsp;&nbsp;&nbsp;&nbsp;[Argument values](#argument-values)<br />
[Development](#development)<br />

## Quick start

```php
$schema = new Schema();
// Add directive
$directive = new DirectiveType('upper');
$directive->addLocation(ExecutableDirectiveLocation::FIELD());
$schema->addDirective($directive);

// Add interface
$interface = (new InterfaceType('Entity'))
    ->addField(new Field('id', new IDType(), new TypeModifier(false)))
    ->addField(new Field('name', new StringType()));
$schema->addInterface($interface);

// Add scalar
$scalar = new ScalarType('Url');
$schema->addScalar($scalar);

// Add object
$object = (new ObjectType('User'))
    ->addField(new Field('id', new IDType(), new TypeModifier(false)))
    ->addField(new Field('name', new StringType()))
    ->addField(new Field('age', new IntegerType()))
    ->addField(new Field('balance', new FloatType()))
    ->addField(new Field('isActive', new BooleanType()));

$object->addField(new Field('friends', $object, new TypeModifier(true, true, false)))
    ->addField(new Field('homepage', $scalar))
    ->implements($interface);

$schema->addObject($object);

// Add query object
$query =  (new ObjectType('Query'))
    ->addField(new Field('me', $object, new TypeModifier(true)));
$field = (new Field('friends', $object, new TypeModifier(true, true, false)))
    ->addArgument(new Argument('limit', new IntegerType(), new TypeModifier(), new ValueInteger(10)));
$query->addField($field);

$schema->addObject($query);

// Add input object
$input = (new InputType('ListUsersInput'))
    ->addField(new Field('limit', new IntegerType()))
    ->addField(new Field('since_id', new IDType()));

$schema->addInput($input);

// Add mutation object
$mutation =  new ObjectType('Mutation');
$field = (new Field('users', $object, new TypeModifier(true, true, false)))
    ->addArgument(new Argument('params', $input));
$mutation->addField($field);
$schema->addObject($mutation);

// Add union
$union = (new UnionType('MyUnion'))
    ->addObjectType(new ObjectType('Dog'))
    ->addObjectType(new ObjectType('Cat'))
    ->addObjectType(new ObjectType('Bird'));

$schema->addUnion($union);

// Set root types
$schema->setQuery($query);
$schema->setMutation($mutation);

$serializer = new SchemaSerializer();
$serializer->serialize($schema);
```

*Result:*
```graphql
directive @upper on FIELD

interface Entity {
  id: ID!
  name: String
}

scalar Url

union MyUnion = Dog | Cat | Bird

type User implements Entity {
  id: ID!
  name: String
  age: Int
  balance: Float
  isActive: Boolean
  friends: [User]!
  homepage: Url
}

type Query {
  me: User
  friends(limit: Int = 10): [User]!
}

type Mutation {
  users(params: ListUsersInput): [User]!
}

input ListUsersInput {
  limit: Int
  since_id: ID
}

schema {
  query: Query
  mutation: Mutation
}
```

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

## Type modifiers

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

## Scalar

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

## Enums

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

## Directives

A GraphQL schema describes directives which are used to annotate various parts of a GraphQL document as an indicator that they should be evaluated differently by a validator, executor, or client tool such as a code generator.

[GrapQL Spec](https://spec.graphql.org/June2018/#sec-Type-System.Directives)

#### Definitions
`EnumType(string $name, ?string $description = null, array $enums = [])`

*Add locations:*

`add(ExecutableDirectiveLocation $location)`

#### Examples

```php
$directive = new DirectiveType('example', 'Example directive');
$directive->addLocation(ExecutableDirectiveLocation::FIELD());
$directive->addLocation(ExecutableDirectiveLocation::INLINE_FRAGMENT());
```

*Result:*
```graphql
"""
Example directive
"""
directive @example on FIELD | FRAGMENT_SPREAD
```

## Inputs

Fields may accept arguments to configure their behavior. These inputs are often scalars or enums, but they sometimes need to represent more complex values.

[GrapQL Spec](https://facebook.github.io/graphql/June2018/#sec-Input-Objects)

#### Definition
`InputType(string $name, ?string $description = null)`

*Add field:*

`addField(Field $field): void`

#### Examples

```php
$object = new InputType('Animal');
$object->addField(new Field('name', new StringType()));
$object->addField(new Field('age', new IntegerType()));
$object->addField(new Field('weight', new IntegerType()));
```

*Result:*
```graphql
input Animal {
  name: String
  age: Int
  weight: Int
}
```

## Fields

A selection set is primarily composed of fields. A field describes one discrete piece of information available to request within a selection set.

[GrapQL Spec](https://facebook.github.io/graphql/June2018/#sec-Language.Fields)

#### Definition
`Field(string $name, Type $type, ?TypeModifier $typeModifier, ?string $description)`
        
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
$field = new Field('simpleField', new IntegerType(), new TypeModifier($nullable = false));
```

*Result:*
```graphql
simpleField: Int!
```

*With type argument:*
```php
$field = new Field('booleanListArgField', new BooleanType(), new TypeModifier(true, true));

$argument = new Argument('booleanListArg', new BooleanType(), new TypeModifier(true, true, false));
$field->addArgument($argument);
```

## Arguments

Fields are conceptually functions which return values, and occasionally accept arguments which alter their behavior. These arguments often map directly to function arguments within a GraphQL server’s implementation.

[GrapQL Spec](https://facebook.github.io/graphql/June2018/#sec-Language.Arguments)

#### Definition
`Argument(string $name, Type $type, ?TypeModifier $typeModifier, ?Value $defaultVale)`

#### Examples

```php
$argument = new Argument('booleanArg', new BooleanType());
```

*Result:*
```graphql
booleanArg: Boolean
```

*With type modifier:*
```php
$argument = new Argument('intArg', new IntegerType(), new TypeModifier(false));
// intArg: Int! = 0
```

*With type default value:*
```php
$argument = new Argument('intArg', new IntegerType(), null, new ValueInteger(0));
// intArg: Int = 0
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
