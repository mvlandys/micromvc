#!/bin/bash

echo "Please enter a controller name :"
read name

if [ -z $name ]
then
    printf "\e[31mError :No controller name entered\n\n\e[0m"
    exit
fi

# Make sure first letter is uppercase
first_char=${name:0:1}
if [[ $first_char == [a-z] ]]
then
    printf "\e[31mError :First character must be uppercase\n\n\e[0m"
    exit
fi

controller_template="<?php\n\tnamespace Matheos\\App;\n\n\tclass $name extends \\Matheos\\MicroMVC\Controller {\n\n\t}"
echo "Creating controller class...\n"
echo "$controller_template" > $name.php
mv $name.php ../../App/controllers/

model_fname=$name"Model"
model_template="<?php\n\tnamespace Matheos\\App;\n\n\tclass $model_fname extends \\Matheos\\MicroMVC\Model {\n\n\t}"
echo "Creating controller class...\n"
echo "$model_template" > $model_fname.php
mv $model_fname.php ../../App/models/

view_template="<p>$name controller</p>"
echo "Creating default view...\n"
echo "$view_template" > _view.php
mkdir ../../App/views/$name
mv _view.php ../../App/views/$name

css_template="/* CSS */"
echo "Creating default css...\n"
echo "$css_template" > $name.css
mv $name.css ../../App/lib/css/

js_template="\t\$(document).ready(function() {\n\t\t/* Javascript */\t\n\t});"
echo "Creating default js...\n"
echo "$js_template" > $name.js
mv $name.js ../../App/lib/js/