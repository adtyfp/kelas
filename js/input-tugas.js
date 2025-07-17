document.getElementById("formTugas").addEventListener("submit", function (e) {
  e.preventDefault();

  const nama = document.getElementById("namaTugas").value;
  const matkul = document.getElementById("mataKuliah").value;
  const deadline = document.getElementById("deadline").value;
  const fileInput = document.getElementById("uploadFile");
  const fileName = fileInput.files.length ? fileInput.files[0].name : "Belum ada file";

  const hasil = document.getElementById("hasil");
  hasil.style.display = "block";
  hasil.innerHTML = `
    <strong>✅ Tugas berhasil dikirim!</strong><br>
    <b>Nama Tugas:</b> ${nama}<br>
    <b>Mata Kuliah:</b> ${matkul}<br>
    <b>Deadline:</b> ${deadline}<br>
    <b>File:</b> ${fileName}
  `;

  // Simpan ke localStorage (opsional)
  const tugasBaru = { nama, matkul, deadline, fileName };
  const semuaTugas = JSON.parse(localStorage.getItem("dataTugas")) || [];
  semuaTugas.push(tugasBaru);
  localStorage.setItem("dataTugas", JSON.stringify(semuaTugas));

  this.reset();

  // Redirect ke kumpulkan.php setelah delay
  setTimeout(() => {
    window.location.href = "kumpulkan.php";
  }, 1500);
});
