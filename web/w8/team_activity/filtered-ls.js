'use strict'

const fs = require('fs');
const path = require('path');


const dirPath = process.argv[2];
const fileExtension = process.argv[3];

let filterByFileExt = (files) => {
    files.forEach(f => {
        let ext = '.' + fileExtension
        if (path.extname(f) === ext) {
            console.log(f);
        }
    })
}

fs.readdir(dirPath, (err, files) => {
    if (err) {
        console.log(err)
    }

    // callback
    filterByFileExt(files)

    // or this
    /*files.forEach(file => {
        let filePathExtension = path.extname(file).replace('.', '')
        if (filePathExtension === fileExtension) {
            console.log(file)
        }
    })*/
})

/**
 * const ext = '.' + process.argv[3];
 * if (path.extname(file) === ext) 
 * */ 