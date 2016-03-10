# WebdubzAPI v1.00

##### A Web App to share music.

#### Julio Diaz

## Description

The idea of **Webdubz** is to help users share demos, edits and remixes also known as "Dubs". 

### Key characteristics
* Allows front end app to upload music and share with the internet.
* Allows front end app to download music.
* Allows users to set download limits.

### Future functions to be added
* Cookies so API remembers users so user can't donwload same song twice.


## Setup
* Clone the project using the link provided on Github.
* Run composer install in Terminal from the project root folder.
* Download and install [FFmpeg](https://www.ffmpeg.org) (I recommend using Homebrew if on Mac).
* Setup env file so that Laravel knows where and how to access your database.
* From the project root folder in Terminal run command```php artisan migrate```.
* From the project root folder in Terminal run command ```php artisan serve```.
* Open a web browser and navigate to ```localhost:8000```.

## Technologies used

PHP, Laravel, FFmpeg, MySQL.

## Legal

Copyright (c) 2015 **Julio Diaz**

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.