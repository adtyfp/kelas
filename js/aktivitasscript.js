function muatAktivitas() {
    let aktivitas = JSON.parse(localStorage.getItem('aktivitasTags')) || [];
    renderAktivitas(aktivitas);
  }

  function renderAktivitas(aktivitas) {
    const aktivitasList = document.getElementById('aktivitasList');
    aktivitasList.innerHTML = '';

    if (aktivitas.length === 0) {
      aktivitasList.innerHTML = '<p style="text-align: center; color: #7f8c8d;">Tidak ada aktivitas</p>';
      return;
    }

    aktivitas.forEach(item => {
      const aktivitasItem = document.createElement('div');
      aktivitasItem.className = 'aktivitas-item';
      aktivitasItem.dataset.id = item.id;

      aktivitasItem.innerHTML = `
        <div class="icon-bulat ${item.color}">
          <i class="fas fa-${item.icon}"></i>
        </div>
        <div class="aktivitas-info">
          <div class="nama-aktivitas">${item.judul}</div>
          <div class="waktu-aktivitas">${item.waktu}</div>
        </div>
        <div class="hapus-btn"><i class="fas fa-times"></i></div>
      `;

      aktivitasList.appendChild(aktivitasItem);
    });

    document.querySelectorAll('.hapus-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const item = this.closest('.aktivitas-item');
        const id = parseInt(item.dataset.id);
        item.remove();
        hapusAktivitas(id);
      });
    });
  }

  function hapusAktivitas(id) {
    let aktivitas = JSON.parse(localStorage.getItem('aktivitasTags')) || [];
    aktivitas = aktivitas.filter(item => item.id !== id);
    localStorage.setItem('aktivitasTags', JSON.stringify(aktivitas));
    renderAktivitas(aktivitas);
  }

  function hapusSemuaAktivitas() {
    if (confirm('Yakin ingin menghapus semua aktivitas?')) {
      localStorage.removeItem('aktivitasTags');
      renderAktivitas([]);
    }
  }

  document.getElementById('hapusSemua').addEventListener('click', hapusSemuaAktivitas);
  document.addEventListener('DOMContentLoaded', muatAktivitas);
  