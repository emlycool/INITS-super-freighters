# SuperFrieghters
	project url https://superfreighters-app.herokuapp.com/

App create an shipping order system based on the certain conditions
 - Mode of Transport  
- Weight of Item  
- Country of Origin

#### Every mode of transport has a base fare.  
Base Fare by Air - 50,000 Naira  
Base Fare by Sea - 15,000 Naira  
  
By Air, everything arrives in Nigeria two days after shipment :). Transportation by Sea however, takes 10 times longer than by Air.  
  
####  Weight of the item affects cost. Per Kilogram  
- By Air - NGN 10,000  
- By Sea - NGN 2,000  
- All packages are rounded up to kilograms.  
  
#### Country of Origin  
There's Flat Rate in each country for All Outgoing Packages  
- US - NGN 1,500  
- UK - NGN 800

Model and Seeder was created to populate db with data for shipping cost calculation to make to flexible to change. ```

[./databse/seeder](https://github.com/emlycool/INITS-super-freighters/tree/master/database/seeders)

Logic to calculate Shipping can be found in OrderController::calculateShipping()
