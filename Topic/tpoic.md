Topic Exchange
--------------------------

* The topic exchange provides more flexibility while routing the messages.
* The topic exchange felicitate the use of wild card characters. There are only two wild card characters * and #.
* * = single word and # = zero or more words
* Topic exchanges route messages to one or many queues based on matching between a message routing key and the pattern that was used to bind a queue to an exchange.
* The routing algorithm behind a topic exchange is - a message goes to all the queues that matches the routing patter with binding pattern.
* Routing Key pattern = Binding Key pattern.

Usage
--------------------------

* Topic exchange is commonly used for multicast routing of messages.
* Example: News updates that involve categorization (for example, only for a particular sport or team).
* cricket.in (Cricket news of team India *.in), cricket.aus (Cricket news of team Australia *.aus)