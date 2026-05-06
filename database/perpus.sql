CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100),
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    role VARCHAR(20) DEFAULT 'petugas',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE anggota (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(100),
    alamat TEXT,
    no_hp VARCHAR(20),
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE buku (
    id SERIAL PRIMARY KEY,
    judul VARCHAR(150),
    penulis VARCHAR(100),
    penerbit VARCHAR(100),
    tahun INT,
    stok INT DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE transaksi (
    id SERIAL PRIMARY KEY,
    anggota_id INT,
    user_id INT,
    tanggal_pinjam DATE,
    tanggal_kembali DATE NULL,
    status VARCHAR(20) DEFAULT 'pinjam',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_anggota
        FOREIGN KEY (anggota_id) REFERENCES anggota(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
);

INSERT INTO users (name, username, password, role)
VALUES (
    'Admin',
    'admin',
    MD5('admin123'),
    'admin'
);

CREATE TABLE detail_transaksi (
    id SERIAL PRIMARY KEY,
    transaksi_id INT,
    buku_id INT,
    jumlah INT DEFAULT 1,

    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
    FOREIGN KEY (buku_id) REFERENCES buku(id) ON DELETE CASCADE
);




