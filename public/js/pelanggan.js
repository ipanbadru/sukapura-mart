// Merubah nama file di tampilan HTML ketika memilih file Import Excel
const changeLabel = () => {
    var fileValue = document.querySelector('#file').value;
    var fileNameStart = fileValue.lastIndexOf('\\');
    fileValue = fileValue.substr(fileNameStart + 1);
    const label = document.querySelector("#file-label");
    if (fileValue !== '') {
        if (fileValue.length >= 21) {
            label.textContent = fileValue.substr(0, 30) + '...';
        } else {
            label.textContent = fileValue;
        }
    }
}

const pelanggan = (pelanggan, url) => {
    return {
        openModal: false,
        loading: false,
        title: '',
        nik: '',
        nama_pelanggan: '',
        no_hp: '',
        action: '',
        dataPelanggan: pelanggan.data,
        url,
        errors: {},
        method: '',
        resetInput() {
            this.nik = '';
            this.nama_pelanggan = '';
            this.no_hp = '';
        },
        // Tambah / Update Pelanggan
        submited(e) {
            e.preventDefault();
            this.loading = true;
            const form = document.querySelector('#form');
            const url = form.getAttribute('action');
            const promise = fetch(url, {
                    method: this.method,
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'url': url,
                        'X-CSRF-Token': document.querySelector(
                            'input[name=_token]').value
                    },
                    body: JSON.stringify({
                        nik: this.nik,
                        nama_pelanggan: this.nama_pelanggan,
                        no_hp: this.no_hp
                    }),
                }).then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.errors !== undefined) {
                        this.errors = data.errors;
                    } else {
                        this.openModal = false;
                        if (this.method == 'POST') {
                            if (this.dataPelanggan.length == 10) {
                                this.dataPelanggan.pop();
                            }
                            this.dataPelanggan.unshift(data);
                        } else if (this.method == 'PUT') {
                            this.dataPelanggan = this.dataPelanggan.map(pelanggan => {
                                if (pelanggan.id === data.id) {
                                    return data;
                                }
                                return pelanggan;
                            });
                        }
                        swal.fire('Berhasil', `Pelanggan Berhasil di ${this.method == 'POST' ? 'ditambahkan' : 'diubah' }`, 'success');
                    }
                })
                .catch(error => {
                    if (error.errors !== undefined) {
                        this.errors = error.errors;
                    } else {
                        alert("Error !!, Silahkan ulangi kembali");
                    }
                });
            promise.then(() => this.loading = false);
        },

        // Hapus Pelanggan
        hapusPelanggan(id) {
            const urlHapus = this.url + '/' + id;
            swal.fire({
                title: 'Yakin?',
                text: 'Apakah anda yakin akan menghapus Pelanggan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#7367f0',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(urlHapus, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'url': urlHapus,
                                'X-CSRF-Token': document.querySelector(
                                    'input[name=_token]').value
                            }
                        }).then(response => window.location.reload(false))
                        .catch(error => console.log(error));
                }
            })
        }
    }
}
