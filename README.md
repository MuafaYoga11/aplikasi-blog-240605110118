Nama Muafa Hanif Prayogo 
NIM 240605110118
Web aplikasi CMS Blog modern yang dikembangkan dengan Laravel. Dirancang untuk mempermudah manajemen konten blog, penulisan artikel, dan pengelolaan sistem secara efisien dan aman.
https://youtu.be/uFydDywDzuM?si=ajjYUttCl7FbxMDf

1. Persiapan Server & Database
Buka aplikasi Laragon, lalu klik tombol "Start All" untuk mengaktifkan server (Apache/Nginx & MySQL).

Klik tombol "Database" pada Laragon untuk membuka tool manajemen database (HeidiSQL/phpMyAdmin).

Buat database baru, kemudian Import file .sql yang telah disediakan ke dalam database tersebut.

2. Penempatan Folder Projek
Pastikan folder kode sumber (source code) website Anda sudah diletakkan di dalam direktori www milik Laragon.

Default path: C:\laragon\www\nama_folder_projek

Buka file konfigurasi database di dalam folder projek Anda, lalu sesuaikan pengaturannya:

DB_HOST: localhost

DB_USER: root

DB_PASSWORD: (kosongkan)

DB_NAME: nama_database_anda

3. Mengakses Website
Buka browser (Chrome/Edge/Firefox).

Laragon menyediakan fitur Pretty URLs, sehingga Anda bisa langsung mengakses website melalui alamat:
http://nama_folder_projek.test

Atau, Anda juga tetap bisa mengaksesnya melalui alamat standar:
http://localhost/nama_folder_projek

Tips: Jangan lupa untuk mengganti teks nama_folder_projek dan nama_database_anda di atas sesuai dengan nama folder dan nama database yang sebenarnya kamu gunakan.
