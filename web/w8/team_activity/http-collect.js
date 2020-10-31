'use strict'

const http = require('http');
const bl = require('bl');

const url = process.argv[2];

http.get(url, (res) => {

    res.setEncoding('utf8')
    let rawData = ''
    res.on('data', (chunk) => { rawData += chunk });
    res.on('end', () => {
        let data = rawData.toString()
        console.log(data.length);
        console.log(data)
    })
}).on('error', console.error)

/*
// learnyounode solution
http.get(url, res => {
    res.pipe(bl((err, data) => {
        if (err) {
            return console.error(err)
        }

        data = data.toString()
        console.log(data.length)
        console.log(data)
    }))
})*/