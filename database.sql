-- Membuat Tabel Pendaftaran
CREATE TABLE Pendaftaran (
    id_pendaftaran INT PRIMARY KEY AUTO_INCREMENT,
    nama_lengkap VARCHAR(255) NOT NULL,
    alamat_email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Membuat Tabel Booking
CREATE TABLE Booking (
    id_booking INT PRIMARY KEY AUTO_INCREMENT,
    nama_lengkap VARCHAR(255) NOT NULL,
    tanggal_pendakian DATE NOT NULL,
    jalur_pendakian ENUM('Selo', 'Wekas', 'Suwanting', 'Thekelan') NOT NULL
);