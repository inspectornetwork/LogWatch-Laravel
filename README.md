# Logwatch for Laravel
Logwatch is a logging driver for Laravel that streams your application logs and exceptions to the Logwatch dashboard in real-time.

## Installation
You can install the package via composer:

The service provider will automatically register the logwatch driver with Laravel's LogManager.

## Configuration
1. **Environment Setup**

Add your project credentials to your .env file.

2. **Configure Logging Channel** 

Add the logwatch channel to the channels array in config/logging.php. To stream logs in parallel with your local files, add it to your stack.

## Features
Smart Dispatching: Logwatch intelligently detects your execution environment. It uses non-blocking asynchronous requests for Web contexts and synchronous requests for CLI/Artisan contexts.

* Auto-Discovery: No manual server registration required. Logwatch identifies originating nodes by their hostname.
* Rich Context and Stack Traces: Pass exceptions or arrays directly to the logger. Logwatch captures the full stack trace and environment state.

## License
The MIT License (MIT). Please see LICENSE.md for more information.