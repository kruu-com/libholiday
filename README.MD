# libholiday - A PHP Holiday Library   
With this library you can check if a given day is a holiday in selected country or state.

## Usage Example

```
Create instance of CalculatorService:
$holidayService = new CalculatorService();

// Get actual calculator by passing country and optional state
$calculator = $holidayService->getCalculatorByCountryAndState('DE', 'BY');

```

## Run tests
You need to have docker installed. Please run:

This starts the container:  
`docker compose up -d` 

This runs the tests:  
`docker compose exec php /var/app/vendor/bin/phpunit --configuration=/var/app/phpunit.xml`


## Todos
* Tests for special holidays like "Tourist Trophy Senior Race Day" on Isle of Man, see Belgium
* Translations for holidays
* Code examples