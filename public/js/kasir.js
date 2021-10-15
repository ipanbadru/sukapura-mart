const kasir = () => {
    return {
        openModal: false,
        loading : false,
        title : '',
        id_kasir: '',
        nama : '',
        username : '',
        email : '',
        password : '',
        password_confirmation : '',
        resetInput() {
            this.id_kasir = '';
            this.nama = '';
            this.username = '';
            this.email = '';
            this.password = '';
            this.password_confirmation = '';
        },
    }
}