<<<<<<< HEAD
# mini-shop-lite
Full-stack Laravel 11 e-commerce mini app 


# Mini Shop Lite — Laravel Full-Stack Assessment
### Overview
A simple Laravel e-commerce skeleton for the Red Giant Full-Stack Internship assessment.  
Admin can manage products; customers can browse, add to cart, and checkout.

### Tech Stack
- Laravel 11
- Blade + TailwindCSS
- Laravel Breeze (Auth)
- MySQL (Eloquent ORM)
- RESTful API (Products, Orders)

### Setup Instructions
1. Clone the repository:
   ```bash
   git clone https://github.com/experiencedprogrammar/minishop-lite.git
   cd mini-shop-lite
2. composer install
3. npm install
   npm run dev
4. cp .env.example .env
5. Update database credentials in .env:
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
6. Generate application key
    php artisan key:generate
7. Run migrations & seed demo data
    php artisan migrate --seed
8. Running the Application
   php artisan serve
9. Visit: http://127.0.0.1:8000
10. Admin dashboard: http://127.0.0.1:8000/admin/dashboard
11.Customer:login with customer@demo.com / Customer@12
12. Admin with admin@demo.com / Admin@12

      SQL Screenshots
   <img width="632" height="322" alt="Top 5 sold products" src="https://github.com/user-attachments/assets/04a4d89f-4642-43a5-8374-c96f0b989fab" />
   <img width="634" height="342" alt="last 7 days revenue" src="https://github.com/user-attachments/assets/8c14467f-599c-43de-8f42-fe4f031955ed" />
   <img width="564" height="199" alt="lifetime spent" src="https://github.com/user-attachments/assets/a6cb4f35-5582-4868-82ad-118be2941f21" />

   










   
   
   
=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
>>>>>>> 08db12c (Initial commit - Mini Shop Lite Laravel project)
