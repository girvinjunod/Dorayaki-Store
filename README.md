# Deskripsi Aplikasi Web

Aplikasi Web Dorayaki Apel Mangga Kucing merupakan suatu aplikasi web untuk pembelian dorayaki. Pengguna untuk menggunakan aplikasi harus melakukan login terlebih dahulu dengan akun yang sudah dibuat. Akun dapat dibuat melalui halaman register. Setelah login, pengguna akan diarahkan ke halaman dashboard. Dashboard menunjukkan top 8 varian dorayaki dari total penjualan. Pada aplikasi web terdapat suatu header yang berupa navigation bar yang juga memiliki suatu search bar. Search bar dapat dipakai untuk mencari varian dorayaki berdasarkan nama varian dorayaki. Navigation bar untuk pengguna juga menunjukkan username pengguna, yang ketika di-hover akan menunjukkan tombol logout. Ada juga tombol untuk pergi ke halaman riwayat pembelian di Navigation bar yang akan mengarahkan pengguna ke riwayat pembeliannya. Dengan meng-klik tombol di card varian dorayaki yang ada di dashboard atau hasil pencarian, pengguna akan diarahkan ke halaman detail dorayaki. Dari halaman ini pengguna dapat meng-klik tombol untuk diarahkan ke halaman pembelian di mana pengguna dapat memilih banyaknya dorayaki yang ingin dibeli dari varian tersebut. Ada pengguna khusus yang berupa admin. Untuk admin, ada beberapa fitur yang berbeda. Fitur ini adalah penambahan varian dorayaki, yang halamannya dapat diakses dari navigation bar. Ada juga fitur perubahan stok varian dorayaki, perubahan detail dorayaki, dan penghapusan varian dorayaki.

# Daftar Requirement

1. PHP
2. SQLite3
3. Docker
4. Apache Server / NGINX

# Cara Instalasi

### Melalui Lokal

1. Install PHP pada sistem operasi yang digunakan
2. Install Apache Server pada sistem operasi yang digunakan
3. Install SQLite pada sistem operasi yang digunakan

### Melalui Docker

1. Install Docker, dapat mengikuti panduan pada https://docs.docker.com/engine/install/
2. Install Docker Compose, dapat mengikuti panduan pada https://docs.docker.com/compose/install/

# Cara Menjalankan Server

### Melalui Lokal

1. Jalankan `PHP -S localhost:{port}` di directory repository ({port} dapat diganti dengan nilai seperti 8000)

### Melalui Docker

1. Jalankan perintah `docker-compose up` di directory repository

# Screenshot Tampilan Aplikasi

1. Halaman Login
   ![Login Page](./screenshot/login.png)
2. Halaman Register
   ![Register Page](./screenshot/register.png)

3. Halaman Dashboard

   #### User Dashboard

   ![User Dashboard Page](./screenshot/dashboard_user.png)
   ![User Dashboard Page](./screenshot/dashboard_user2.png)

   #### Admin Dashboard

   ![User Dashboard Page](./screenshot/dashboard_admin.png)

4. Halaman Hasil Pencarian
   ![Search Page](./screenshot/search.png)
   ![Search2 Page](./screenshot/search_2.png)

5. Halaman Penambahan Varian Dorayaki Baru
   ![Add Dorayaki Page](./screenshot/add_variant.png)

6. Halaman Detail Varian Dorayaki

   #### User Detail Variant

   ![User Detail Page](./screenshot/detail_user.png)

   #### Admin Detail Variant

   ![Admin Detail Page](./screenshot/detail_admin.png)
   ![Edit Detail Page](./screenshot/edit_admin.png)

7. Halaman Pengubahan Stok / Pembelian Dorayaki
   ![Pembelian Page](./screenshot/pembelian_user.png)
   ![Pembelian Page](./screenshot/pembelian_user2.png)

8. Data Expire Time
   ![Token](./screenshot/token.png)

9. Responsive Design
   ![Responsive Page](./screenshot/addvariant_responsive.png)
   ![Responsive Page](./screenshot/dashboard_responsive.png)
   ![Responsive Page](./screenshot/dashboard2_responsive.png)
   ![Responsive Page](./screenshot/detail_responsive.png)
   ![Responsive Page](./screenshot/login_responsive.png)
   ![Responsive Page](./screenshot/pembelian_responsive.png)
   ![Responsive Page](./screenshot/riwayat_admin_responsive.png)
   ![Responsive Page](./screenshot/riwayat_responsive.png)
   ![Responsive Page](./screenshot/search_responsive.png)

10. Halaman Riwayat Pengubahan Stok / Pembelian Dorayaki
    ![Riwayat Admin Page](./screenshot/riwayat_admin.png)

# Pembagian Tugas

<ins>Server-side</ins>

- Register: 13519096
- Riwayat: 13519096
- Add Variant: 13519096
- Login: 13519048, 13519096
- Dashboard: 13519048
- Pencarian dan hasil pencarian: 13519090
- Detail Dorayaki: 13519090
- Pembelian/Pengubahan Stok Dorayaki: 13519090
- Edit & Delete Variant Dorayaki : 13519090

<ins>Client-side</ins>

- Register: 13519096
- Riwayat: 13519096
- Add Variant: 13519096
- Login: 13519048
- Dashboard: 13519048
- Pencarian dan hasil pencarian: 13519090
- Detail Dorayaki: 13519090
- Pembelian/Pengubahan Stok Dorayaki: 13519090
- Edit & Delete Variant Dorayaki : 13519090
- Navbar, Komponen HTML : 13519048

<ins>Misc</ins>

- Docker: 13519096
- Responsive Web: 13519090
- Data Expire Time: 13519096
- Debugging: 13519090, 13519096
