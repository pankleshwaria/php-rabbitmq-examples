Direct Exchange
--------------------------

* The routing algorithm behind a direct exchange is - a message goes to the queues whose binding key exactly matches the routing key of the message.
* Routing Key = Binding Key

Usage
--------------------------
* Used for one-two-one communication or service-to-service communication
* Example: Used in microservices to communicate between two services.