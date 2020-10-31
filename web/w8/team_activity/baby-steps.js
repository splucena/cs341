'use strict'

let total = 0;
let numOrzero = n => isNaN(n) ? 0 : Number(n);

total = (process.argv).reduce((a, b) =>
    numOrzero(a) + numOrzero(b)
);

console.log(total);

/**
 * learnyounode solution
 * 
 * 'use strict'
 * 
 * let result = 0;
 * 
 * for (let i = 2; i < process.argv.length; i++) {
 *      result += Number(process.argv[i]);
 * }
 * 
 * console.log(result);
 */
