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

const pelanggan = () => {
    return {
        openModal: false,
        openModalImport: false,
        loading: false,
        title: '',
        id_pelanggan: '',
        nik: '',
        nama_pelanggan: '',
        no_hp: '',
        resetInput() {
            this.id_pelanggan = '';
            this.nik = '';
            this.nama_pelanggan = '';
            this.no_hp = '';
        },
    }
}
