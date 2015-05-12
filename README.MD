# Datatrics PHP api

This is a PHP 5.4+ API wrapper for the Datatrics API

## The API
The Datatrics API is organized around REST. Our API is designed to have predictable, resource-oriented URLs and to use HTTP response codes to indicate API errors. We use built-in HTTP features, like HTTP authentication and HTTP verbs, which can be understood by off-the-shelf HTTP clients, and we support cross-origin resource sharing to allow you to interact securely with our API from a client-side web application (though you should remember that you should never expose your secret API key in any public website's client-side code). JSON will be returned in all responses from the API, including errors (though if you're using API bindings, we will convert the response to the appropriate language-specific object).

## Usage

### Authentication

Register your API key in your Datatrics API Manager.

$api = new Datatrics\Api\Api( $apiKey );

### GET

Send and retrieve data from the Datatrics API by an GET request.

```
$api->get("Method", "Action", array('projectid' => $projectId));
```

### POST

Send and retrieve data from the Datatrics API by an POST request.

```
$api->post("Method", "Action", array('projectid' => $projectId));
```