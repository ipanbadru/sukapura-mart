const kasir = (dataKasir, url) => {
    return {
        openModal : false,
        loading : false,
        title : '',
        nama : '',
        username : '',
        email : '',
        password : '',
        password_confirmation : '',
        url : url,
        action : '',
        method : '',
        errors : {},
        dataKasir: dataKasir.data,
        resetInput() {
            this.nama = '';
            this.username = '';
            this.email = '';
            this.password = '';
            this.password_confirmation = '';
        },

        // Tambah / Update Kasir
        submited(e) {
            e.preventDefault();
            this.loading = true;
            const form = document.querySelector('#form');
            const url = form.getAttribute('action');
            let data;
            if(this.password.length == 0 ){
                data = { nama: this.nama, username: this.username, email: this.email };
            }else{
                data = { nama: this.nama, username: this.username, email: this.email, password : this.password, password_confirmation : this.password_confirmation};
            }
            const promise = fetch(url, {
            method: this.method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'url': url,
                'X-CSRF-Token': document.querySelector(
                    'input[name=_token]').value
            },
            body: JSON.stringify(data),
            }).then(response => response.json())
            .then(data => {
                if(data.errors !== undefined){
                    this.errors = data.errors;
                }else{
                    this.openModal = false;
                    if(this.method == 'POST'){
                        if(this.dataKasir.length == 10){
                        this.dataKasir.pop();
                        }
                        this.dataKasir.unshift(data);
                    } else if(this.method == 'PUT'){
                        this.dataKasir = this.dataKasir.map(kasir => {
                            if(kasir.id === data.id){
                                return data;
                            }
                            return kasir;
                        });
                    }
                    swal.fire('Berhasil', `Kasir Berhasil di ${this.method == 'POST' ? 'ditambahkan' : 'diubah' }`,'success');
                }
            })
            .catch(error => {
                if(error.errors !== undefined){
                    this.errors = error.errors;
                }else{
                    alert("Error !!, Silahkan ulangi kembali");
                }
            });
            promise.then(() => this.loading = false);
        },

        // Hapus Kasir
        hapusKasir(id) {
            const urlHapus = this.url + '/' + id;
            swal.fire({
                title: 'Yakin?',
                text: 'Apakah anda yakin akan menghapus Kasir?',
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