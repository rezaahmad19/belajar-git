// Mendapatkan elemen tombol untuk mengganti tema
const themeToggleButton = document.getElementById('theme-toggle');

// Mengecek apakah tema gelap sudah disimpan di localStorage
if (localStorage.getItem('dark-mode') === 'enabled') {
    document.body.classList.add('dark-mode');
}

// Menambahkan event listener untuk tombol ganti tema
themeToggleButton.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');

    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('dark-mode', 'enabled');
    } else {
        localStorage.setItem('dark-mode', 'disabled');
    }
});

// Modal untuk proyek
const modal = document.getElementById("project-modal");
const closeModal = document.getElementsByClassName("close")[0];

// Menambahkan event listener untuk proyek
document.querySelectorAll('#proyek li').forEach(item => {
    item.addEventListener('click', event => {
        const projectName = event.target.innerText;
        const projectDetails = `Detail mengenai proyek ${projectName} akan ditampilkan di sini.`;
        
        document.getElementById('project-details').innerText = projectDetails;
        modal.style.display = "block";
    });
});

// Menutup modal ketika pengguna mengklik (x)
closeModal.onclick = function() {
    modal.style.display = "none";
}

// Menutup modal ketika pengguna mengklik di luar modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Menangani pengiriman form kontak
const contactForm = document.getElementById('contact-form');
contactForm.addEventListener('submit', (event) => {
    event.preventDefault(); // Mencegah refresh halaman

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;

    // Tampilkan alert dengan informasi yang diisi
    alert(`Nama: ${name}\nEmail: ${email}\nPesan: ${message}`);

    // Reset form setelah pengiriman
    contactForm.reset();
});
let currentSlideIndex = {
    home: 0,
    keahlian: 0,
    pengalaman: 0,
    pendidikan: 0,
    proyek: 0
};

// Fungsi untuk mengubah slide
function changeSlide(section, n) {
    const slides = document.querySelectorAll(`#${section} .slide`);
    slides[currentSlideIndex[section]].classList.remove('active');

    currentSlideIndex[section] += n;

    // Mengatur index slide agar tetap dalam batas
    if (currentSlideIndex[section] >= slides.length) {
        currentSlideIndex[section] = 0;
    } else if (currentSlideIndex[section] < 0) {
        currentSlideIndex[section] = slides.length - 1;
    }

    slides[currentSlideIndex[section]].classList.add('active');
}

// Menampilkan detail proyek
function showProjectDetails(projectName) {
    const projectDetails = `Detail mengenai proyek ${projectName} akan ditampilkan di sini.`;
    document.getElementById('project-details').innerText = projectDetails;
    document.getElementById("project-modal").style.display = "block";
}

// Menutup modal ketika pengguna mengklik (x)
document.getElementsByClassName("close")[0].onclick = function() {
    document.getElementById("project-modal").style.display = "none";
}

// Menutup modal ketika pengguna mengklik di luar modal
window.onclick = function(event) {
    if (event.target == document.getElementById("project-modal")) {
        document.getElementById("project-modal").style.display = "none";
    }
}
let currentSlide = 0;

function changeSlide(section, direction) {
    const slides = document.querySelectorAll(`#${section} .slide`);
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + direction + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');
}

// Menangani pengiriman formulir
document.getElementById('contact-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah pengiriman formulir default
    alert('Pesan Anda telah dikirim!'); // Tindakan setelah pengiriman
});