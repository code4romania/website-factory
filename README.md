# Website factory: Primărie

[![GitHub contributors][ico-contributors]][link-contributors]
[![GitHub last commit][ico-last-commit]][link-last-commit]
[![License: MPL 2.0][ico-license]][link-license]

Insert bullets description of the project if available.

[See the project live][link-production]

Give a short introduction of your project. Let this section explain the objectives or the motivation behind this project.

[Contributing](#contributing) | [Built with](#built-with) | [Development](#development) | [Deployment](#deployment) | [Feedback](#feedback) | [License](#license) | [About Code for Romania](#about-code-for-romania)

## Contributing

This project is built by amazing volunteers and you can be one of them! Here's a list of ways in [which you can contribute to this project][link-contributing]. If you want to make any change to this repository, please **make a fork first**.

Help us out by testing this project in the [staging environment][link-staging]. If you see something that doesn't quite work the way you expect it to, open an Issue. Make sure to describe what you _expect to happen_ and _what is actually happening_ in detail.

If you would like to suggest new functionality, open an Issue and mark it as a __[Feature request]__. Please be specific about why you think this functionality will be of use. If you can, please include some visual description of what you would like the UI to look like, if you are suggesting new UI elements.

## Built With

- Laravel 8.x
- Tailwind CSS
### Requirements

- PHP 8.0+
- MySQL
- nginx / Apache

## Development

This project uses Laravel's default Docker development environment, Laravel Sail.

To get started, copy the default env file:
```shell
cp .env.example .env
```

By default, Laravel Sail uses ports 80 for the webserver and 3306 for the database. If you're already using these ports on your machine, make sure to change the following entries in your `.env` file:
```ini
APP_PORT=80
FORWARD_DB_PORT=3306
```

Start the application:
```shell
./vendor/bin/sail up
```

Generate a new `APP_KEY`:
```shell
./vendor/bin/sail artisan key:generate
```

Run the database migrations
```shell
./vendor/bin/sail artisan migrate
```

To learn more about Laravel Sail, check out the [official documentation](https://laravel.com/docs/sail).

## Deployment

Guide users through getting your code up and running on their own system. In this section you can talk about:
1. Installation process
2. Software dependencies
3. Latest releases
4. API references

Describe and show how to build your code and run the tests.

## Feedback

* Request a new feature on GitHub.
* Vote for popular feature requests.
* File a bug in GitHub Issues.
* Email us with other feedback contact@code4.ro

## License

This project is licensed under the MPL 2.0 License - see the [LICENSE](LICENSE) file for details

## About Code for Romania

Started in 2016, Code for Romania is a civic tech NGO, official member of the Code for All network. We have a community of around 2.000 volunteers (developers, ux/ui, communications, data scientists, graphic designers, devops, it security and more) who work pro-bono for developing digital solutions to solve social problems. #techforsocialgood. If you want to learn more details about our projects [visit our site][link-code4] or if you want to talk to one of our staff members, please e-mail us at contact@code4.ro.

Last, but not least, we rely on donations to ensure the infrastructure, logistics and management of our community that is widely spread across 11 timezones, coding for social change to make Romania and the world a better place. If you want to support us, [you can do it here][link-donate].


[ico-contributors]: https://img.shields.io/github/contributors/code4romania/website-factory-primarie.svg?style=for-the-badge
[ico-last-commit]: https://img.shields.io/github/last-commit/code4romania/website-factory-primarie.svg?style=for-the-badge
[ico-license]: https://img.shields.io/badge/license-MPL%202.0-brightgreen.svg?style=for-the-badge

[link-contributors]: https://github.com/code4romania/website-factory-primarie/graphs/contributors
[link-last-commit]: https://github.com/code4romania/website-factory-primarie/commits/main
[link-license]: https://opensource.org/licenses/MPL-2.0
[link-contributing]: https://github.com/code4romania/.github/blob/main/CONTRIBUTING.md

[link-production]: insert_link_here
[link-staging]: insert_link_here

[link-code4]: https://www.code4.ro/en/
[link-donate]: https://code4.ro/en/donate/
