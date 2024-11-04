# SecShare - Open-source Secret Share Tool

## Introduction
SecShare is an open-source tool that allows users to securely share sensitive information without involving any third parties. It was developed as part of a project for a client who needed a way to share confidential data.

Read more about this project on the [blog post](https://gerwinkuijntjes.nl/en/secshare-open-source-secret-share-tool).

## Key Features

1. 🔒 **End-to-End Encryption**: The sensitive data is encrypted on the client-side before being sent to the server, ensuring that only the intended recipient can decrypt and access the information.
2. 🕰 **Self-Destructing Secrets**️: Shared secrets can be set to expire after a specified time or number of views, ensuring that the sensitive data is not accessible indefinitely.
3. 👀 **View Limits**: Users can set a maximum number of views for a shared secret, preventing unauthorized access.
4. 🔐 **TLS Protection**: All communication between the client and the server is secured using TLS, protecting the data in transit.
5. 🚫 **Revocation**: Shared secrets can be revoked by the owner using a randomly generated revocation token.
6. 🗑 **Automatic Cleanup**: Expired secrets are automatically removed from the database to keep the system clean.
7. 💻 **Open-Source**: The entire project is open-source and available on GitHub, allowing the community to contribute and improve the tool.

## Installation

### Basic setup

1. Clone the repository:
   ```bash
   git clone https://github.com/gwku/secshare.git
   ```
2. Install dependencies:
   ```bash
   composer install
   ```
3. Copy the `.env.example` file to `.env` and update the database configuration.
4. Generate the application key:
   ```bash
   php artisan key:generate
   ```
5. Run the migrations:
   ```bash
   php artisan migrate
   ```

### Local Development
Follow the basic setup and then run the following command:
1. Start the development server:
   ```bash
   php artisan serve
   ```
   
The application will be available at `http://localhost:8000` by default.

### Docker
The Docker setup is also available for running the application in a containerized environment.
If you run the application using Docker, make sure to update the `.env` file with the appropriate database configuration (MYSQL driver).
Also, if you want to host the application on a different port, update the `docker-compose.yml` file accordingly.
Make sure to update APP_URL in the `.env` file to match your hosting url if you want to host this tool.

Follow the basic setup and then run the following commands:
1. Build the Docker image:
   ```bash
   docker build -t secshare .
   ```
2. Run the Docker container:
   ```bash
   docker compose up -d
   ```

The application will be available at `http://localhost:8000` by default.

## Tests
To ensure the application works as expected, you can run the tests using Dusk.

1. Update the `APP_URL` in the `.env` file to match your local development URL.
2. Run the server:
   ```bash
   php artisan serve
   ```
3. Run the Dusk tests:
   ```bash
   php artisan dusk
   ```
   
## Contributing 🤝

If you find any issues or have ideas for improvements, feel free to open an issue or submit a pull request on the [GitHub repository](https://github.com/gwku/secshare). Contributions are always welcome!

## License 📜

SecShare is open-source software licensed under the [MIT license](LICENSE).
