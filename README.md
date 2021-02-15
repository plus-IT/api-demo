# simplyOrg api integration demo

Setup: 

Clone this repository in a webserver supporting php version 7.2 or greater
git clone https://github.com/plus-IT/api-demo.git

Explaination:

Under Classes folder there is file named Api.php wich contains our "Api" class
For demo purpose we have placed the settings to our test system.
This settings can be replaced with any simplyOrg instance.
Following variables on Api class should be changed to respective instance 
- $baseApiUrl
- $username
- $password

We have implemented get and post http method calls to our apis for demo purpose 
in Api class, it can be extended to support put and delete methods also 

