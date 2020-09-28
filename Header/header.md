Header Exchange
--------------------------

* The header exchange routs the message based on arguments containing headers and optional values.
* Headers exchanges are very similar to topic exchanges, but route messages based on header values instead of routing keys.
* A message matches if the value of the header equals the value specified upon binding.
* Routing headers = Binding headers.
* A special argument named "x-match", added in the binding between exchange and queue, specifies if all headers must match or just one.
* A value of "all" means all header pairs (key, value) must match, while value of "any" means at least one of the header pairs must match.

Usage
--------------------------

* Used to process message based on headers.
* Exchange: Binding to Queue A with arguments (key = value): format = pdf, type = report, x-match = all.
* Example: Message is published to the exchange with header arguments (key = value): "format = pdf", "type = report".