# Run
* php hello_world.php


# Section 1
## Question A
* i. GET -> curl -X GET localhost:8181/api/v1/user -> get the list of users
* ii. POST -> curl -X POST -d "{"username":"name", "password":"password"}" localhost:8181/api/v1/user -> register a user (For creating)
* iii. UPDATE -> curl -X PUT -d "{"name":"new name"}" localhost:8181/api/v1/user -> updating user name (only for updating not creating)
* iv. PUT -> curl -X PUT -d "{"weapon":"sword"}" localhost:8181/api/v1/inventory -> updating user inventory (if none, create the item, if already got update the item by increasing the count)


## Question B
Basic auth is easy to implment across all platform, and is secure enough that your everday user wont be able to access the site without proper authentication
* curl --header "Authorization: Basic <base64"> localhost.com


# Question C
* best format for API is json, as almost all API and platform have easy to implement json parse. Futhermore, its easier to read with human eyes, thus easier to debug.
* JSON is the best for data exchange, for its simplity and ease to use and debug