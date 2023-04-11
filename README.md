## Documentation

CRUD Application - Google Maps Location API - Has API to show all data from Database in JSON format

## Database

Using MySQL Database. You can find Database connection in the .env file

For this Project I decided to create three database tables. They have relations to each other.

It is important that the countries table contains data for each country (A-D-CH) so that it is possible to create a Venue.

## Model

The code defines a protected property named $fillable which are the columns that can be filled with data using the create() or update() methods of the model.

For the model of each migration, I have created functions related to the foreign keys of the respective tables.

## Routes

The first two routes are simple and only return views when their URLs are accessed. The third to nineth routes are related to the VenueController, grouped with the prefix /venues. They define routes for showing, creating, storing, editing, updating, and deleting venue data. Specifically, they define GET and POST requests for index, create, store, show, edit, and update operations, respectively. Additionally, there is a DELETE request to delete a venue.

## ApiVenueController - api.php

It handles API requests related to venues. The ApiVenueController class provides a simple interface for retrieving venue data through an API endpoint. 

## Index function - api/venues

Returns a JSON response containing a list of venues. The list is ordered by name and includes the country of each venue's address.

## Show function - api/venues/{id}

Returns a JSON response for a specific venue, identified by its id parameter. Before returning the response, the method validates the id parameter using Validator. If the validation fails, a JSON response containing the validation error messages and a status code of 404 is returned.

If the validation succeeds, the method fetches the venue from the database, including its associated country and address, and returns a JSON response containing the venue data.

## VenueController - web.php

This controller contains the whole functionality of the CRUD Application. Down below, you find all the information about the functions and the blades.

## Index function

Blade that shows data of all venues (including relation to Address and Country) Ordered by Name.
With following fields of City, Country and Action. Action field contains functionality to show Detailpage, edit or delete a venue(via Modal-Box).

It is also set a pagination of 5 venues per page.

## Create function

Blade that shows input fields for creating a venue. The $countries variable gets the data from the countries table and offers the data to the select a country in the options field.

## Store function

Is related to the create function. It validates the data which has been entered into the input fields of the create.blade. Via the $request parameter we can validate the data throw different validation options.

When the validation goes well a new Venue and Address are created using the input values passed through the HTTP request. The Country ID is obtained from the Country model. The Venue and Address data are saved to their database tables.

The code below the validation sends a request to the Google Maps Geocoding API using a provided address, retrieves the response, extracts the latitude and longitude data from the response, and saves it to the data base collumn. Then it saves the new venue's address and redirects the user to the index page with a success message.

## Show function

This function displays the details of a specific venue by finding the venue with the given ID and loading its related addresses and countries. It then returns the 'venue.show' view and passes the venue data as a variable named 'venue' to the view.

## Edit function

This function fetches a specific venue with the given ID from the database along with its related address and country information. It also fetches all the countries from the countries table like in the create function. The fetched data is then passed to the venue.edit view for displaying the venue and related countries data in a form.

## Update function

Is related to the edit function. Same as the store function the update function validates the input data Via the $request parameter. Instead of creating a new Venue, the update function simply updates the venue information in the database.
including the adress and country information and the GeoLocation. It redirects to the index.blade with an success message.

## Destroy function

This function deletes a venue and its associated addresses from the database based on the provided ID. It first finds the venue by the ID using the findOrFail() method. It then deletes the related addresses by calling the delete() method on the addresses() relationship of the venue. Finally, it deletes the venue itself and redirects the user to the index page with a success message.


## App.JS initMap function

This code initializes a Google Map on a web page by reading the longitude and latitude values from hidden input fields from the show.blade, creating a map object centered on those coordinates, and adding a marker to the map.



