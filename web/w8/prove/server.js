'use strict'

var http = require('http'),
    fs = require('fs'),
    url = require('url'),
    path = require('path'),
    querystring = require('querystring')


let onRequest = (req, res) => {
    let parsedUrl = url.parse(req.url, true)
    let pathName = parsedUrl['path']

    if (req.method === 'POST') {
        let body = ''
        req.on('data', chunk => {
            body += chunk.toString()
        })
        req.on('end', () => {
            let numbers = querystring.parse(body)
            let num1 = numbers['num1']
            let num2 = numbers['num2']
            let sum = [num1 , num2].reduce((a , b) => Number(a) + Number(b), 0 )
            console.log(sum)
            res.write(`${num1} + ${num2} = ${sum}`)
            res.end()
        })
    } else {

        if (pathName === '/') {
            res.writeHead(200, {
                "Content-Type": "text/html"
            })
            res.write(`
                <!doctype html>
                <html>
                <body>
                    <form action="/" method="post">
                        <input type="text" name="num1" />
                        <label>+</label>
                        <input type="text" name="num2" />
                        <button>Add</button>
                    </form>
                </body>
                </html>
            `)
            res.end()
        } else if (pathName === '/home') {
            res.writeHead(200, {
                "Content-Type": "text/html"
            })

            let homePage = "<h1 class='red'>Welcome to the Home Page</h1>" +
                "<p><a href='/getData'>Get Data</a></p>"
            res.write(homePage)
            res.end()
        } else if (pathName === '/getData') {
            res.writeHead(200, {
                "Content-Type": "application/json"
            })
            res.write(JSON.stringify({
                'name': 'Sum',
                'class': 'CS341'
            }))
            res.end()
        } else {
            res.writeHead(404, {
                "Content-Type": "text/html"
            })
            res.write("404 Not Found\n")
            res.end()
        }
    }
}

var server = http.createServer(onRequest)
server.listen(8888)
console.log("Server running on port 8888")