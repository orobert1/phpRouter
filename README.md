# PHP Router

## *A PHP router that allows you to add a route and a PHP function that is called when a request is made to that route*

### addDefault
A method that allows you to define the default action for when a request is made to the root url.

### addRoute
A method that allows you to define the action of any specific routes. This includes routes that are directed towards a specific variable. *e.g. users/:userId:* In this case, the function paired with that route must expect whatever that variable is as a parameter.
