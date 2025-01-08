<?php
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ambil data user berdasarkan session
$username = $_SESSION['username'];
$query = $conn->prepare("SELECT * FROM user WHERE username = ?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

// Proses update data
if (isset($_POST['update_profile'])) {
    $new_username = $_POST['username'];
    $password = $_POST['password'];
    $foto = $_FILES['foto']['name'];
    $foto_lama = $user['foto'];
    $update_password = false;

    // Update password jika diisi
    if (!empty($password)) {
        $password = md5($password); // Enkripsi MD5
        $update_password = true;
    }

    // Proses upload foto jika ada file baru
    if (!empty($foto)) {
        $gambar = "image/";
        $target_file = $gambar . basename($foto);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Validasi ekstensi file
        if (in_array($imageFileType, $valid_extensions)) {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                // Hapus foto lama jika bukan default
                if ($foto_lama != 'default.jpg') {
                    unlink($gambar . $foto_lama);
                }
            } else {
                echo "<script>alert('Gagal mengupload foto.');</script>";
                die;
            }
        } else {
            echo "<script>alert('Ekstensi file tidak valid. Hanya JPG, JPEG, PNG, dan GIF diperbolehkan.');</script>";
            die;
        }
    } else {
        $foto = $foto_lama; // Gunakan foto lama jika tidak ada upload baru
    }

    // Update data user
    if ($update_password) {
        $stmt = $conn->prepare("UPDATE user SET username = ?, password = ?, foto = ? WHERE id = ?");
        $stmt->bind_param("sssi", $new_username, $password, $foto, $user['id']);
    } else {
        $stmt = $conn->prepare("UPDATE user SET username = ?, foto = ? WHERE id = ?");
        $stmt->bind_param("ssi", $new_username, $foto, $user['id']);
    }

    $update = $stmt->execute();

    if ($update) {
        $_SESSION['username'] = $new_username; // Update session username
        echo "<script>
            alert('Profil berhasil diperbarui.');
            document.location='admin.php?page=profil';
        </script>";
    } else {
        echo "<script>alert('Gagal memperbarui profil.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<body>
<div class="container">
    <form method="post" action="" enctype="multipart/form-data">
        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" required>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Ganti Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Tuliskan password baru jika ingin mengganti password">
        </div>

        <!-- Foto Profil -->
        <div class="mb-3">
            <label for="foto" class="form-label">Ganti Foto Profil</label>
            <div class="mb-2">
            <input type="file" class="form-control" id="foto" name="foto">
            </div>
            <div class="mb-3">
            <label for="formFile" class="form-label">Foto Profil Saat Ini</label>
            <div>
            <div>
                <img src="image/<?= $user['foto']; ?>" alt="Foto Profil" width="100" class="mb-2">
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="update_profile" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>