const kasir = () => {
    return {
        openModal : false,
        loading : false,
        title : '',
        nama : '',
        username : '',
        email : '',
        password : '',
        password_confirmation : '',
        action : '',
        method : '',
        errors : {},
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
                    this.loading = false;
                }else{
                    window.location.reload(false);
                }
            })
            .catch(error => {
                if(error.errors !== undefined){
                    this.errors = error.errors;
                    this.loading = false;
                }else{
                    alert("Error !!, Silahkan ulangi kembali");
                }
            });
        },

        // Hapus Kasir
        hapusKasir(urlHapus) {
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