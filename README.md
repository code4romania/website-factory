# Website Factory

[![GitHub contributors](https://img.shields.io/github/contributors/code4romania/website-factory.svg?style=for-the-badge)](https://github.com/code4romania/website-factory/graphs/contributors) [![GitHub last commit](https://img.shields.io/github/last-commit/code4romania/website-factory.svg?style=for-the-badge)](https://github.com/code4romania/website-factory/commits/master) [![License: MPL 2.0](https://img.shields.io/badge/license-MPL%202.0-brightgreen.svg?style=for-the-badge)](https://opensource.org/licenses/MPL-2.0)

Code4ro presentation website

[Contributing](#contributing) | [Built with](#built-with) | [Development](#development) | [Deployment](#deployment) | [Feedback](#feedback) | [License](#license) | [About Code for Romania](#about-code-for-romania)

## Contributing

This project is built by amazing volunteers and you can be one of them! Here's a list of ways in [which you can contribute to this project](https://github.com/code4romania/.github/blob/main/CONTRIBUTING.md).

## Built with
-   Laravel
-   Tailwind CSS
-   Inertia.js
-   Vue.js
-   Alpine.js

### Requirements
-   PHP 8.1+
-   Nginx
-   PostgreSQL 14+

## Development
This project uses Laravel Sail, Laravel's default Docker development environment.

After running the [initial setup](#initial-setup), run this command to start up the environment:
```sh
./vendor/bin/sail up -d
```

and then this command to rebuild the css / js assets on change:

```sh
./vendor/bin/sail npm run watch
```

### Initial setup

```sh
# 1. Install composer dependencies
docker run --rm -v ${PWD}:/app -w /app composer:latest composer install --ignore-platform-reqs --no-scripts --no-interaction --prefer-dist --optimize-autoloader

# 2. Copy the environment variables file
cp .env.example .env

# 3. Start the application
./vendor/bin/sail up -d

# 4. Install npm dependencies
./vendor/bin/sail npm ci

# 5. Build the frontend
./vendor/bin/sail npm run dev

# 6. Generate the app secret key
./vendor/bin/sail artisan key:generate

# 7. Migrate and seed the database
./vendor/bin/sail artisan migrate:fresh --seed
```

For more information on Laravel Sail, check out the [official documentation](https://laravel.com/docs/10.x/sail).

## Deployment

The fastest way to deploy Website Factory is by using our first-party [Docker image](https://hub.docker.com/r/code4romania/website-factory).

### Prerequisites

#### Generate an application key

Before deploying Website Factory, make sure you generate a valid application key. If you are not sure what an application key is, you can read more about it here: [`APP_KEY` And You](https://tighten.com/blog/app-key-and-you/) blog post on Tighten's website.

To generate an application key, you can run the following command in your terminal.

```sh
docker run --rm -it code4romania/website-factory php artisan key:generate --show
```

The generated application key will look like this:

```
base64:yEtz1eacKMwq0iVT5BUjMMvcn4OAD7QpCgz1yDoXroE=
```

### Running the image

Download the [example `docker-compose.yml`](docs/examples/docker-compose.yml) and configure the environment variables. Here's where you use the `APP_KEY` generated earlier. After you're done, save the file and run it with:

```sh
docker-compose up -d
```

You should now be able to access your instance admin area by visiting `<your-ip>:8080/admin` and logging in with the `ADMIN_EMAIL` and `ADMIN_PASSWORD` you specified in the configuration.


## Deployment on AWS / Microsoft Azure with terraform

We maintain two separate terraform repositories for Website Factory. To learn more about the infrastructure we provisioned for Website Factory on these cloud providers, please check their respective repositories:
- https://github.com/code4romania/terraform-aws-website-factory
- https://github.com/code4romania/terraform-azure-website-factory


## Feedback

-   Request a new feature on GitHub.
-   Vote for popular feature requests.
-   File a bug in GitHub Issues.
-   Email us with other feedback contact@code4.ro

## License

This project is licensed under the MPL 2.0 License - see the [LICENSE](LICENSE) file for details

## About Code for Romania

Started in 2016, Code for Romania is a civic tech NGO, official member of the Code for All network. We have a community of over 500 volunteers (developers, ux/ui, communications, data scientists, graphic designers, devops, it security and more) who work pro-bono for developing digital solutions to solve social problems. #techforsocialgood. If you want to learn more details about our projects [visit our site](https://www.code4.ro/en/) or if you want to talk to one of our staff members, please e-mail us at contact@code4.ro.

Last, but not least, we rely on donations to ensure the infrastructure, logistics and management of our community that is widely spread across 11 timezones, coding for social change to make Romania and the world a better place. If you want to support us, [you can do it here](https://code4.ro/en/donate/).
