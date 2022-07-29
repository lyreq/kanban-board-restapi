
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Kanban Board Nedir?

Kanban Board kullanıcı notlarının bulunduğu bir mobil uygulamadır. Mobil uygulamaya verileri Rest API aracılığı ile JSON formatında veriler gönderilmektedir. Bu sayede hem mobil hem de web ile entegre bir şekilde uygulama çalışmaktadır.

## Rest API kullanırken kullandığım kütüphane

Laravel'in passport kütüphanesini kullandım. JSON formatında üye email ve password bilgisini alıp bir token oluşturdum. Ardından da bu token ile diğer servislere erişim verdirttim. Bu token olmadan diğer servislere erişim sağlanamaz.

## Projenin Kurulumu

1) Composer'ı kuralım

		composer install
2) Örnek env'den env dosyası oluşturalım

		cp .env.example .env	
3) Yeni bir key oluşturalım

		php artisan key:generate
4) env dosyasında veri tabanı bağlantısını yapalım. Ardından veritabanı adınıza göre bir veri tabanı oluşturun.

		DB_DATABASE=VERTİTABANINIZ

		DB_USERNAME=VERİTABANI KULLANICI ADINIZ

		DB_PASSWORD=VERİTABANI ŞİFRENİZ
	
5) Projeyi Migrate edelim. Aynı zamanda seed edip örnek verileri de veritabanımıza dahil edelim.

		php artisan migrate --seed
6) Passport ile örnek bir token oluşturalım

		php  artisan  passport:install
7) Projeyi başlatalım

		php artisan serve


## Projede Servislerin Kullanımı
####	
Projede tüm servislerin kullanımını hakkında https://www.getpostman.com/collections/c56f13ffd31e8cf96c9e 
postman'a bu json bağlantısını import ederek detaylı bilgi alabilirsiniz.


	

