const cardHeaderDashboard = document.querySelectorAll('.card-header');

function IconCardDashboardTampilTextKeKiri() {
 console.log('IconCardDashboardTampilTextKeKiri');
 cardHeaderDashboard.forEach(element => {
  element.classList.add("justify-content-between", "align-items-start", "text-start");
  element.classList.remove("justify-content-center", "align-items-center", "text-center");
 });
}

function IconCardDashboardSembunyiTextKeMid() {
 console.log('IconCardDashboardSembunyiTextKeMid');
 cardHeaderDashboard.forEach(element => {
  element.classList.add("justify-content-center", "align-items-center", "text-center");
  element.classList.remove("justify-content-between", "align-items-start", "text-start");
 });
}
if (window.innerWidth < 575) {
 IconCardDashboardSembunyiTextKeMid();
} else {
 IconCardDashboardTampilTextKeKiri();
}

// Event listener untuk mengeksekusi kode saat ukuran layar berubah
window.addEventListener('resize', function () {
 if (window.innerWidth < 575) {
  IconCardDashboardSembunyiTextKeMid();
 } else {
  IconCardDashboardTampilTextKeKiri();
 }
});