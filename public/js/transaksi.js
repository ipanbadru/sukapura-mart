// Mengolah Input Select
const inputPelanggan = new SlimSelect({
    select: document.querySelector('select#pelanggan')
});
const metodePembayaran = new SlimSelect({
    select: document.querySelector('select#metode_pembayaran'),
    showSearch: false,
});
inputPelanggan.disable();

// Mengolah Data Transaksi
const transaksi = (allBarang) => {
    return {
        metode_pembayaran: 'cash',
        pelanggan: '',
        barangBelanja: [],
        url: document.querySelector('#form-search-barang').getAttribute('action'),
        open: true,
        search: '',
        totalBayar: '',
        resultSearchBarang : [],
        loadingSearch: false,
        loadingTransaksi : false,
        loadingAddBarangBelanja : false,
        cekMetodePembayaran(){
            if(this.metode_pembayaran === 'credit'){
                inputPelanggan.enable();
                inputPelanggan.open();
            }else{
                inputPelanggan.disable();
                inputPelanggan.set('');
            }
        },
        resetAll() {
            this.search = '';
            this.totalBayar = '';
            this.barangBelanja = [];
            this.resultSearchBarang = [];
            this.totalHarga;
        },
        searchBarangs(){
            const regex = /^\d+\d+\d+$/;
            this.resultSearchBarang = [];
            if(!regex.test(this.search) && this.search != ''){
                this.loadingSearch = true;
                const result = allBarang.filter(data => data.nama_barang.toLowerCase().includes(this.search));

                this.loadingSearch = false;
                this.resultSearchBarang = result.slice(0, 5);
            }
            this.open = true;
        },
        addBarangBelanja() {
            this.loadingAddBarangBelanja = true;
            const barang = allBarang.find(barang => barang.nama_barang == this.search || barang.kode_barang == this.search);
            if(barang == undefined){
                swal.fire('gagal', 'Barang belum terdaftar', 'error');
            }else{
                let checkingBarang;
                this.barangBelanja.forEach((data, index) => {
                    if(data.id === barang.id){
                        checkingBarang = index;
                    }
                });
                if (checkingBarang == undefined) {
                    this.barangBelanja.unshift({
                        id: barang.id,
                        'nama_barang': barang.nama_barang,
                        jumlah: 1,
                        hargaJual : barang.harga_jual,
                        harga: barang.harga_jual,
                    });
                } else {
                    this.increment(checkingBarang);
                }
            }
            this.search = '';
            document.querySelector('#input-barang').focus();
            this.loadingAddBarangBelanja = false;
        },
        setSearch(value) {
            this.search = value;
            this.addBarangBelanja();
        },
        submitedSearch(e) {
            e.preventDefault();
            this.addBarangBelanja();
        },

        // Kelola data Barang Belanja
        resetHarga(index) {
            const jumlah = (parseInt(this.barangBelanja[index].hargaJual.replace(/\D/g, '')) * this.barangBelanja[index].jumlah) + '';
            this.barangBelanja[index].harga = formatRupiah(jumlah, 'Rp. ');
        },
        increment(index) {
            this.barangBelanja[index].jumlah += 1;
            this.resetHarga(index);
        },
        decrement(index) {
            if(this.barangBelanja[index].jumlah - 1 > 0){
                this.barangBelanja[index].jumlah -= 1;
                this.resetHarga(index);
            }
        },
        hapusBarangBelanja(index) {
            const newBarangBelanja = this.barangBelanja.filter((barang, barangIndex) => {
                if(barangIndex !== index){
                    return barang;
                }
            });
            this.barangBelanja = [...newBarangBelanja];
        },

        // Kelola Pembayaran
        get totalHarga() {
            if(this.barangBelanja.length == 0){
                return 0;
            }
            const total = this.barangBelanja.reduce((accumulator, currentValue) => accumulator + (parseInt(currentValue.harga.replace(/\D/g, ''))), 0) + '';
            return formatRupiah(total, 'Rp. ');
        },
        get kembalian() {
            if(this.barangBelanja.length == 0 || this.totalBayar == ''){
                return 0;
            }
            const kembali = (parseInt(this.totalBayar.replace(/\D/g, '')) - parseInt(this.totalHarga.replace(/\D/g, '')));
            if(kembali < 0){
                return 0;
            }
            return formatRupiah(kembali + '', 'Rp. ');
        },
        get sisaTagihan() {
            if(this.barangBelanja.length == 0 || this.totalBayar == ''){
                return 0;
            }
            const tagihan = (parseInt(this.totalHarga.replace(/\D/g, '')) - parseInt(this.totalBayar.replace(/\D/g, '')));
            return formatRupiah(tagihan + '', 'Rp. ');
        },
        set total(value){
            this.totalBayar = formatRupiah(value, 'Rp. ');
        },
        get disabledSubmit(){
            if(this.barangBelanja.length == 0 || this.totalHarga == 0 || this.totalBayar == ''){
                return true;
            }else {
                if(this.metode_pembayaran == 'cash'){
                    if(this.kembalian == 0){
                        return true;
                    }else{
                        return false;
                    }
                }else if(this.metode_pembayaran == 'credit'){
                    if(this.sisaTagihan == 0){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        },
        submitedBayar(e){
            e.preventDefault();
            this.loadingTransaksi = true;
            const barangs = this.barangBelanja;
            const totalHarga = this.totalHarga;
            const totalBayar = this.totalBayar;
            const totalKembali = this.kembalian;
            const sisaTagihan = this.sisaTagihan;
            const idPelanggan = this.pelanggan;
            const url = document.querySelector('#form-bayar').getAttribute('action');
            const promise = fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'url': url,
                    'X-CSRF-Token': document.querySelector(
                        'input[name=_token]').value
                },
                body: JSON.stringify({
                    barangs,
                    totalHarga,
                    totalBayar,
                    totalKembali,
                    sisaTagihan,
                    idPelanggan
                }),
            }).then(response => response.json())
            .then(data => {
                if(data === 'berhasil'){
                    this.resetAll();
                    swal.fire('Berhasil', 'Transaksi berhasil di lakukan', 'success');
                }else{
                    console.log('error', data);
                    swal.fire('Gagal', 'Transaksi gagal', 'error');
                }
            });
            promise.then(() => {
                inputPelanggan.disable();
                inputPelanggan.set('');
                metodePembayaran.set('cash');
                this.loadingTransaksi = false;
            });
        }
    }
}