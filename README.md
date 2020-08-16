# API Reference
This documentation provides tips about how use this rest API

**Base url:** `localhost:3000`

## Serving API
To serve this API, execute the `serve.php` file in terminal:
`php serve.php`


## Consuming this API
To consume this API you can use a specific tool (like POSTMAN - click here to download) or do it programmatically.

### Get Vehicle Data (POST)
 Retrieve vehicle data of given id.

#### Base URL
`http://localhost:3000/vehicle`

#### Encoding
`multipart\form-data`

#### Request example
`
"id": "2764772"
`

#### Response example

    {
    "status": 200,
    "data":{
	    "id": "2764772",
	    "name":"Chevrolet Montana",
	    "description": "LS 1.4 ECONOFLEX 8V 2p ",
	    "year": "2016\/2017",
	    "mileAge": "49800",
	    "fuel": "Bi-Combust\u00edvel",
	    "gear": "Manual",
	    "accessories":
		    ["AIR BAGS 2","ALARME","AR CONDICIONADO"],
	    "price": 28900,
	    "pictures":	["https:\/\/carros.seminovosbh.com.br\/chevrolet\/montana\/2016\/2017\/2764772\/3827e1f85bfccde3288c05f1a94704568a92","https:\/\/carros.seminovosbh.com.br\/chevrolet\/montana\/2016\/2017\/2764772\/239231a8723e1982a7b498f8bc3f2465bd9e"]
    }}


###  Search Vehicle (POST)
Retrive a vehicle list (**20**) based in parameters sent.

#### Base URL
`http://localhost:3000/search`

#### Encoding
`multipart\form-data`

#### Request example
`
"product_type": "carro",
"year_from": 2017,
"price_to": 2000000,
"page": 4
`

#### Response example

    {
    	"status": 200,
    	"data":[{
    		"id":"2768232",
    		"name":"Citroen C4",
    		"description":"2.0 16v C4 EXCLUSISE 2.0",
    		"year":"2010\/2011",
    		"mileAge":"100000",
    		"fuel":"Bi-Combust\u00edvel",
    		"gear":"Manual",
    		"accessories":"AIR BAGS 2",
    		"price":21900,
    		"pictures":["https:\/\/tcarros.seminovosbh.com.br\/mini_citroen\/c4\/2010\/2011\/2768232\/7846bc90bd0a9cd2c53e0b205bcf6c223f2"]}
    		]
    }


#### Available filters:
- *product_type* {String}
The type of product ("carro", "moto", "caminhao").

- *brand* {String}
The vehicle brand.

- *model* {String}
The vehicle model.

- *year_from* {int}
Vehicle minimun year limit.

- *year_to* {int}
Vehicle maximum year limit.

- *price_from* {int}
Vehicle minimum price limit.

- *price_to* {int}
Vehicle maximum price limit.

- *km_from* {int}
Vehicle minimum mileage limit.

- *km_to* {int}
Vehicle maximum mileage limit.

- *page* {int}
Result search page