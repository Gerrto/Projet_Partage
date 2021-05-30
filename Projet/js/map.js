function initMap() {

  const paris = { lat: 47.0833, lng: 2.4 }; //lat: 48.856614, lng: 2.3522219

  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 6,
    center: new google.maps.LatLng(47.081012, 2.398782)
  });
  
  let tbodyChilds = document.querySelector("table[class=\"tableMap\"]>tbody").children;
  let i=0;
  let infowindow = new google.maps.InfoWindow();

  for (let item of tbodyChilds) {
    console.log(item);
    let latitude = parseFloat(item.dataset.lat);
    let longitude = parseFloat(item.dataset.long);
    let titre = item.dataset.titre;
    console.log("titre:"+titre+" lat:"+latitude+" long:"+longitude)
    
    let marker = new google.maps.Marker({
      position: new google.maps.LatLng(latitude, longitude),
      map: map,
      title: titre
    });
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(titre);
        infowindow.open(map, marker);
      }
    })(marker, i));
    i++;
  }
  
}
