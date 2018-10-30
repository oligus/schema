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
My union description
"""
union MyUnion = Dog | Cat | Bird

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
  friends(limit: Int = 10): [User]!
}

"""
Root mutation type
"""
type Mutation {
  users(params: ListUsersInput): [User]!
}

"""
Custom complex input type
"""
input ListUsersInput {
  limit: Int
  since_id: ID
}

schema {
  query: Query
  mutation: Mutation
}
';
