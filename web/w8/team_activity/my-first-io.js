'use strict'

const fs = require('fs');

const data = fs.readFileSync(process.argv[2]);

let filtered = data.toString().split('\n').filter(el => {
    return el != null;
});

console.log(filtered.length - 1);

/** 
 * const lines = contents.toString().split('\n).length - 1;
*/

