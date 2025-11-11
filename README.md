# TP7DPBO2425C2

Saya Farah Maulida dengan NIM 2410024 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berbasis Objek untuk keberkahan-Nya maka saya tidak akan melakukan kecurangan seperti yang telah di spesifikasikan Aamiin.

# Deskripsi Website

Program ini merupakan implementasi konsep Object-Oriented Programming (OOP) dalam pembuatan aplikasi berbasis web menggunakan PHP dan MySQL. Tema utama website ini adalah Sistem Pemesanan Tiket Konser, yang dirancang untuk mensimulasikan proses transaksi tiket konser secara dinamis. Website ini memungkinkan pengguna untuk melakukan berbagai aktivitas yang berkaitan dengan pengelolaan konser dan pemesanan tiket. Pengguna dapat menambahkan, mengedit, dan menghapus data konser, serta membuat dan memperbarui pesanan tiket. Ketika pesanan baru dibuat, sistem akan secara otomatis mengurangi stok tiket konser sesuai jumlah yang dipesan. Jika pesanan diubah atau dibatalkan, sistem akan menyesuaikan stok kembali agar tetap akurat.

# Penjelasan Database

Struktur database pada proyek ini dirancang untuk mendukung sistem pemesanan tiket konser dengan hubungan antar tabel yang merepresentasikan entitas utama dalam sistem.

1. Tabel "concerts"

Tabel ini menyimpan data konser yang tersedia di sistem. Setiap konser memiliki informasi artis, tempat, tanggal konser, harga tiket, dan jumlah stok tiket yang masih tersedia.
Struktur kolomnya adalah id — Primary key yang unik untuk setiap konser, artist — Nama artis, grup musik, atau festival yang mengadakan konser, venue_id — Foreign key yang terhubung ke tabel venues, menunjukkan lokasi konser, date — Tanggal pelaksanaan konser, price — Harga tiket untuk satu penonton (dalam format decimal), stock — Jumlah tiket yang tersedia untuk konser tersebut.

Relasi antara tabel concerts dan venues menggunakan foreign key (venue_id) dengan aturan ON DELETE CASCADE, sehingga jika sebuah venue dihapus, semua konser di venue tersebut juga akan otomatis terhapus.

2. Tabel "venues"

Tabel ini menyimpan informasi mengenai tempat atau lokasi konser. Setiap venue memiliki atribut seperti nama, alamat, kota, dan kapasitas penonton. Data pada tabel ini menjadi referensi utama untuk konser yang diselenggarakan. Tabel ini menjadi parent bagi tabel concerts, di mana satu venue dapat digunakan untuk banyak konser (relasi one-to-many). Struktur kolomnya adalah sebagai berikut id — Primary key yang bersifat auto increment, name — Nama venue atau stadion tempat konser berlangsung, address — Alamat venue, city — Kota tempat venue berada, capacity — Kapasitas maksimal venue dalam menampung penonton.

3. Tabel "orders"

Tabel ini berfungsi untuk mencatat setiap pemesanan tiket yang dilakukan pengguna. Setiap order terhubung langsung ke konser tertentu dan menyimpan informasi mengenai nama pemesan, jumlah tiket yang dibeli, total harga, serta tanggal pemesanan. Struktur kolomnya adalah id — Primary key unik untuk setiap pemesanan, name — Nama pelanggan atau pembeli tiket, concert_id — Foreign key yang menghubungkan pesanan dengan konser tertentu, quantity — Jumlah tiket yang dipesan, total_price — Total harga pesanan (harga tiket × jumlah tiket), order_date — Waktu pemesanan tiket, secara default diisi otomatis dengan timestamp saat data dibuat.

Relasi antara tabel orders dan concerts memastikan bahwa apabila sebuah konser dihapus, semua pesanan yang terkait dengan konser tersebut juga akan ikut terhapus.

# Alur Program

Ketika pengguna pertama kali membuka website, halaman utama akan menampilkan daftar seluruh konser yang tersimpan di tabel concerts. Di halaman ini, pengguna dapat menambah konser baru, memperbarui informasi konser yang sudah ada, atau menghapus konser yang tidak lagi tersedia. Saat pengguna menambahkan konser baru melalui formulir yang berisi nama, harga, dan stok tiket, data tersebut dikirim ke addConcert(). Model ini kemudian menjalankan perintah INSERT untuk menyimpan data ke database, dan setelah proses selesai, pengguna otomatis diarahkan kembali ke halaman utama untuk melihat hasil pembaruan.

Selain daftar konser, terdapat halaman khusus untuk order atau pesanan tiket yang menampilkan semua transaksi yang sudah dibuat dari tabel orders. Di halaman ini, pengguna juga bisa menambah, mengedit, maupun menghapus pesanan. Saat pengguna membuat pesanan baru, sistem akan memeriksa terlebih dahulu stok tiket konser yang dipesan dari tabel concerts. Jika stok mencukupi, sistem akan menyimpan data pesanan baru ke tabel orders dan secara otomatis mengurangi jumlah stok konser sesuai dengan jumlah tiket yang dibeli. Namun, jika stok tidak mencukupi, sistem akan menolak pesanan dan memberikan notifikasi kegagalan.

Ketika pengguna mengubah pesanan yang sudah ada, sistem akan mengembalikan terlebih dahulu stok tiket dari pesanan lama ke konser sebelumnya. Setelah itu, sistem akan menghitung ulang stok berdasarkan jumlah tiket baru yang dipesan dan memperbarui total harga pesanan berdasarkan harga konser yang relevan. Semua proses ini dijalankan oleh fungsi updateOrder(). Sementara itu, jika pengguna memutuskan untuk menghapus pesanan, sistem akan secara otomatis menambahkan kembali jumlah tiket yang dibatalkan ke stok konser terkait.

# Dokumentasi

<video src="Dokumentasi/TP7_VID.mp4" controls width="700"></video>
