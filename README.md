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

Working example for this code can be checked here: http://apidemo.simplyorg.de/


# simplyOrg Widget demo

As a quick solution for integration of simplyOrg to other websites we have implimented a widget.
The widget can list all seminar lists and also filters. 
after user selects the desired seminar, user will be redirected to the simplyOrg CMS for 
further booking process

Setup: 

to use the simplyOrg widget the following code snipate can be added to any web page(on any CMS system)

```
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" media="all">
<script type="module" src="https://widgets.simplyorg.de/build/simplyorgwidget.esm.js"></script>
<script nomodule src="https://widgets.simplyorg.de/build/simplyorgwidget.js"></script>
<so-seminarlist cmsurl="https://testcms.simplyorg.de/" backendurl="https://test.simplyorg.de/"></so-seminarlist>
```

Currently it is pointing to our test cms system. 
Following attributest in so-seminarlist web component needs to be changed to respective simplyOrg Instance
- cmsurl
- backendurl




    
