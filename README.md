# Collect counts of visitors 

## This project is released as a test.


Goal: Make a service for collecting counts of visits from different platforms of website analytics.

### Possibility:
   - currently is available only fake driver

### Registering sources:
- Add configuration in config/sources.php

### Registering of new drivers:
- For adding you can write class for specific driver.
- This class should implements interface Statistics\VisitorsCounter.
- After that you should register it in VisitorsCounterFactory.
 