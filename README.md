## Documentation

CRUD Application - show Google Maps Location API - Has API to show all data from Database in JSON format

## Database

Using MySQL Database. You can find Database connection in the .env file

For this Project I decided to create three database tables. They have relations to each other.

It is important that the countries table contains data for each country (A-D-CH) so that it is possible to create a Venue.

## Model

The code defines a protected property named $fillable which are the columns that can be filled with data using the create() or update() methods of the model.

For the model of each migration, I have created functions related to the foreign keys of the respective tables.

## Controller

There is the VenueController. This controller contains the whole functionality of the CRUD Application. Down below, you find all the information about the functions and the blades.

## -- Routes

The first two routes are simple and only return views when their URLs are accessed. The third to eighth routes are related to the VenueController. They define routes for showing, creating, storing, editing, updating, and deleting venue data. Specifically, they define GET and POST requests for index, create, store, show, edit, and update operations, respectively. Additionally, there is a DELETE request to delete a venue.

The last route defines a GET request to return a JSON response for all venues in the application.

## -- Index function

Blade that shows data of all venues (including relation to Address and Country) Ordered by Name.
With following fields of City, Country and Action. Action field contains functionality to show Detailpage, edit or delete a venue(via Modal-Box).

It is also set a pagination of 5 venues per page.

## -- Create function

Blade that shows input fields for creating a venue. The $countries variable gets the data from the countries table and offers the data to the select a country in the options field.

## -- Store function

Is related to the create function. It validates the data which has been entered into the input fields of the create.blade. Via the $request parameter we can validate the data throw different validation options.

We use the $existingVenue variable to verify whether the venue name entered in the HTTP request already exists in the database column.

If yes, we get an error message.

When the validation goes well a new Venue and Address are created using the input values passed through the HTTP request. The Country ID is obtained from the Country model. The Venue and Address data are saved to their respective database tables.

The code sends a request to the Google Maps Geocoding API using a provided address, retrieves the response, extracts the latitude and longitude data from the response, and saves it to the data base collumn. Then it saves the new venue's address and redirects the user to the index page with a success message.

## -- Show function

This function displays the details of a specific venue by finding the venue with the given ID and loading its related addresses and countries. It then returns the 'venue.show' view and passes the venue data as a variable named 'venue' to the view.

## -- Edit function

This function fetches a specific venue with the given ID from the database along with its related address and country information. It also fetches all the countries from the countries table like in the create function. The fetched data is then passed to the venue.edit view for displaying the venue and related countries data in a form.

## -- Update function

Is related to the edit function. Same as the store function the update function validates the input data Via the $request parameter. Instead of creatring a new Venue, the update function simply updates the venue information in the database.
including the venue information, the adress and country information and the GeoLocation. It redirects to the index.blade with an success message.

## -- Destroy function

This function deletes a venue and its associated addresses from the database based on the provided ID. It first finds the venue by the ID using the findOrFail() method. It then deletes the related addresses by calling the delete() method on the addresses() relationship of the venue. Finally, it deletes the venue itself and redirects the user to the index page with a success message.

## -- Api function

This function retrieves all the venues with their associated addresses and countries in alphabetical order and returns them in JSON format for use in an API.




