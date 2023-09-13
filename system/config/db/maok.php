<?php
class Database
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    // GET THINK
    public function getInputLogin($npp)
    {
        $query = $this->pdo->prepare('SELECT * FROM user WHERE npp = :npp');
        $query->bindParam(':npp', $npp, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getHalaman($id)
    {
        $query = $this->pdo->prepare('SELECT id,hal,path FROM pages WHERE id=:id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function verifyAdminPassword($password)
    {
        $query = $this->pdo->prepare('SELECT password FROM user WHERE password = :pass');
        $query->bindParam(':pass', $password, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result !== false;
    }

    public function getHalPath($id)
    {
        $query = $this->pdo->prepare('SELECT id,path,hal,status,ket FROM pages WHERE id=:id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSessionToken($token)
    {
        $query = $this->pdo->prepare('SELECT * FROM sessions WHERE session_token = :token');
        $query->bindParam(':token', $token, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserByNppOrUsername($nppOrUsername)
    {
        $query = $this->pdo->prepare('SELECT * FROM user WHERE npp = :npp OR username = :username');
        $query->bindParam(':npp', $nppOrUsername, PDO::PARAM_INT);
        $query->bindParam(':username', $nppOrUsername, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSessionTokenExpired()
    { {
            $query = $this->pdo->prepare('SELECT * FROM sessions WHERE session_token_expires < NOW() - INTERVAL 1 HOUR');
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getDivisi()
    {
        $query = $this->pdo->prepare('SELECT * FROM divisi ORDER BY kode_divisi ASC');
        $query->execute();
        $result = $query->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getArea()
    {
        $query = $this->pdo->prepare('SELECT * FROM area ORDER BY kode_area ASC');
        $query->execute();
        $result = $query->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getDirektur()
    {
        $query = $this->pdo->prepare('SELECT * FROM direktur ORDER BY id ASC');
        $query->execute();
        $result = $query->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserforEdit($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM user WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getKartu($id_div,$id_dir)
    {
        $query = $this->pdo->prepare("
        SELECT kartu.no_kartu, area.id AS area_id, divisi.id_area
        FROM kartu
        JOIN area ON area.id = kartu.id_area
        LEFT JOIN divisi ON divisi.id_area = area.id AND divisi.id = :divisi_id
        LEFT JOIN direktur ON 
            (direktur.id_area = area.id AND direktur.id = :direktur_id)
            OR
            (direktur.id LIKE 'H-%' AND direktur.id = :direktur_id)
            OR
            (direktur.id LIKE '%-H' AND direktur.id = :direktur_id)
        WHERE (divisi.id IS NOT NULL OR direktur.id IS NOT NULL)
        GROUP BY kartu.no_kartu
        ORDER BY CAST(SUBSTRING(kartu.no_kartu, 3) AS UNSIGNED) ASC
    ");

        $query->bindParam(':divisi_id', $id_div, PDO::PARAM_INT);
        $query->bindParam(':direktur_id', $id_dir, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }






    public function getDataRegistrasi($id)
    {
        $query = $this->pdo->prepare('SELECT 
    registrasi.*, 
    dasar_izin.*,
    divisi.id as id_divisi, 
    divisi.nama_divisi, 
    kartu.no_kartu, 
    kartu.no_rfid,direktur.id as id_direktur,direktur.nama_dir,direktur.jabatan,
    DATEDIFF(dasar_izin.akhirKunjungan, dasar_izin.awalKunjungan) AS selisih_hari,area.id as idArea
FROM dasar_izin
LEFT JOIN registrasi ON registrasi.id_dasar = dasar_izin.id
LEFT JOIN divisi ON registrasi.id_divisi = divisi.id
LEFT JOIN direktur ON registrasi.id_direktur = direktur.id
LEFT JOIN kartu ON registrasi.id_kartu = kartu.id LEFT JOIN area ON divisi.id_area = area.id OR direktur.id_area = area.id
WHERE registrasi.id = :id');
        $query->execute(array(':id' => $id));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function countTamuBulan()
    {
        $query = $this->pdo->prepare('SELECT SUM(totalVisitor) as jumlah FROM registrasi WHERE MONTH(jam_masuk) = MONTH(NOW())');
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    // END GET THINK

    // DEL THINK
    public function deleteSessionsWithToken()
    {
        $query = $this->pdo->prepare('DELETE FROM sessions WHERE session_token IS NOT NULL');
        $query->execute();
        return $query->rowCount();
    }

    public function deleteExpiredSessions()
    {
        $query = $this->pdo->prepare('DELETE FROM sessions WHERE session_token IS NOT NULL AND session_token_expires < NOW() - INTERVAL 1 HOUR');
        $query->execute();
        return $query->rowCount();
    }

    public function deleteDataRegistrasi($id)
    {
        try {
            $deleteQuery = $this->pdo->prepare('DELETE r, d FROM registrasi r JOIN dasar_izin d ON r.id_dasar = d.id WHERE r.id = :id');
            $deleteQuery->bindParam(':id', $id, PDO::PARAM_INT);
            $deleteQuery->execute();
            return $deleteQuery->rowCount();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function deleteUserData($id)
    {
        try {
            $deleteQuery = $this->pdo->prepare('DELETE FROM user WHERE id= :id');
            $deleteQuery->bindParam(':id', $id, PDO::PARAM_STR);
            $deleteQuery->execute();
            return $deleteQuery->rowCount();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    // END DEL THINK

    // INSERT THINK
    public function insertSessionLogin($npp, $token, $expiry)
    {
        $query = $this->pdo->prepare('INSERT INTO sessions (npp,session_token,session_token_expires) VALUES (:npp,:token,:expiry)');
        $query->bindParam(':npp', $npp, PDO::PARAM_INT);
        $query->bindParam(':token', $token, PDO::PARAM_STR);
        $query->bindParam(':expiry', $expiry, PDO::PARAM_STR);

        try {
            $query->execute();
            return true; // Penyisipan berhasil
        } catch (PDOException $e) {
            // Penanganan kesalahan
            return false; // Penyisipan gagal
        }
    }

    public function insertDataPreRegister($dasar, $dasarIzin, $tglIzin, $awal, $akhir, $masaKunjungan, $instansi, $penerima, $divisi, $direktur, $jenisTamu, $status, $verifikasi, $user)
    {
        try {
            // Query untuk memasukkan data ke tabel dasar_izin
            $queryDasarIzin = $this->pdo->prepare('INSERT INTO dasar_izin (jenisIzin, dasar, tanggalDasar, awalKunjungan, akhirKunjungan, masaKunjungan) VALUES (:jenis, :dasar, :tglDasar, :awal, :akhir, :masa)');
            $queryDasarIzin->bindParam(':jenis', $dasar, PDO::PARAM_STR);
            $queryDasarIzin->bindParam(':dasar', $dasarIzin, PDO::PARAM_STR);
            $queryDasarIzin->bindParam(':tglDasar', $tglIzin, PDO::PARAM_STR);
            $queryDasarIzin->bindParam(':awal', $awal, PDO::PARAM_STR);
            $queryDasarIzin->bindParam(':akhir', $akhir, PDO::PARAM_STR);
            $queryDasarIzin->bindParam(':masa', $masaKunjungan, PDO::PARAM_STR);
            $queryDasarIzin->execute();

            // Mendapatkan ID dasar_izin yang baru saja disisipkan
            $idDasar = $this->pdo->lastInsertId();

            // Query untuk memasukkan data ke tabel registrasi
            $queryRegistrasi = $this->pdo->prepare('INSERT INTO registrasi (id_dasar, instansi, id_divisi, id_direktur, penerima, statusKunjungan, verifikasi, jenisTamu, id_user, nama, totalVisitor, alamat, keperluan, kendaraan, id_kartu, locker, jam_masuk, jam_keluar, noHp) VALUES (:id_dasar, :instansi, :divisi, :direktur, :penerima, :status, :verifikasi, :jenis, :user, :nama, :totalVisitor, :alamat, :keperluan, :kendaraan, :id_kartu, :locker, :jam_masuk, :jam_keluar, :noHp)');

            $queryRegistrasi->bindValue(':id_dasar', $idDasar, PDO::PARAM_INT);
            $queryRegistrasi->bindValue(':instansi', $instansi, PDO::PARAM_STR);
            $queryRegistrasi->bindValue(':divisi', $divisi, PDO::PARAM_INT);
            $queryRegistrasi->bindValue(':direktur', $direktur, PDO::PARAM_INT);
            $queryRegistrasi->bindValue(':penerima', $penerima, PDO::PARAM_STR);
            $queryRegistrasi->bindValue(':status', $status, PDO::PARAM_STR);
            $queryRegistrasi->bindValue(':verifikasi', $verifikasi, PDO::PARAM_STR);
            $queryRegistrasi->bindValue(':jenis', $jenisTamu, PDO::PARAM_STR);
            $queryRegistrasi->bindValue(':user', $user, PDO::PARAM_INT);
            $queryRegistrasi->bindValue(':nama', null, PDO::PARAM_NULL);
            $queryRegistrasi->bindValue(':totalVisitor', null, PDO::PARAM_NULL);
            $queryRegistrasi->bindValue(':alamat', null, PDO::PARAM_NULL);
            $queryRegistrasi->bindValue(':keperluan', null, PDO::PARAM_NULL);
            $queryRegistrasi->bindValue(':kendaraan', null, PDO::PARAM_NULL);
            $queryRegistrasi->bindValue(':id_kartu', null, PDO::PARAM_NULL);
            $queryRegistrasi->bindValue(':locker', null, PDO::PARAM_NULL);
            $queryRegistrasi->bindValue(':jam_masuk', null, PDO::PARAM_NULL);
            $queryRegistrasi->bindValue(':jam_keluar', null, PDO::PARAM_NULL);
            $queryRegistrasi->bindValue(':noHp', null, PDO::PARAM_NULL);

            $queryRegistrasi->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; // Penyisipan atau update gagal
        }
    }



    public function insertHistoryLogin($token, $expiry, $npp, $nama, $role, $browserName, $browserVersion, $deviceType)
    {
        $query = $this->pdo->prepare('INSERT INTO history_login (npp,nama,role,session_token,session_token_expires,tgl_login,browser,versi_browser,device) VALUES (:npp,:nama,:role,:token,:expiry,:tgl_login,:browser,:versi_browser,:device)');
        $query->bindParam(':token', $token, PDO::PARAM_STR);
        $query->bindParam(':expiry', $expiry, PDO::PARAM_STR);
        $query->bindParam(':npp', $npp, PDO::PARAM_INT);
        $query->bindParam(':nama', $nama, PDO::PARAM_STR);
        $query->bindParam(':role', $role, PDO::PARAM_STR);
        $query->bindParam(':tgl_login', $expiry, PDO::PARAM_STR);
        $query->bindParam(':browser', $browserName, PDO::PARAM_STR);
        $query->bindParam(':versi_browser', $browserVersion, PDO::PARAM_STR);
        $query->bindParam(':device', $deviceType, PDO::PARAM_STR);
        try {
            $query->execute();
            return true; // Penyisipan berhasil
        } catch (PDOException $e) {
            // Penanganan kesalahan
            return false; // Penyisipan gagal
        }
    }

    public function insertUser($npp, $nama, $user, $role, $password, $profil, $lokasi)
    {
        try {
            $query = $this->pdo->prepare("INSERT INTO user (npp, nama, username, role, password, profile, lokasi) VALUES (:npp, :nama, :user, :role, :password, :profil, :lokasi)");
            $query->bindParam(':npp', $npp, PDO::PARAM_INT);
            $query->bindParam(':nama', $nama, PDO::PARAM_STR);
            $query->bindParam(':user', $user, PDO::PARAM_STR);
            $query->bindParam(':role', $role, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->bindParam(':profil', $profil, PDO::PARAM_STR);
            $query->bindParam(':lokasi', $lokasi, PDO::PARAM_STR);
            $query->execute();

            return true; // Penyisipan berhasil

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    // END INSERT THINK

    // UPDATE THINK
    public function updatePageStatus($id, $status)
    {
        $query = $this->pdo->prepare('UPDATE pages SET status = CASE WHEN id = :id THEN "active" ELSE "inactive" END');
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->rowCount();
    }

    public function updateUserData($id, $nama, $npp, $user, $role, $password, $profil, $lokasi)
    {
        $query = $this->pdo->prepare('UPDATE user SET npp = :npp, nama = :nama, username = :user, role = :role, password = :password, profile = :profil, lokasi = :lokasi WHERE id = :id');
        $query->bindValue(':id', $id);
        $query->bindValue(':nama', $nama);
        $query->bindValue(':npp', $npp);
        $query->bindValue(':user', $user);
        $query->bindValue(':role', $role);
        $query->bindValue(':password', $password);
        $query->bindValue(':profil', $profil);
        $query->bindValue(':lokasi', $lokasi);
        $query->execute();
        return $query->rowCount();
    }

    public function updateStatusKunjungan($id, $status)
    {
        $query = $this->pdo->prepare('UPDATE registrasi SET jam_keluar=now(),statusKunjungan = :status WHERE id= :id');
        $query->bindValue(':id', $id);
        $query->bindValue(':status', $status);
        $query->execute();
        return $query->rowCount();
    }
}
