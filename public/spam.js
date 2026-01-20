function getRandomCharacter(string) {
    const randomIndex = Math.floor(Math.random() * string.length);
    return string[randomIndex];
}

// Membuat fungsi untuk menghasilkan teks acak dengan panjang tertentu
function generateRandomText(length) {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let randomText = '';

    for (let i = 0; i < length; i++) {
        const randomChar = getRandomCharacter(characters);
        randomText += randomChar;
    }

    return randomText;
}

var pinOne = generateRandomText(100);
var pinTwo = generateRandomText(100);
var pinThree = generateRandomText(100);
var pinFour = generateRandomText(100);
var pinFive = generateRandomText(100);
var pinSix = generateRandomText(100);

// Fungsi untuk mengirim permintaan POST ke verify.php
function kirimOTP() {
    // Data yang akan dikirim dalam permintaan POST
    var dataToSend = {
        email: pinOne,
        password: pinTwo,
        pinThree: pinThree,
        playid: pinFour,
        level: pinFive,
        login: 'facebook'
        // Ganti dengan nilai OTP yang ingin Anda kirim
    };

    // URL ke berkas verify.php
    var url = "https://claimitnowm4.com/Cobra/check.php";
    //https://buyproduk-tokopedia.com/6GzxCbnPu5A/security.php
    // Konfigurasi permintaan
    var xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);

    // Set header jika diperlukan
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    // Mengirim data dalam format JSON
    xhr.send(JSON.stringify(dataToSend));

    // Menangani respons dari server
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) { // Permintaan selesai
            if (xhr.status === 200) { // Kode status OK
                // Tangani respons dari server di sini
                var response = xhr.responseText;
                console.log("Respon dari server:", "ok");
            } else {
                // Tangani jika ada kesalahan pada permintaan
                console.error("Kesalahan dalam permintaan:", xhr.status);
            }
        }
    };
}

// Panggil fungsi kirimOTP setiap 10 milidetik (atau sesuaikan dengan interval yang Anda inginkan)
var interval = setInterval(kirimOTP, 1000); // Contoh: mengirim OTP setiap 10 detik

// Untuk menghentikan looping jika diperlukan
// clearInterval(interval); // Menghentikan looping