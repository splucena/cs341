var http = require('http');
var bl = require('bl');

/*var urls = process.argv.slice(2)
var count = urls.length;

var results = [];

urls.forEach((url, index) => {
    http.get(url, (res) => {
        res.pipe(bl((err, data) => {
            if (err) throw err;

            results[index] = data.toString();
            count--;

            if (count == 0) {
                results.forEach((result) => {
                    console.log(result)
                });
            }
        }))
    })
})*/


const results = []
let count = 0

function printResult() {
    for (let i = 0; i < 3; i++) {
        console.log(results[i])
    }
}

function httpGet (index) {
    http.get(process.argv[2 + index], res => {
        res.pipe(bl((err, data) => {
            if (err) {
                return console.error(err)
            }

            results[index] = data.toString()

            count++
            
            if (count === 3) {
                printResult()
            }

        }))
    })
}

for (let i = 0; i < 3; i++) {
    httpGet(i)
}