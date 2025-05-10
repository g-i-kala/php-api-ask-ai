# AI Question and Answer Page

This is a SUPER SIMPLE demonstration project that utilizes API communication to provide Google
Gemini 2.0 AI-powered\*\* responses to user queries. The project is structured following the
Model-View-Controller (MVC) pattern with an emphasis on Object-Oriented Programming (OOP)
principles. It uses AltoRouter for routing and a service container for dependency management.

## Project Structure

- **Controllers**: Manages the request logic. The `ChatController` handles the form display and
  processes user input.
- **Services**: Contains the `ApiService` class, which is responsible for making API requests using
  cURL.
- **Views**: Contains the PHP files that render the user interface, such as `chat-form.view.php` and
  `chat-response.view.php`.
- **Core**: Contains utility classes like `Validator` for input validation.

## Key Components

### ChatController

- **index()**: Displays the question submission form.
- **handleChat(Request $request)**: Handles form submission, validates user input, sends a request
  to the AI API, and displays the response or errors.

### ApiService

Handles the API communication logic, encapsulating the cURL requests to interact with the AI
service.

### Validator

A utility class that provides methods for validating input data, such as checking string length.

## Routing

The project uses AltoRouter for handling routes. The main routes include:

- `GET /` - Displays the question submission form.
- `POST /chat` - Processes the form submission and returns the AI response.

## Error Handling

- Errors are caught using try-catch blocks in the controller.
- Error messages are logged and displayed to the user when appropriate.

## Requirements

- PHP 7.4 or higher
- AltoRouter
- A web server (e.g., Apache, Nginx)

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/g-i-kala/php-api-ask-ai.git
   ```

2. Navigate to the project directory:

   ```bash
   cd ai-question-answer-page
   ```

3. Install dependencies (if any) using Composer:

   ```bash
   composer install
   ```

4. Configure your web server to serve the application.

5. Create your own .env file accoridng to the provided example to be able to communicate with the
   Google Gemini 2.0 AI service. How to
   [Quickstart with Gemini for Developers](https://ai.google.dev/gemini-api/docs/quickstart?lang=python).

## Usage

1. Start your web server.
2. Access the application in your browser at `http://localhost/` (or your configured domain).
3. Enter your question in the form and submit to receive an AI-generated response.

## License

This project is licensed under the MIT License.

---

Feel free to customize the content further to match your specific project details.
