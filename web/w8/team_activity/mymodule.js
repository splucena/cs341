'use strict'

const fs = require('fs');
const path = require('path');

/*module.exports = (dirPath, ext, callback) => {
    fs.readdir(dirPath, (err, files) => {
        if (err) {
            return callback(err);
        } else {
            files = files.filter((file) => {
                let extension = '.' + ext
                if (path.extname(file) === extension) {
                    return true
                }
            })
            
            callback(null, files)            
        }
    })
}*/

/**
 * accepts directory, file extension, and callback function
 */
module.exports = (dir, filterStr, callback) => {

    // produces list of files inside the specified directory
    fs.readdir(dir, (err, list) => {

        // returns an error
        // call callback to display error
        if (err) {
            return callback(err)
        }

        // list produced by fs.readdir
        // only return files with specified filename
        list = list.filter(file => {
            return path.extname(file) === '.' + filterStr
        })

        // call callback passing the filtered list
        callback(null, list)
    })
}