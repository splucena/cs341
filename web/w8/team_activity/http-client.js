'use strict'

const http = require('http');

const url = process.argv[2];

http.get(url, (res) => {

    res.setEncoding('utf8')
    /*res.on('data', (data) => {
        data.toString().split('\n').forEach(element => {
            console.log(element);
        });
    })*/
    res.on('data', console.log)
    res.on('error', console.error)
}).on('error', console.error)