function until(judul,isi,act,url) {
  if (act == 'dir') {
    if (judul == 'warning') {
      if (confirm('Peringatan !\n'+isi)) {
        window.location.href = url;
      }
    }
  }else {
    if (judul == 'warning') {
      alert('Peringatan !\n'+isi);
    }else if (judul == 'success') {
      alert('Berhasil !\n'+isi);
    }else if (judul == 'error') {
      alert('Gagal !\n'+isi);
    }else if (judul == 'info') {
      alert('Informasi !\n'+isi);
    }
  }
}
