<?php
/*
* ESCAPING OUTPUT
* Escaping refers to handling the output of data, which you aren't 100% is safe. 
* If someone fills in a name in a form or adds a comment it gets saved in your database.
* You have to assume that when you output that data, it could contain script tags that you do not want to run.
* The main aim of escaping output is to prevent html or bad scripts running (known as XSS or cross site scripting)
*/


