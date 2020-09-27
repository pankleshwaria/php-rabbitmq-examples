Fanout Exchange
--------------------------

* The fanout exchange routs the message to all the queue that are bound to that exchange.
* Fanout exchange ignores the routing key.
* The routing algorithm behind a fanout exchange is - a message goes to all the queues that are binded to the exchange.
* Routing Key & Binding Key are ignored.

Usage
--------------------------

* Typically used for broadcasting purposes.
* Example: Broadcasting of emergency weather alerts.