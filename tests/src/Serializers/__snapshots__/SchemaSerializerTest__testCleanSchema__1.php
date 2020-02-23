<?php return 'directive @upper on FIELD

directive @lower on FIELD

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
';
