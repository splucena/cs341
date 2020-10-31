'use strict'

var http = require('http')
var url = require('url')

let onRequest = (req, res) => {
    let parsedUrl = url.parse(req.url, true)
    let pathName = parsedUrl['path']

    if (pathName === '/home') {
        res.writeHead(200, {"Content-Type": "text/html"})
        res.write('<h1>Welcome to the Home Page</h1>')
    } else if (pathName === '/getData') {
        res.writeHead(200, {"Content-Type": "application/json"})
        res.write(JSON.stringify({'name': 'Sum', 'class': 'CS341'}))
    } else {
        res.writeHead(404, {"Content-Type": "text/html"})
        res.write("404 Not Found\n")
    }
    
    res.end();
}

var server = http.createServer(onRequest).listen(8888)
console.log("Server running on port 8888")