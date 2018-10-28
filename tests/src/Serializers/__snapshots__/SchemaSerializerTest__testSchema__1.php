<?php return '"""
Define Entity interface
"""
interface Entity {
  id: ID!
  name: String
}

"""
Define custom Url scalar
"""
scalar Url

"""
User type implements Entity interface
"""
type User implements Entity {
  id: ID!
  name: String
  age: Int
  balance: Float
  isActive: Boolean
  friends: [User]!
  homepage: Url
}

"""
Root query type
"""
type Query {
  me: User
}

';
