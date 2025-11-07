Mahasiswa CRUD CI4

Aplikasi CRUD Mahasiswa menggunakan CodeIgniter 4, SQL Server, dengan fitur:

1. CRUD (Create, Read, Update, Delete) Mahasiswa

2. DataTables + AJAX untuk tampil data

3. JOIN Mahasiswa ↔ Jurusan untuk menampilkan nama jurusan

4. Validasi NIM dan Nama agar tidak duplikat

5. UI menggunakan Bootstrap 5 (modal tambah & edit, tombol hapus)


---- Cara Buat Database SQL Server ---

1. Buka SQL Server Management Studio (SSMS)

2. Jalankan query berikut:

CREATE DATABASE MahasiswaDB;
GO

USE MahasiswaDB;
GO

CREATE TABLE Jurusan (
    id_jurusan INT IDENTITY(1,1) PRIMARY KEY,
    nama_jurusan VARCHAR(100)
);

CREATE TABLE Mahasiswa (
    id_mahasiswa INT IDENTITY(1,1) PRIMARY KEY,
    nama VARCHAR(100),
    nim VARCHAR(50),
    id_jurusan INT,
    FOREIGN KEY (id_jurusan) REFERENCES Jurusan(id_jurusan)
);

INSERT INTO Jurusan (nama_jurusan)
VALUES ('Informatika'), ('Sistem Informasi'), ('Teknik Komputer');

------------------------------------------------------------------
Gunakan ENV berdasarkan .env.example dan isi database sesuai local sql server yang digunakan


-------------------------------------------------------------------
Install & Jalankan

1. Clone repo:

git clone <URL_REPO>
cd <NAMA_FOLDER_PROJECT>
composer install


2. Jalankan server:

php spark serve


3. Akses aplikasi di browser:

http://localhost:8080
