-- 1) Crear base de datos
CREATE DATABASE IF NOT EXISTS crud_pdo
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

-- 2) Usar la base
USE crud_pdo;

-- 3) Crear tabla de ejemplo
CREATE TABLE IF NOT EXISTS citas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre_dueno VARCHAR(120) NOT NULL,
  nombre_mascota VARCHAR(120) NOT NULL,
  tipo_mascota VARCHAR(50) NOT NULL,
  fecha_cita DATE NOT NULL,
  hora_cita TIME NOT NULL,
  motivo_cita TEXT NOT NULL,
  estado_cita ENUM('pendiente', 'completada', 'cancelada') NOT NULL DEFAULT 'pendiente',
  email VARCHAR(120) NOT NULL UNIQUE,
  numero_telefono VARCHAR(20) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

/*
CREATE USER 'crud_user'@'localhost' IDENTIFIED BY 'mococso795028';
GRANT ALL PRIVILEGES ON crud_pdo.* TO 'crud_user'@'localhost';
FLUSH PRIVILEGES;
*/