var http = require('http');

function sayHello(req, res) {
    console.log('hello' + req.url);
    
    res.write("Hello fro Node");
    res.end();
}

var server = http.createServer(sayHello);
server.listen(5000);