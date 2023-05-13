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
      .then(data =>{
        // Mise à jour de la valeur affichée du nombre de couverts disponibles
        alert('Réservation effectuée avec succès !');
      })
      .catch(error => {
        alert(error.message);
      });
    });
});
    
    
    
    
    
    
