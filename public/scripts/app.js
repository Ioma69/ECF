
document.addEventListener("DOMContentLoaded", function() {
  let formReservation = document.getElementById('formReservation');

  formReservation.addEventListener('submit', function (e) {
    e.preventDefault();

    fetch(this.action, {
      body: new FormData(e.target),
      method: 'POST'
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Erreur de réservation : il n\'y a plus de place disponible à cette heure.');
      }
      return response.json();
    })
    .then(data => {
      Swal.fire({
        icon: 'success',
        title: 'Réservation effectuée avec succès, vous allez recevoir un mail de confirmation',
        showConfirmButton: false,
        timer: 5000
      }).then(() => {
        window.location.href = "/home"; // Redirection vers la page d'accueil
      });
    })
    .catch(error => {
      Swal.fire({
        icon: 'error',
        title: 'Erreur de réservation',
        text: error.message
      });
    });
  });
});
