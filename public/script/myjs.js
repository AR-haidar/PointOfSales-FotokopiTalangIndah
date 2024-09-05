//--------------------------JAM-------------------------------------

function jam() {
    var e = document.getElementById("jam"),
        d = new Date(),
        h,
        m,
        s;
    h = d.getHours();
    m = set(d.getMinutes());
    s = set(d.getSeconds());

    e.innerHTML = h + ":" + m + ":" + s;

    setTimeout("jam()", 1000);
}

function set(e) {
    e = e < 10 ? "0" + e : e;
    return e;
}


// -----------------------tambah kurang QTY-----------------------------
function tambahKuantitas(id) {
    var quantityInput = document.getElementById(id);
    var currentQuantity = parseInt(quantityInput.value) || 0;
    var newQuantity = currentQuantity + 1;
    quantityInput.value = newQuantity;
}

function kurangKuantitas(id) {
    var quantityInput = document.getElementById(id);
    var currentQuantity = parseInt(quantityInput.value) || 0;

    // Pastikan kuantitas tidak kurang dari 1
    var newQuantity = Math.max(currentQuantity - 1, 1);

    quantityInput.value = newQuantity;
}


// ------------------------Hitung Kembali--------------------------------
function hitungKembali() {
    // Ambil nilai totalBayar dan jumlahBayar
    var totalBayar = parseFloat(document.getElementById('total').value) || 0;
    var jumlahBayar = parseFloat(document.getElementById('bayar').value) || 0;

    // Hitung kembaliannya
    var kembali = jumlahBayar - totalBayar;

    // Set nilai kembali ke input dengan id 'kembali'
    document.getElementById('kembali').value = kembali;
}



// -----------------------Refresh Halaman tidak ke paling atas---------------------------------
// Simpan posisi scroll saat halaman dimuat
window.onload = function() {
    jam();
    var scrollPosition = sessionStorage.getItem('scrollPosition');
    if (scrollPosition) {
        window.scrollTo(0, scrollPosition);
        sessionStorage.removeItem('scrollPosition');
    }
};

// Simpan posisi scroll sebelum merefresh halaman
window.onbeforeunload = function() {
    sessionStorage.setItem('scrollPosition', window.scrollY);
};


//-------------------------Auto Fill SupplierB------------------------------------------------
//barang masuk
function autoFillsupplierB() {
    // Mendapatkan nilai dari Input A
    var supplierA = document.getElementById("supplierA").value;

    // Mengisi nilai Input B dengan nilai Input A
    document.getElementById("supplierB").value = supplierA;
  }
  function autoFillnobonB() {
    // Mendapatkan nilai dari Input A
    var nobonA = document.getElementById("nobonA").value;

    // Mengisi nilai Input B dengan nilai Input A
    document.getElementById("nobonB").value = nobonA;
  }

//Laporan
function autoFilldateA() {
    // Mendapatkan nilai dari Input A
    var dateA = document.getElementById("A").value;

    // Mengisi nilai Input B dengan nilai Input A
    document.getElementById("AA").value = dateA;
  }
function autoFilldateB() {
    // Mendapatkan nilai dari Input A
    var dateB = document.getElementById("B").value;

    // Mengisi nilai Input B dengan nilai Input A
    document.getElementById("BB").value = dateB;
  }