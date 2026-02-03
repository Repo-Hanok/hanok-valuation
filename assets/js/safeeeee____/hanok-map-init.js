window.initHanokMap = function () {
  var mapDiv = document.getElementById('hanok-report-map');
  if (!mapDiv) return;

  var lat = parseFloat(mapDiv.dataset.lat);
  var lng = parseFloat(mapDiv.dataset.lng);
  if (isNaN(lat) || isNaN(lng)) return;

  var center = { lat, lng };

  var map = new google.maps.Map(mapDiv, {
    center,
    zoom: 16,
    disableDefaultUI: true,
  });

  new google.maps.Marker({ position: center, map });
};
