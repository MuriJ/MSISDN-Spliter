# MSISDN-Spliter
Small Vagrant RPC API with a web page sample and a CLI sample.  

All the data about Countries is saved in countries.json  
Right now the only countries that have the local codes set are Slovenia and Croatia. If you want to add codes for other countries simply set the NDCMin and NDCMax properties which can be from 1 to 3 numbers and add the Codes property.   

Sample:  
{  
    "name": "Slovenia",  
    "ISO31661Alpha2": "SI",  
    "Dial": "386",  
    "ISO4217currencyname": "Euro",  
    "Capital": "Ljubljana",  
    "Continent": "EU",  
    "TLD": ".si",  
    "NDCMin": 2,  
    "NDCMax": 2,  
    "Codes": [  
      {  
        "Code": "68",  
        "MNO": "SI.MOBIL d.d."  
      },  
      {  
        "Code": "51",  
        "MNO": "TELEKOM SLOVENIJE, d.d."  
      },  
      .  
      .  
      .  
    ]  
  }  
  

The package is exposed through a json-rpc.php API, it is a very simple and useful class that is very easy to set up and it simply works.  

In order to test and run the program VirtualBox and Vagrant need to be installed on your machine and then you can test it with a web page or CLI.  

There are various ways to run the program:  

1. If you are a windows user simply run /bat/up.bat  
   The batch will set up Vagrant for you and open up a page in your browser. After you are done run /www/destroy.bat to      shutdown VM.
2. If you want to do it by hand, run command line, set the folder to project MSISDN-Splitter, execute command "Vagrant up" and visit page http://127.0.0.1:4567  
3. To run the CLI test, run command line, set the folder to project MSISDN-Splitter and  
   execute commands: Vagrant up, Vagrant ssh and then "php /vagrant/cli-test.php [your MSISDN number]"  
                    
Web page sample:  
![alt tag](https://github.com/MuriJ/MSISDN-Splitter/blob/master/PageSample.jpg)

CLI sample:  
![alt tag](https://github.com/MuriJ/MSISDN-Splitter/blob/master/CLISample.jpg)

The program accepts numbers in various formats, can't contain any alphabetical characters except "+" and "-", and it needs to be between 8 and 15 characters in length.  

Valid input samples:  
+386 40 504 267  
38604332205  
+385 42 225 984  
1-541-754-3010  
0038631981315  
  
