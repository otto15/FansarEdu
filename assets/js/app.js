/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.scss in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

import $ from 'jquery'
var shluher = require('./shluher');

$(document).ready(function () {
    $('body').prepend('<h1 class="isk">'+ shluher('isk') +'</h1>')
})

import apologise from './apologise'
$(document).ready(function () {
    $('.isk').append('<h1>'+ apologise('isk') +'</h1>')
})