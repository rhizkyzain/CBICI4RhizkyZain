Mahasiswa CRUD CI4

Aplikasi CRUD Mahasiswa menggunakan CodeIgniter 4, SQL Server, dengan fitur:

CRUD (Create, Read, Update, Delete) Mahasiswa

DataTables + AJAX untuk tampil data

JOIN Mahasiswa ↔ Jurusan untuk menampilkan nama jurusan

Validasi NIM dan Nama agar tidak duplikat

UI menggunakan Bootstrap 5 (modal tambah & edit, tombol hapus)


---- Cara Buat Database SQL Server ---

Buka SQL Server Management Studio (SSMS)

Jalankan query berikut:

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

Clone repo:

git clone <URL_REPO>
cd <NAMA_FOLDER_PROJECT>
composer install


Jalankan server:

php spark serve


Akses aplikasi di browser:

http://localhost:8080
