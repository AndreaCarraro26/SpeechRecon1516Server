# SpeechRecon1516Server

This is an android application created to comunicate with a remote server to perform asynchronous speech recognition (ASR) 
using Kaldi framework (http://kaldi-asr.org/doc/).  

Here you can find only the server side. The client side is hosted at https://github.com/AndreaCarraro26/SpeechRecon1516/

We are Andrea Carraro, Marco Camillo and Federico Munari, all master students from University of Padua (Italy).

This project has been done as a team work for "Embedding System Programming" course held by professor Carlo Fantozzi in 2016.

We hope that all you can find here could be helpful for your purpose. There isnt't any restriction on the usage of our code. 
Unfortunatly, we'll not support the project anymore, so bugs and issues will not be corrected in the future. 

Enjoy. 


INSTRUCTION
- We implemented a Linux/Apache/Php server
- Be aware that we use relative path in our php and bash scripts.
- We locate save.php in /var/www/html directory, while decode-wav in /home/user/desktop
- In the same directory of decode-wav, you must download and compile Kaldi framework and Sox (http://sox.sourceforge.net/)
- We used for our project the Voxforge model distributed with Kaldi. We know this is not the best choise for our purpose, but our goal was to create a working client/server app, despite the performance.
