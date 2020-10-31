'use strict'

const { fstat } = require("fs")

const fs = require('fs');

let lines = (data) => {
    console.log(data.toString().split('\n').length - 1);
}

fs.readFile(process.argv[2], 'utf-8', (err, data) => {

    if (err) {
        return console.log(err);
    }
    lines(data);
})

/** 
 * learnyounode solution
 * 
 * cons file = process.argv[2];
 * 
 * fs.readFile(file, function (err, contents) {
 *      if (err) {
 *          return console.log(err);
 *      }
 * 
 *      const lines = contents.toString().split('\n').length - 1;
 *      console.log(lines);
 * })
*/